<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Funcao_Model extends CI_Model {

        public static $TABELA_DB = 'funcao';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($funcao){

            $this->db->insert(
                self::$TABELA_DB, 
                $funcao);
        }
        
        public function update($funcao){

            $this->db->update(
                self::$TABELA_DB,
                $funcao, 
                array('id'=> $funcao['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoFuncao($resultado->result());
        }
        
        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoFuncao($resultado->result());
        }       

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }
        
        public function montarObjetoFuncao($result){

            $listaDeFuncoes = array();

            foreach($result as $linha){
                $funcao = $this->funcao(
                    $linha->id,
                    $linha->descricao,
                    $linha->status,
                    $linha->nivelDeAcessoId,
                );

                array_push($listaDeFuncoes, $funcao);
           }
            return $listaDeFuncoes;
        }
        
        public function funcao($id,$descricao,$status,$nivelDeAcessoId){            
        
            return array(
                'id' => $id,
                'descricao' => $descricao,
                'status' => $status,
                'nivelDeAcessoId' => $nivelDeAcessoId,
            );
        }
        
        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function selectFuncao(){  

            $select = [];

            foreach($this->retrive(null,null) as $value){
                
                $funcao = array($value['id'] => $value['descricao']);

                $select += $funcao;
            }
            return $select;
        }
        

    }
?>