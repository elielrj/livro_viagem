<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class NivelDeAcesso_Model extends CI_Model {

        public static $TABELA_DB = 'niveldeacesso';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($nivelDeAcesso){

            $this->db->insert(
                self::$TABELA_DB, 
                $nivelDeAcesso);
        }
        
        public function update($nivelDeAcesso){

            $this->db->update(
                self::$TABELA_DB,
                $nivelDeAcesso, 
                array('id'=> $nivelDeAcesso['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoNivelDeAcesso($resultado->result());
        }
        
        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoNivelDeAcesso($resultado->result());
        }       

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }
        
        public function montarObjetoNivelDeAcesso($result){

            $listaDeNivelDeAcesso = array();

            foreach($result as $linha){
                $nivelDeAcesso = $this->nivelDeAcesso(
                    $linha->id,
                    $linha->poder,
                    $linha->status
                );

                array_push($listaDeNivelDeAcesso, $nivelDeAcesso);
           }
            return $listaDeNivelDeAcesso;
        }
        
        public function nivelDeAcesso($id,$poder,$status){            
        
            return array(
                'id' => $id,
                'poder' => $poder,
                'status' => $status
            );
        }
        
        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function selectNivelDeAcesso(){  

            $select = [];

            foreach($this->retrive(null,null) as $value){
                
                $nivelDeAcesso = array($value['id'] => $value['poder']);

                $select += $nivelDeAcesso;
            }
            return $select;
        }

        

    }
?>