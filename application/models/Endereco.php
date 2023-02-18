<?php
    class Endereco extends CI_Model {

        public $id;
        public $nome;
        public $logradouroId;
        public $numeroId;
        
         public function criarEndereco($endereco)
        {
            $this->db->insert('endereco', $endereco);
            return;
        }
        
        public function atualizarEndereco($where, $endereco)
        {
            $this->db->update('endereco', $endereco, $where);
            return;
        }
        
        public function buscarTodosOsEnderecos(){
            
            $retorno = $this->db->get('endereco',100);
            
            return $retorno->result();
        }
        
        public function buscarEnderecoPorId($where)
        {
            
            $retorno = $this->db->get_where('endereco', $where);

            return $retorno->result();
        }
        
        
        public function deletarEnderecoPorId($where)
        {
            $this->db->delete('endereco',$where);
            return;
        }
    }
?>