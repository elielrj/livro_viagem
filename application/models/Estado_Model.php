<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Estado_Model extends CI_Model{

        public static $TABELA_DB = 'estado';

        public function __construct(){
            parent::__construct();
        }

        public function create($estado){

            $this->db->insert(
                self::$TABELA_DB, 
                $estado);        
        }

        public function update($estado){

            $this->db->update(
                self::$TABELA_DB, 
                $estado, 
                array('id'=> $estado['id'])
            );        
        }

        public function retrive($indiceInicial,$mostrar){
            
            $resultado = 
            $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            );   
            
            return $this->montarObjetoEstado($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoEstado($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoEstado($result){

            $listaDeEstados = array();

            foreach($result as $linha){
                $estado = $this->estado(
                    $linha->id,
                    $linha->nome,
                    $linha->sigla
                );

                array_push($listaDeEstados, $estado);
           }
            return $listaDeEstados;
        }

        public function estado($id,$nome,$sigla){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'sigla' => $sigla
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }
    }


?>