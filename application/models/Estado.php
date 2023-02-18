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
            
            return $retorno->result();
        }
        
        public function buscarEstadoPorId($where)
        {
            
            $retorno = $this->db->get_where('estado', $where);

            return $retorno->result();
        }
        
        
        public function deletarEstadoPorId($where)
        {
            $this->db->delete('estado',$where);
            return;
        } 
    }
?>