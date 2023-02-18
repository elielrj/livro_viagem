<?php
    class Bairro extends CI_Model {

        public $id;
        public $nome;
        public $bairroId;
        
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
        
        public function buscarTodasAsBairros(){
            
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