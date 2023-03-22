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

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Cidade_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function novo(){
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select'=>$this->select(),
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

            $this->Cidade_Model->criar($cidade);

            redirect('cidade');       
        }

        public function alterar($id){  

            $tabela = $this->Cidade_Model->retriveId($id);
            
            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                'select' => $this->select()
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

        public function select(){

            $select = [];

            foreach($this->Estado_Model->retrive(null,null) as $value){
                
                $estado = array($value['id'] => $value['nome'] ."/". $value['sigla']);

                $select += $estado;
            }

            return $select;
        }
        
/*        public function selectCidadesPorIdEstado($where = null){

            $options = "<option value''>Selecione uma Cidade</option>";

            $cidade = 
                $this
                ->db
                ->where('estadoId',$where)
                ->order_by('nome')
                ->get('cidade');

            foreach($cidade->result() as $cidade){
                $options .= "<option value='{$cidade->id}'>{$cidade->nome}</option>".PHP_EOL;
            }

            return $options;

            $select = array();

            foreach($this->Estado_Model->retrive(null,null) as $value){

               
                $select = array($value['id'] => "{$value['nome']} {$value['sigla']}");
            }

            return $select;
        }*/

        public function tabela($listaDeCidade){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Cidade</td>
                        <td>Estado</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeCidade as $cidade){
                
                $estado = $this->Estado_Model->retriveId($cidade['estadoId']);
                
                $line .= 
                    "<tr class='text-center'> 
                            <td>{$cidade['id']}</td>
                            <td>{$cidade['nome']}</td>
                            <td>{$estado[0]['nome']}</td>
                            <td>{$estado[0]['sigla']}</td>
                            <td><a href='" . base_url() . "index.php/cidade/alterar/" . $cidade['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/cidade/deletar/" . $cidade['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){

                include_once('Botao.php');
                $botao = new Botao('cidade');
                
                return 
                $botao->paginar(
                    $indiceInicial,
                    $this->Cidade_Model->quantidade(),
                    $mostrar);
        }
    }
?>