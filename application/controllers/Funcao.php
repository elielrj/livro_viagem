<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Funcao extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Funções';
        public static $PAGINA_INDEX = 'funcao/index.php';
        public static $PAGINA_FORM_CREATE = 'funcao/novo.php';
        public static $PAGINA_FORM_UPDATE = 'funcao/alterar.php';

        public function __contruct(){            
            parent::__contruct();              
        }

        public function index(){   
            $this->listar();
        }

        public function listar($indice = 1){

            $indice--;            

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela->funcao(
                    $this->Funcao_Model->retrive($indiceInicial,$mostrar),
                    $indiceInicial
                ),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botao($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_nivelDeAcesso' => $this->Funcao_Model->selectNivelDeAcesso(),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();
            
            $funcao = 
            $this->Funcao_Model->funcao(
                null,
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $data['nivelDeAcesso'],
            );

            $this->Funcao_Model->criar($funcao);

            redirect('funcao');       
        }

        public function alterar($id){                
                      
            $tabela = $this->Funcao_Model->retriveId($id);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
                'select_nivelDeAcesso' => $this->Funcao_Model->selectNivelDeAcesso(),
                'selected_nivelDeAcesso' => $tabela[0]['nivelDeAcesso'],
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $funcao = 
            $this->Funcao_Model->funcao(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $data['nivelDeAcesso'],
            );

            $this->Funcao_Model->update($funcao);

            redirect('funcao');
        }

        public function deletar($id){   
            $this->Funcao_Model->delete($id);
            redirect('funcao');
        }

        public function recuperar($id){            

            $this->Funcao_Model->recuperar($id);

            redirect('funcao');
        }

        public function botao($indice,$mostrar){
            return $this->botao->paginar(
                    'funcao',
                    $indice,
                    $this->Funcao_Model->quantidade(),
                    $mostrar
                );
        }        
    }

?>
