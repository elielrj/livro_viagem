<?php
    class Estado extends CI_Model{

        public $id;
        public $nome;
        public $sigla;
        
         public function criarEstado($estado)
        {
            $this->db->insert('estado', $estado);
            return;
        }
        
        public function atualizarEstado($where, $estado)
        {
            $this->db->update('estado', $estado, $where);
            return;
        }
        
        public function buscarTodosOsEstados(){
            
            $retorno = $this->db->get('estado',100);        
            
            $listaDeEstados = array();
            
            foreach($retorno->result() as $estado){
                
                $novoEstado = new Estado();

                $novoEstado->id = $estado->id;
                $novoEstado->nome = $estado->nome;
                $novoEstado->sigla = $estado->sigla;

                array_push($listaDeEstados,$novoEstado);

            }
            
            return $listaDeEstados;
        }
        
        public function buscarEstadoPorId($where)
        {
            $retorno = $this->db->get_where('estado', $where);

            foreach($retorno->result() as $estado){
                
                $novoEstado= new Estado();
                
                $novoEstado->id = $estado->id;
                $novoEstado->nome = $estado->nome;
                $novoEstado->sigla = $estado->sigla;
            }

            return $novoEstado;
        }
        
        
        public function deletarEstadoPorId($where)
        {
            $this->db->delete('estado',$where);
            return;
        } 
    }
?>