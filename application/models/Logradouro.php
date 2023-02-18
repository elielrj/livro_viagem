<?php
    class Logradouro extends CI_Model {

        public $id;
        public $nome;
        public $bairroId;
        
         public function criarLogradouro($logradouro)
        {
            $this->db->insert('logradouro', $logradouro);
            return;
        }
        
        public function atualizarLogradouro($where, $logradouro)
        {
            $this->db->update('logradouro', $logradouro, $where);
            return;
        }
        
        public function buscarTodasAsLogradouros(){
            
            $retorno = $this->db->get('logradouro',100);
            
            return $retorno->result();
        }
        
        public function buscarLogradouroPorId($where)
        {
            
            $retorno = $this->db->get_where('logradouro', $where);

            return $retorno->result();
        }
        
        
        public function deletarLogradouroPorId($where)
        {
            $this->db->delete('logradouro',$where);
            return;
        }
    }
?>