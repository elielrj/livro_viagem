<?php
    class Cidade extends CI_Model {

        public $id;
        public $nome;
        public $estadoId;
        
         public function criarCidade($cidade)
        {
            $this->db->insert('cidade', $cidade);
            return;
        }
        
        public function atualizarCidade($where, $cidade)
        {
            $this->db->update('cidade', $cidade, $where);
            return;
        }
        
        public function buscarTodasAsCidades(){
            
            $retorno = $this->db->get('cidade',100);
            
            return $retorno->result();
        }
        
        public function buscarCidadePorId($where)
        {
            
            $retorno = $this->db->get_where('cidade', $where);

            return $retorno->result();
        }
        
        
        public function deletarCidadePorId($where)
        {
            $this->db->delete('cidade',$where);
            return;
        }
    }
?>