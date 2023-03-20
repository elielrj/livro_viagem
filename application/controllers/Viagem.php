<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Viagem extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Viagens';
        public static $PAGINA_INDEX = 'viagem/index.php';
        public static $PAGINA_FORM_CREATE = 'viagem/novo.php';
        public static $PAGINA_FORM_UPDATE = 'viagem/alterar.php';

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
                    $this->Viagem_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indiceInicial,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){

            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
                //'selected_endereco' => $selectEndereco[0],
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $dataIda = new DateTime($data['dataIda']);
            $dataVolta = new DateTime($data['dataVolta']);
            
            $viagem = 
            $this->Viagem_Model->viagem(
                null,
                $data['aprovada'],
                $data['territorio'],
                $data['motivo'],
                $data['usuarioId'],
                $data['enderecoId'],
                $dataIda->format('Y-m-d'),
                $dataVolta->format('Y-m-d'),
                $data['observacao'],
            );

            $this->Viagem_Model->criar($viagem);

            redirect('viagem');       
        }

        public function alterar($id){                
            
            $tabela = $this->Viagem_Model->retriveId($id);
            
            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $viagem = 
            $this->Viagem_Model->viagem(
                $data['id'],
                $data['aprovada'],
                $data['territorio'],
                $data['motivo'],
                $data['usuarioId'],
                $data['enderecoId'],
                $data['dataIda'],
                $data['dataVolta'],
                $data['observacao'],
            );

            $this->Viagem_Model->update($viagem);

            redirect('viagem');
        }

        public function deletar($id){            

            $this->Viagem_Model->delete($id);

            redirect('viagem');
        }

        public function tabela($listaDeBairros){
            $line =
                "
                    <tr>
                        <td>Id</td>
                        <td>Aprovada</td>
                        <td>Território</td>
                        <td>Motivo da Viagem</td>
                        <td>Usuário</td>
                        <td>Endereço</td>
                        <td>Data Ida</td>
                        <td>Data Volta</td>
                        <td>Observação</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeBairros as $viagem){

                $usuario = $this->Usuario_Model->retriveId($viagem['usuarioId']);
                $endereco = $this->Endereco_Model->retriveId($viagem['enderecoId']);
                $endereco_string = $this->Endereco_Model->toString($endereco[0]);

                $line .= 
                    "<tr> 
                            <td>{$viagem['id']}</td>
                            <td>" . (($viagem['aprovada'] == 1) ? 'Sim' : 'Não') ."</td>
                            <td>{$viagem['territorio']}</td>
                            <td>{$viagem['motivo']}</td>
                            <td>{$usuario[0]['nome']}</td>
                            <td>{$endereco_string}</td>
                            <td>{$viagem['dataIda']}</td>
                            <td>{$viagem['dataVolta']}</td>
                            <td>{$viagem['observacao']}</td>
                            <td><a href='" . base_url() . "index.php/viagem/alterar/" . $viagem['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/viagem/deletar/" . $viagem['id'] . "'>Excluir</a></td>
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
                    $this->Viagem_Model->quantidade(),
                    $mostrar);
        
                $buttons = "<div class='row'>";
                for($index = $contador->inicio ; $index < $contador->ultimaPagina ; $index++){

                    $disabled = ($index == $contador->apartirDoIndiceDoVetor) ? 'disabled' : '';

                    $buttons .= 
                        "<div class='col-md-1'>
                            <a class='btn btn-primary {$disabled}' 
                                href='" . base_url() . "index.php/bairviagemro/listar/{$index}'>" . ($index + 1) . "</a>
                        </div>"
                    ;
                }

                $buttons .= "</div>";

                return $buttons;
        }

    }
