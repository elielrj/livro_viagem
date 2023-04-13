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
           if(!isset($this->session->email)){

                $this->load->view('login.php');

            }else{
                $this->listar();
            } 
        }

        public function listar($indice = 1){

            $indice--;            

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $estados = $this->Estado_Model->retrive($indiceInicial,$mostrar);
            $botoes =  empty($estados) ? '' : $this->botao('estado/listar',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela->estado(
                    $estados,
                    $indiceInicial
                ),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $botoes,
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
                $status = true
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
                mb_strtoupper($data['sigla']),
                $data['status']
            );

            $this->Estado_Model->update($estado);

            redirect('estado');
        }

        public function deletar($id){            

            $this->Estado_Model->delete($id);

            redirect('estado');
        }

        public function recuperar($id){            

            $this->Estado_Model->recuperar($id);

            redirect('estado');
        }

        public function botao($link,$indice,$mostrar){
            return $this->botao->paginar(
                    $link,
                    $indice,
                    $this->Estado_Model->quantidade(),
                    $mostrar
                );
        }
    }

?>
