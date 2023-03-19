<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Bairro_Model extends CI_Model {

        public static $TABELA_DB = 'bairro';
        
        public function __construct(){
            parent::__construct();
        }
        
         public function criar($bairro){
            $this->db->insert(
                self::$TABELA_DB, 
                $bairro);
        }
        
        public function update($bairro){

            $this->db->update(
                self::$TABELA_DB,
                $bairro, 
                array('id'=> $bairro['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoBairro($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoBairro($resultado->result());
        }

        
        public function retriveCidadeId($cidadeId){
            
            $resultado = 
            $this->db
                ->where('cidadeId',$cidadeId)
                ->order_by('nome')
                ->get(self::$TABELA_DB); 
            
            return $this->montarObjetoBairro($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoBairro($result){

            $listaDeBairros = array();

            foreach($result as $linha){
                $bairro = $this->bairro(
                    $linha->id,
                    $linha->nome,
                    $linha->cidadeId
                );

                array_push($listaDeBairros, $bairro);
           }
            return $listaDeBairros;
        }
        
        public function bairro($id,$nome,$cidadeId){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'cidadeId' => $cidadeId
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function selectBairro($cidadeId){     
            
            $select = [];

            foreach($this->retriveCidadeId($cidadeId) as $value){
                
                $cidade = array($value['id'] => $value['nome']);

                $select += $cidade;
            }
            
            return $select;
        }
    }
?>