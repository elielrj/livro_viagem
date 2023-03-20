<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Viagem_Model extends CI_Model{

        public static $TABELA_DB = 'viagem';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($viagem){
            $this->db->insert(
                self::$TABELA_DB, 
                $viagem);
        }
        
        public function update($viagem){

            $this->db->update(
                self::$TABELA_DB,
                $viagem, 
                array('id'=> $viagem['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoViagem($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoViagem($resultado->result());
        }

        
        public function retriveUsuarioId($usuarioId){
            
            $resultado = 
            $this->db
                ->where('usuarioId',$usuarioId)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB); 
            
            return $this->montarObjetoViagem($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoViagem($result){

            $listaDeViagens = array();
            
            foreach($result as $linha){
                
                $viagem = $this->viagem(
                    $linha->id,
                    $linha->aprovada,
                    $linha->territorio,
                    $linha->motivo,
                    $linha->usuarioId,
                    $linha->enderecoId,
                    $linha->dataIda,
                    $linha->dataVolta,
                    $linha->observacao,
                );

                array_push($listaDeViagens, $viagem);
           }
            return $listaDeViagens;
        }
        
        public function viagem(
            $id,
            $aprovada,
            $territorio,
            $motivo,
            $usuarioId,
            $enderecoId,
            $dataIda,
            $dataVolta,
            $observacao){            
        
            return array(
                'id' => $id,
                'aprovada' => $aprovada,
                'territorio' => $territorio,
                'motivo' => $motivo,
                'usuarioId' => $usuarioId,
                'enderecoId' => $enderecoId,
                'dataIda' => $dataIda,
                'dataVolta' => $dataVolta,
                'observacao' => $observacao,
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }


    }
?>