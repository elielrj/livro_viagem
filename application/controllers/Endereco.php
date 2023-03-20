<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Endereco extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Enderecos';
        public static $PAGINA_INDEX = 'endereco/index.php';
        public static $PAGINA_FORM_CREATE = 'endereco/novo.php';
        public static $PAGINA_FORM_UPDATE = 'endereco/alterar.php';

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
                    $this->Endereco_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indiceInicial,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo()       {
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_estado' => $this->selectEstado(),
                'selected_estado' => array('id' => 24),
                'select_cidade' => $this->selectCidade(24),
                'selected_cidade' => array('id' => 4429),
                'select_bairro' => $this->selectBairro(4429),
                'selected_bairro' => array('id' => 13),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $endereco = 
            $this->Endereco_Model->endereco(
                null,
                ucwords(strtolower($data['nome'])),
                ucwords(strtolower($data['logradouro'])),
                ucwords(strtolower($data['numero'])),
                $data['bairroId'],
                $this->session->id(),
            );

            $this->Endereco_Model->criar($endereco);

            redirect('endereco');       
        }

        public function alterar($id){  

            $tabela = $this->Endereco_Model->retriveId($id);

            $bairro_selected = $this->Bairro_Model->retriveId($tabela[0]['bairroId']);

            $cidade_selected = $this->Cidade_Model->retriveId($bairro_selected[0]['cidadeId']);

            $estado_selected = $this->Estado_Model->retriveId($cidade_selected[0]['estadoId']);
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                
                'select_bairro' => $this->selectBairro($cidade_selected[0]['id']),
                'select_cidade' => $this->selectCidade($estado_selected[0]['id']),
                'select_estado' => $this->selectEstado(),                
                
                'selected_cidade' => $cidade_selected[0]['id'],
                'selected_estado' => $estado_selected[0]['id'],                
                'selected_bairro' => $bairro_selected[0]['id'],                
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $endereco = 
            $this->Endereco_Model->endereco(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                ucwords(strtolower($data['logradouro'])),
                ucwords(strtolower($data['numero'])),
                $data['bairroId'],
                $data['usuarioId'],
            );

            $this->Endereco_Model->update($endereco);

            redirect('endereco');
        }

        public function deletar($id){            

            $this->Endereco_Model->delete($id);

            redirect('endereco');
        }

        public function selectBairro($cidadeId){            
            return $this->Bairro_Model->selectBairro($cidadeId);
        }

        public function selectCidade($estadoId){            
            return $this->Cidade_Model->selectCidade($estadoId);
        }

        public function selectEstado(){
            return $this->Estado_Model->selectEstado();
        }
        
        public function tabela($listaDeEnderecos){
            $line =
                "
                    <tr>
                        <td>Id</td>
                        <td>Nome do Endereço</td>
                        <td>Logradouro</td>
                        <td>Número</td>
                        <td>Bairro</td>
                        <td>Cidade</td>
                        <td>Estado</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

           
                foreach($listaDeEnderecos as $endereco){

                    $bairro = $this->Bairro_Model->retriveId($endereco['bairroId']);
                    $cidade = $this->Cidade_Model->retriveId($bairro[0]['cidadeId']);
                    $estado = $this->Estado_Model->retriveId($cidade[0]['estadoId']);

                    $line .= 
                        "<tr> 
                                <td>{$endereco['id']}</td>
                                <td>{$endereco['nome']}</td>
                                <td>{$endereco['logradouro']}</td>
                                <td>{$endereco['numero']}</td>
                                <td>{$bairro[0]['nome']}</td>
                                <td>{$cidade[0]['nome']}</td>
                                <td>{$estado[0]['nome']}</td>
                                <td>{$estado[0]['sigla']}</td>
                                <td><a href='" . base_url() . "index.php/endereco/alterar/" . $endereco['id'] . "'>Alterar</a></td>
                                <td><a href='" . base_url() . "index.php/endereco/deletar/" . $endereco['id'] . "'>Excluir</a></td>
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
                    $this->Endereco_Model->quantidade(),
                    $mostrar);
        
                $buttons = "<div class='row'>";
                for($index = $contador->inicio ; $index < $contador->ultimaPagina ; $index++){

                    $disabled = ($index == $contador->apartirDoIndiceDoVetor) ? 'disabled' : '';

                    $buttons .= 
                        "<div class='col-md-1'>
                            <a class='btn btn-primary {$disabled}' 
                                href='" . base_url() . "index.php/endereco/listar/{$index}'>" . ($index + 1) . "</a>
                        </div>"
                    ;
                }

                $buttons .= "</div>";

                return $buttons;
        }
        
    }

?>
