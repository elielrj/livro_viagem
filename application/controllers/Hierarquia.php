<?php
    class Hierarquia extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Hierarquia';
        public static $PAGINA_INDEX = 'hierarquia/index.php';
        public static $PAGINA_FORM_CREATE = 'hierarquia/novo.php';
        public static $PAGINA_FORM_UPDATE = 'hierarquia/alterar.php';

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
                    $this->Hierarquia_Model->retrive($indiceInicial,$mostrar)),
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

            $hierarquia = 
            $this->Hierarquia_Model->hierarquia(
                null,
                ucwords(strtolower($data['postoOuGraduacao'])),
                $data['sigla'],
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
            );

            $this->Hierarquia_Model->update($hierarquia);

            redirect('hierarquia');
        }

        public function deletar($id){            

            $this->Hierarquia_Model->delete($id);

            redirect('hierarquia');
        }      
        
        public function tabela($listaDeHierarquias){
            $line =
                "
                    <tr>
                        <td>Id</td>
                        <td>Posto ou Graduação</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeHierarquias as $hierarquia){

                $line .= 
                    "<tr> 
                            <td>{$hierarquia['id']}</td>
                            <td>{$hierarquia['postoOuGraduacao']}</td>
                            <td>{$hierarquia['sigla']}</td>
                            <td><a href='" . base_url() . "index.php/hierarquia/alterar/" . $hierarquia['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/hierarquia/deletar/" . $hierarquia['id'] . "'>Excluir</a></td>
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
                    $this->Hierarquia_Model->quantidade(),
                    $mostrar);
        
                $buttons = "<div class='row'>";
                for($index = $contador->inicio ; $index < $contador->ultimaPagina ; $index++){

                    $disabled = ($index == $contador->apartirDoIndiceDoVetor) ? 'disabled' : '';

                    $buttons .= 
                        "<div class='col-md-1'>
                            <a class='btn btn-primary {$disabled}' 
                                href='" . base_url() . "index.php/hierarquia/listar/{$index}'>" . ($index + 1) . "</a>
                        </div>"
                    ;
                }

                $buttons .= "</div>";

                return $buttons;
        }

    }
