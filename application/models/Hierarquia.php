<?php
    class Hierarquia extends CI_Model{

        public $id;
        public $postoOuGraduacao;
        public $sigla;
        
         public function criarHierarquia($hierarquia)
        {
            $this->db->insert('hierarquia', $hierarquia);
            return;
        }
        
        public function atualizarHierarquia($where, $hierarquia)
        {
            $this->db->update('hierarquia', $hierarquia, $where);
            return;
        }
        
        public function buscarTodosOsHierarquias(){
            
            $retorno = $this->db->get('hierarquia',100);           
            
            return $retorno->result();
        }
        
        public function buscarHierarquiaPorId($where)
        {
            
            $retorno = $this->db->get_where('hierarquia', $where);

            return $retorno->result();
        }
        
        
        public function deletarHierarquiaPorId($where)
        {
            $this->db->delete('hierarquia',$where);
            return;
        } 
    }
?>