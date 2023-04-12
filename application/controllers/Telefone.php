<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Telefone extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Telefone';
        public static $PAGINA_INDEX = 'telefone/index.php';
        public static $PAGINA_FORM_CREATE = 'telefone/novo.php';
        public static $PAGINA_FORM_UPDATE = 'telefone/alterar.php';

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

            $telefones = $this->Telefone_Model->retrive($indiceInicial,$mostrar);
            $botoes =  empty($telefones) ? '' : $this->botao('telefone/listar',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->paraTabela(
                    $telefones,
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
                'usuarioId' => $this->session->id,
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $telefone = 
            $this->Telefone_Model->telefone(
                null,
                $data['numero'],
                $data['contato'],
                $data['parentescoDoContato'],
                $data['usuarioId'],
                $status = true
            );

            $this->Telefone_Model->criar($telefone);

            redirect('telefone');       
        }
        
        public function alterar($id){                
            
            $tabela = $this->Telefone_Model->retriveId($id);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $telefone = 
            $this->Telefone_Model->telefone(
                $data['id'],
                $data['numero'],
                $data['contato'],
                $data['parentescoDoContato'],
                $data['usuarioId'],
                $data['status']
            );

            $this->Telefone_Model->update($telefone);

            redirect('telefone');
        }

        public function deletar($id){            

            $this->Telefone_Model->delete($id);

            redirect('telefone');
        }      

        public function recuperar($id){            

            $this->Telefone_Model->recuperar($id);

            redirect('telefone');
        }
        
        public function paraTabela($listaDeTelefones, $ordem){

            $line = [];

            foreach($listaDeTelefones as $telefone){

                $usuario = $this->Usuario_Model->retriveId($telefone['usuarioId']);

                $data = array(
                    'id' => $telefone['id'],
                    'numero' => $telefone['numero'],
                    'contato' => $telefone['contato'],
                    'parentescoDoContato' => $telefone['parentescoDoContato'],
                    'usuario' => $usuario[0]['nome'],
                    'usuarioId' => $telefone['usuarioId'],
                    'status' => $telefone['status']
                );
                    
                array_push($line,$data);
            }
            return $this->tabela->telefone($line, $ordem);
        }

        public function botao($link,$indice,$mostrar){
            return $this->botao->paginar(
                    $link,
                    $indice,
                    $this->Telefone_Model->quantidade(),
                    $mostrar
                );
        }

    }
