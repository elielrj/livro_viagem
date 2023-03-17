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

        public function listar($indice = 0){

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Estado_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indiceInicial,$mostrar),
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

 /*       public function select($estadoId = null){

            $options = "<option value''>Selecione o Estado</option>";

            foreach($this->listar() as $estado){

                $selected = ($estado->id == $estadoId) ? "selected" : "";

                $options .= "<option value='{$estado->id}' {$selected}>{$estado->nome}/{$estado->sigla}</option>";
            }

            return $options;
        }*/

        public function tabela($listaDeEstados){

            $line =
                "
                    <tr>
                        <td>Id</td>
                        <td>Estado</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeEstados as $estado){

                $line .= 
                    "<tr> 
                            <td>{$estado['id']}</td>
                            <td>{$estado['nome']}</td>
                            <td>{$estado['sigla']}</td>
                            <td><a href='" . base_url() . "index.php/estado/alterar/" . $estado['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/estado/deletar/" . $estado['id'] . "'>Excluir</a></td>
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
                    $this->Estado_Model->quantidade(),
                    $mostrar);
        
                $buttons = "<div class='row'>";

                for($index = $contador->inicio ; $index < $contador->ultimaPagina ; $index++){

                    $disabled = ($index == $contador->apartirDoIndiceDoVetor) ? 'disabled' : '';

                    $buttons .= 
                        "<div class='col-md-1'>
                            <a class='btn btn-primary {$disabled}' 
                                href='" . base_url() . "index.php/estado/listar/{$index}' >" . ($index + 1) . "</a>
                        </div>"
                    ;
                }
                
                $buttons .= "</div>"; 

                return $buttons;
        }
    }

?>
