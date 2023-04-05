<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Cidade_Model extends CI_Model {

        public static $TABELA_DB = 'cidade';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function create($cidade){

            $this->db->insert(
                self::$TABELA_DB, 
                $cidade);
        }
        
        public function update($cidade){

            $this->db->update(
                self::$TABELA_DB,
                $cidade, 
                array('id'=> $cidade['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
           
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial                
            ); 
 
            return $this->montarObjetoCidade($resultado->result());
        }
        
        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoCidade($resultado->result());
        }

        public function retriveEstadoId($estadoId){
            
            $resultado = 
            $this->db
                ->where('estadoId',$estadoId)
                ->order_by('nome')
                ->get(self::$TABELA_DB); 
            
            return $this->montarObjetoCidade($resultado->result());
        }

        public function delete($id){
            $this->db->update(
                self::$TABELA_DB,
                array('status' => false),
                array('id'=> $id));
        }

        public function recuperar($id){
            $this->db->update(
                self::$TABELA_DB,
                array('status' => true),
                array('id'=> $id));
        }
        
        public function montarObjetoCidade($result){

            $listaDeCidades = array();

            foreach($result as $linha){
                $cidade = $this->cidade(
                    $linha->id,
                    $linha->nome,
                    $linha->estadoId,
                    $linha->status
                );

                array_push($listaDeCidades, $cidade);
           }
            return $listaDeCidades;
        }
        
        public function cidade($id,$nome,$estadoId,$status){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'estadoId' => $estadoId,
                'status' => $status
            );
        }
        
        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function selectCidade($estadoId){            

            $select = [];

            foreach($this->retriveEstadoId($estadoId) as $value){
                
                $cidade = array($value['id'] => $value['nome']);

                $select += $cidade;
            }

            return $select;
        }

       
    }
?>