<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuario extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Usuários';
        public static $PAGINA_INDEX = 'usuario/index.php';
        public static $PAGINA_FORM_CREATE = 'usuario/novo.php';
        public static $PAGINA_FORM_UPDATE = 'usuario/alterar.php';

        public function __contruct(){            
            parent::__contruct();              
        }

        public function index(){   
            $this->listar();
        }

        public function listar($indice = 0){

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Usuario_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indiceInicial,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

       public function novo(){

          $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_hierarquia' => $this->selectHierarquia(),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $timestamp = now('America/Sao_Paulo');
            $datestring = '%Y-%m-%d';
            $dataHoraAgora = mdate($datestring,$timestamp);

            $usuario = 
            $this->Usuario_Model->usuario(
                null,
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $dataHoraAgora,
                $dataHoraAgora,
                $data['hierarquiaId'],
                $data['email'],
                md5($data['senha']),
            );

            $this->Usuario_Model->criar($usuario);

            redirect('usuario');       
        }
        
        public function alterar($id){                
            
            $tabela = $this->Usuario_Model->retriveId($id);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
                'select_hierarquia' => $this->selectHierarquia(),
                'selected_hierarquia' => $tabela[0]['hierarquiaId'],
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();

            $dataDeCriacao = new DateTime($data['dataDeCriacao']);

            $timestamp = now('America/Sao_Paulo');
            $datestring = '%Y-%m-%d';
            $dataHoraAgora = mdate($datestring,$timestamp);
            
            $usuario = 
            $this->Usuario_Model->usuario(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $dataDeCriacao->format('Y-m-d'),
                $dataHoraAgora,
                $data['hierarquiaId'],
                $data['email'],
                md5($data['senha']),
            );

            $this->Usuario_Model->update($usuario);

            redirect('usuario');
        }

        public function deletar($id){            

            $this->Usuario_Model->delete($id);

            redirect('usuario');
        }
        
        public function selectHierarquia(){
            return $this->Hierarquia_Model->selectHierarquia();
        }
        
        public function tabela($listaDeUsuarios){
            $line =
                "
                    <tr>
                        <td>Id</td>
                        <td>Nome</td>
                        <td>Status</td>
                        <td>Data de Criação</td>
                        <td>Último Acesso</td>
                        <td>Hierarquia</td>
                        <td>Email</td>
                        <td>Senha</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeUsuarios as $usuario){

                $hierarquia = $this->Hierarquia_Model->retriveId($usuario['hierarquiaId']);

                $line .= 
                    "<tr> 
                            <td>{$usuario['id']}</td>
                            <td>{$usuario['nome']}</td>
                            <td>{$usuario['status']}</td>
                            <td>{$usuario['dataDeCriacao']}</td>
                            <td>{$usuario['ultimoAcesso']}</td>
                            <td>{$hierarquia[0]['sigla']}</td>
                            <td>{$usuario['email']}</td>
                            <td>{$usuario['senha']}</td>
                            <td><a href='" . base_url() . "index.php/usuario/alterar/" . $usuario['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/usuario/deletar/" . $usuario['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){
                 
                include_once('ContadorDeBotoesDaPagina.php');
                $contador = new ContadorDeBotoesDaPagina();

                $contador->contarNumeroDePaginas(
                    $indiceInicial,
                    $this->Usuario_Model->quantidade(),
                    $mostrar);
        
                $buttons = "<div class='row'>";
                for($index = $contador->inicio ; $index < $contador->ultimaPagina ; $index++){

                    $disabled = ($index == $contador->apartirDoIndiceDoVetor) ? 'disabled' : '';

                    $buttons .= 
                        "<div class='col-md-1'>
                            <a class='btn btn-primary {$disabled}' 
                                href='" . base_url() . "index.php/usuario/listar/{$index}'>" . ($index + 1) . "</a>
                        </div>"
                    ;
                }

                $buttons .= "</div>";

                return $buttons;
        }
        
    }
       


