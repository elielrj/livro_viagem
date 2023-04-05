<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Telefone_Model extends CI_Model{
        
        public static $TABELA_DB = 'telefone';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($telefone){
            $this->db->insert(
                self::$TABELA_DB, 
                $telefone);
        }
        
        public function update($telefone){

            $this->db->update(
                self::$TABELA_DB,
                $telefone, 
                array('id'=> $telefone['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoTelefone($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoTelefone($resultado->result());
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

        public function montarObjetoTelefone($result){

            $listaDeTelefones = array();

            foreach($result as $linha){
                $telefone = $this->telefone(
                    $linha->id,
                    $linha->numero,
                    $linha->contato,
                    $linha->parentescoDoContato,
                    $linha->usuarioId,
                    $linha->status
                );

                array_push($listaDeTelefones, $telefone);
           }
            return $listaDeTelefones;
        }
        
        public function telefone(
            $id,
            $numero,
            $contato,
            $parentescoDoContato,            
            $usuarioId,
            $status){            
        
            return array(
                'id' => $id,
                'numero' => $numero,
                'contato' => $contato,
                'parentescoDoContato' => $parentescoDoContato,                
                'usuarioId' => $usuarioId,
                'status' => $status
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }
    }
?>