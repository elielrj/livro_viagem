<?php
    class Numero extends CI_Model{

        public $id;
        public $valor;
        
         public function criarNumero($numero)
        {
            $this->db->insert('numero', $numero);
            return;
        }
        
        public function atualizarNumero($where, $numero)
        {
            $this->db->update('numero', $numero, $where);
            return;
        }
        
        public function buscarTodosOsNumeros(){
            
            $retorno = $this->db->get('numero',100);           
            
            return $retorno->result();
        }
        
        public function buscarNumeroPorId($where)
        {
            
            $retorno = $this->db->get_where('numero', $where);

            return $retorno->result();
        }
        
        
        public function deletarNumeroPorId($where)
        {
            $this->db->delete('numero',$where);
            return;
        } 
    }
?>