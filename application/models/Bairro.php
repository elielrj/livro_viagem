<?php
    class Bairro extends CI_Model {

        public $id;
        public $nome;
        public $cidadeId;
        
         public function criarBairro($bairro)
        {
            $this->db->insert('bairro', $bairro);
            return;
        }
        
        public function atualizarBairro($where, $bairro)
        {
            $this->db->update('bairro', $bairro, $where);
            return;
        }
        
        public function buscarTodosOsBairros(){
            
            $retorno = $this->db->get('bairro',100);
            
            return $retorno->result();
        }
        
        public function buscarBairroPorId($where)
        {
            
            $retorno = $this->db->get_where('bairro', $where);

            return $retorno->result();
        }
        
        
        public function deletarBairroPorId($where)
        {
            $this->db->delete('bairro',$where);
            return;
        }
    }
?>