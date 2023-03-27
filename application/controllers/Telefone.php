<?php
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

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Telefone_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
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
            );

            $this->Telefone_Model->update($telefone);

            redirect('telefone');
        }

        public function deletar($id){            

            $this->Telefone_Model->delete($id);

            redirect('telefone');
        }      
        
        public function tabela($listaDeTelefones){

            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Número</td>
                        <td>Contato</td>
                        <td>Parentesco do Contato</td>
                        <td>Usuário</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeTelefones as $telefone){

                $usuario = $this->Usuario_Model->retriveId($telefone['usuarioId']);

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$telefone['id']}</td>
                            <td>{$telefone['numero']}</td>
                            <td>{$telefone['contato']}</td>
                            <td>{$telefone['parentescoDoContato']}</td>
                            <td>{$usuario[0]['nome']}</td>
                            <td><a href='" . base_url() . "index.php/telefone/alterar/" . $telefone['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/telefone/deletar/" . $telefone['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){
                
                return 
                $this->botao->paginar(
                    'telefone',
                    $indiceInicial,
                    $this->Telefone_Model->quantidade(),
                    $mostrar);
        }

    }
