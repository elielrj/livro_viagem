<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Estado extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Estados';
        public static $PAGINA_INDEX = 'estado/index.php';
        public static $PAGINA_FORM_CREATE = 'estado/novo.php';
        public static $PAGINA_FORM_UPDATE = 'estado/alterar.php';

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
                'tabela'=> $this->tabela->estado(
                    $this->Estado_Model->retrive($indiceInicial,$mostrar),
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
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();
            
            $estado = 
            $this->Estado_Model->estado(
                null,
                ucwords(strtolower($data['nome'])),
                mb_strtoupper($data['sigla']),
            );

            $this->Estado_Model->create($estado);

            redirect('estado');       
        }

        public function alterar($id){                
                        
            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $this->Estado_Model->retriveId($id),
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $estado = 
            $this->Estado_Model->estado(
                $data['id'],
                ucwords(strtolower(($data['nome']))),
                mb_strtoupper($data['sigla'])
            );

            $this->Estado_Model->update($estado);

            redirect('estado');
        }

        public function deletar($id){            

            $this->Estado_Model->delete($id);

            redirect('estado');
        }

        public function botao($indice,$mostrar){
            return $this->botao->paginar(
                    'estado',
                    $indice,
                    $this->Estado_Model->quantidade(),
                    $mostrar
                );
        }
    }

?>
