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
                'tabela'=> $this->tabela(
                    $this->Funcao_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_nivelDeAcesso' => $this->NivelDeAcesso_Model->selectNivelDeAcesso(),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();
            
            $funcao = 
            $this->Funcao_Model->funcao(
                null,
                ucwords(strtoupper($data['descricao'])),
                $data['status'],
                $data['nivelDeAcessoId'],
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
                'select_nivelDeAcesso' => $this->NivelDeAcesso_Model->selectNivelDeAcesso(),
                'selected_nivelDeAcesso' => $tabela[0]['nivelDeAcessoId'],
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $funcao = 
            $this->Funcao_Model->funcao(
                $data['id'],
                ucwords(strtoupper($data['descricao'])),
                $data['status'],
                $data['nivelDeAcessoId'],
            );

            $this->Funcao_Model->update($funcao);

            redirect('funcao');
        }

        public function deletar($id){            

            $this->Funcao_Model->delete($id);

            redirect('funcao');
        }

        public function tabela($listaDeFucoes){

            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Poder</td>
                        <td>Status</td>
                        <td>Nível de Acesso</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeFucoes as $funcao){

                $nivelDeAcesso = $this->NivelDeAcesso_Model->retriveId($funcao['nivelDeAcessoId']);

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$funcao['id']}</td>
                            <td>{$funcao['descricao']}</td>
                            <td>{$funcao['status']}</td>
                            <td>{$nivelDeAcesso[0]['poder']}</td>
                            <td><a href='" . base_url() . "index.php/funcao/alterar/" . $funcao['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/funcao/deletar/" . $funcao['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){

                include_once('Botao.php');
                $botao = new Botao('funcao');
                
                return 
                $botao->paginar(
                    $indiceInicial,
                    $this->Funcao_Model->quantidade(),
                    $mostrar);
        }
    }

?>
