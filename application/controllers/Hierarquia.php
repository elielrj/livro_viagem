<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Hierarquia extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Hierarquia';
        public static $PAGINA_INDEX = 'hierarquia/index.php';
        public static $PAGINA_FORM_CREATE = 'hierarquia/novo.php';
        public static $PAGINA_FORM_UPDATE = 'hierarquia/alterar.php';

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

            $hierarquias = $this->Hierarquia_Model->retrive($indiceInicial,$mostrar);
            $botoes =  empty($hierarquias) ? '' : $this->botao('hierarquia/listar',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela->hierarquia(
                    $hierarquias,
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

            $hierarquia = 
            $this->Hierarquia_Model->hierarquia(
                null,
                ucwords(strtolower($data['postoOuGraduacao'])),
                $data['sigla'],
                true
            );

            $this->Hierarquia_Model->criar($hierarquia);

            redirect('hierarquia');       
        }
        
        public function alterar($id){                
            
            $tabela = $this->Hierarquia_Model->retriveId($id);
            
            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $hierarquia = 
            $this->Hierarquia_Model->hierarquia(
                $data['id'],
                ucwords(strtolower($data['postoOuGraduacao'])),
                $data['sigla'],
                $data['status'] 
            );

            $this->Hierarquia_Model->update($hierarquia);

            redirect('hierarquia');
        }

        public function deletar($id){            

            $this->Hierarquia_Model->delete($id);

            redirect('hierarquia');
        }  
        
        public function recuperar($id){            

            $this->Hierarquia_Model->recuperar($id);

            redirect('hierarquia');
        }

        public function botao($link,$indice,$mostrar){
            return $this->botao->paginar(
                    $link,
                    $indice,
                    $this->Hierarquia_Model->quantidade(),
                    $mostrar
                );
        }

    }
