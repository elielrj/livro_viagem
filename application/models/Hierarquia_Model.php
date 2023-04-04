<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Hierarquia_Model extends CI_Model{

        public static $TABELA_DB = 'hierarquia';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($hierarquia){
            $this->db->insert(
                self::$TABELA_DB, 
                $hierarquia);
        }
        
        public function update($hierarquia){

            $this->db->update(
                self::$TABELA_DB,
                $hierarquia, 
                array('id'=> $hierarquia['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoHierarquia($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoHierarquia($resultado->result());
        }

        public function delete($id){
            $this->db->update(
                self::$TABELA_DB,
                array('status'=> false),
                array('id'=> $id)
            );
        }

        public function recuperar($id){
            $this->db->update(
                self::$TABELA_DB,
                array('status'=> true),
                array('id'=> $id)                
            );
        }

        public function montarObjetoHierarquia($result){

            $listaDeHierarquias = array();

            foreach($result as $linha){
                $hierarquia = $this->hierarquia(
                    $linha->id,
                    $linha->postoOuGraduacao,
                    $linha->sigla,
                    $linha->status
                );

                array_push($listaDeHierarquias, $hierarquia);
           }
            return $listaDeHierarquias;
        }
        
        public function hierarquia(
            $id,
            $postoOuGraduacao,
            $sigla,
            $status){            
        
            return array(
                'id' => $id,
                'postoOuGraduacao' => $postoOuGraduacao,
                'sigla' => $sigla,
                'status' => $status
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function selectHierarquia(){     
            
            $select = [];

            foreach($this->retrive(null,null) as $value){
                
                $hierarquia = array($value['id'] => $value['postoOuGraduacao'] . "/". $value['sigla']);

                $select += $hierarquia;
            }
            
            return $select;
        }

    }
?>