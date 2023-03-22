<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class NivelDeAcesso extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Nível de Acesso';
        public static $PAGINA_INDEX = 'niveldeacesso/index.php';
        public static $PAGINA_FORM_CREATE = 'niveldeacesso/novo.php';
        public static $PAGINA_FORM_UPDATE = 'niveldeacesso/alterar.php';

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
                    $this->NivelDeAcesso_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){

            $nivelDeAcesso = array(
                'Ler' => 'Ler',
                'Escrever' => 'Escrever',
                'Despachar' => 'Despachar',
                'Administrar' => 'Administrar',
            );
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_nivelDeAcesso' => $nivelDeAcesso,
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();
            
            $nivelDeAcesso = 
            $this->NivelDeAcesso_Model->nivelDeAcesso(
                null,
                ucwords(strtoupper($data['poder'])),
                $data['status'],
            );

            $this->NivelDeAcesso_Model->criar($nivelDeAcesso);

            redirect('nivelDeAcesso');       
        }

        public function alterar($id){                
                        
            $tabela = $this->NivelDeAcesso_Model->retriveId($id);

            $nivelDeAcesso = array(
                'Ler' => 'Ler',
                'Escrever' => 'Escrever',
                'Despachar' => 'Despachar',
                'Administrar' => 'Administrar',
            );

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
                'select_nivelDeAcesso' => $nivelDeAcesso,

            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $nivelDeAcesso = 
            $this->NivelDeAcesso_Model->nivelDeAcesso(
                $data['id'],
                ucwords(strtoupper(($data['poder']))),
                $data['status']
            );

            $this->NivelDeAcesso_Model->update($nivelDeAcesso);

            redirect('nivelDeAcesso');
        }

        public function deletar($id){            

            $this->NivelDeAcesso_Model->delete($id);

            redirect('nivelDeAcesso');
        }

        public function tabela($listaDeNivelDeAcesso){

            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Poder</td>
                        <td>Status</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeNivelDeAcesso as $nivelDeAcesso){

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$nivelDeAcesso['id']}</td>
                            <td>{$nivelDeAcesso['poder']}</td>
                            <td>{$nivelDeAcesso['status']}</td>
                            <td><a href='" . base_url() . "index.php/nivelDeAcesso/alterar/" . $nivelDeAcesso['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/nivelDeAcesso/deletar/" . $nivelDeAcesso['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){

                include_once('Botao.php');
                $botao = new Botao('nivelDeAcesso');
                
                return 
                $botao->paginar(
                    $indiceInicial,
                    $this->NivelDeAcesso_Model->quantidade(),
                    $mostrar);
        }
    }

?>
