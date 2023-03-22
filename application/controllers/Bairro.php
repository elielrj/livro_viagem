<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Bairro extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Bairros';
        public static $PAGINA_INDEX = 'bairro/index.php';
        public static $PAGINA_FORM_CREATE = 'bairro/novo.php';
        public static $PAGINA_FORM_UPDATE = 'bairro/alterar.php';

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
                    $this->Bairro_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){

          $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_estado' => $this->selectEstado(),
                'selected_estado' => array('id' => 24),
                'select_cidade' => $this->selectCidade(24),
                'selected_cidade' => array('id' => 4429),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $bairro = 
            $this->Bairro_Model->bairro(
                null,
                ucwords(strtolower($data['nome'])),
                $data['cidadeId']
            );

            $this->Bairro_Model->criar($bairro);

            redirect('bairro');       
        }

       public function alterar($id){  

            $tabela = $this->Bairro_Model->retriveId($id);

            $cidade_selected = $this->Cidade_Model->retriveId($tabela[0]['cidadeId']);

            $estado_selected = $this->Estado_Model->retriveId($cidade_selected[0]['estadoId']);
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                'select_cidade' => $this->selectCidade($estado_selected[0]['id']),
                'select_estado' => $this->selectEstado(),
                'cidade_selected' => $cidade_selected[0]['id'],
                'estado_selected' => $estado_selected[0]['id'],
            );

            $this->load->view('index',$dados);
        }

        public function optionsCidade($estadoId = null){

            if($estadoId == null){

                $data = $this->input->post();

                $estadoId = $data['estadoId'];                
            }          
            
            $options = "<option>Selecione uma cidade</option>";

            foreach($this->selectCidade($estadoId) as $key => $value){
                            
                $options .= "<option value='{$key}'>{$value}</option>";
            }
            
            echo $options;
        }

        public function optionsBairro($cidadeId = null){

            if($cidadeId == null){

                $data = $this->input->post();

                $cidadeId = $data['cidadeId'];                
            }          
            
            $options = "<option>Selecione uma bairro</option>";

            foreach($this->selectBairro($cidadeId) as $key => $value){
                            
                $options .= "<option value='{$key}'>{$value}</option>";
            }
            
            echo $options;
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

        public function atualizar(){

            $data = $this->input->post();
            
            $bairro = 
            $this->Bairro_Model->bairro(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                $data['cidadeId']
            );

            $this->Bairro_Model->update($bairro);

            redirect('bairro');
        }

        public function deletar($id){            

            $this->Bairro_Model->delete($id);

            redirect('bairro');
        }

      /*  public function select($estadoId = null){

            $select = [];

            foreach($this->Cidade_Model->retriveEstadoId($estadoId) as $value){
                
                $cidade = array($value['id'] => $value['nome'] ."/". $value['estadoId']);

                $select += $cidade;
            }

            return $select;
        }*/
       
        public function tabela($listaDeBairros){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Bairro</td>
                        <td>Cidade</td>
                        <td>Estado</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeBairros as $bairro){

                $cidade = $this->Cidade_Model->retriveId($bairro['cidadeId']);
                $estado = $this->Estado_Model->retriveId($cidade[0]['estadoId']);

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$bairro['id']}</td>
                            <td>{$bairro['nome']}</td>
                            <td>{$cidade[0]['nome']}</td>
                            <td>{$estado[0]['nome']}</td>
                            <td>{$estado[0]['sigla']}</td>
                            <td class='text-center'><a href='" . base_url() . "index.php/bairro/alterar/" . $bairro['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/bairro/deletar/" . $bairro['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){

                include_once('Botao.php');
                $botao = new Botao('bairro');
                
                return 
                $botao->paginar(
                    $indiceInicial,
                    $this->Bairro_Model->quantidade(),
                    $mostrar);
        }
        
    }
?>