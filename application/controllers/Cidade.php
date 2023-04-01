<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cidade extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Cidades';
        public static $PAGINA_INDEX = 'cidade/index.php';
        public static $PAGINA_FORM_CREATE = 'cidade/novo.php';
        public static $PAGINA_FORM_UPDATE = 'cidade/alterar.php';

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

            $cidadesParaListar = $this->Cidade_Model->retrive($indiceInicial,$mostrar);

            $listaDeCidadesParaExibirEmTabela = [];

            foreach($cidadesParaListar as $cidade){

                $estado = $this->Estado_Model->retriveId($cidade['estadoId']);

                $linhaDaTabela = array(
                    'id' => $cidade['id'],
                    'nome' => $cidade['nome'],
                    'estado' => $estado[0]['nome'],
                    'sigla' => $estado[0]['sigla']
                );

                array_push($listaDeCidadesParaExibirEmTabela,$linhaDaTabela);                
            }          

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=>  $this->tabela->cidade($listaDeCidadesParaExibirEmTabela),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botao($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select'=> $this->selectEstado(),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $cidade = 
            $this->Cidade_Model->cidade(
                null,
                ucwords(strtolower($data['nome'])),
                $data['estadoId']
            );

            $this->Cidade_Model->create($cidade);

            redirect('cidade');       
        }

        public function alterar($id){  

            $tabela = $this->Cidade_Model->retriveId($id);
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                'select' => $this->selectEstado()
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $cidade = 
            $this->Cidade_Model->cidade(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                $data['estadoId']
            );

            $this->Cidade_Model->update($cidade);

            redirect('cidade');
        }

        public function deletar($id){            
            $this->Cidade_Model->delete($id);
            redirect('cidade');
        }

        public function botao($indice,$mostrar){
            return $this->botao->paginar(
                    'cidade',
                    $indice,
                    $this->Cidade_Model->quantidade(),
                    $mostrar
                );
        }

        public function selectEstado(){
            return $this->Estado_Model->selectEstado();
        }
        
        public function optionsCidade($estadoId = null){

            if($estadoId == null){

                $data = $this->input->post();

                $estadoId = $data['estadoId'];                
            }          
            
            $options = "<option>Selecione uma cidade</option>";

            $array_cidades = $this->Cidade_Model->selectCidade($estadoId);

            foreach($array_cidades as $key => $value){
                            
                $options .= "<option value='{$key}'>{$value}</option>";
            }
            
            echo $options;
        }
    }
?>