<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Endereco_Model extends CI_Model {

        public static $TABELA_DB = 'endereco';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($endereco){

            $this->db->insert(
                self::$TABELA_DB, 
                $endereco);
        }
        
        public function update($endereco){

            $this->db->update(
                self::$TABELA_DB,
                $endereco, 
                array('id'=> $endereco['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoEndereco($resultado->result());
        }
        
        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoEndereco($resultado->result());
        }

        public function retriveEstadoId($estadoId){
            
            $resultado = 
            $this->db
                ->where('estadoId',$estadoId)
                ->order_by('nome')
                ->get(self::$TABELA_DB); 
            
            return $this->montarObjetoEndereco($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }
        
        public function montarObjetoEndereco($result){

            $listaDeEnderecos = array();

            foreach($result as $linha){
                $endereco = $this->endereco(
                    $linha->id,
                    $linha->nome,
                    $linha->logradouro,
                    $linha->numero,
                    $linha->bairroId
                );

                array_push($listaDeEnderecos, $endereco);
           }
            return $listaDeEnderecos;
        }
        
        public function endereco($id,$nome,$logradouro,$numero,$bairroId){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'logradouro' => $logradouro,
                'numero' => $numero,
                'bairroId' => $bairroId
            );
        }
        
        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }
    }
?>