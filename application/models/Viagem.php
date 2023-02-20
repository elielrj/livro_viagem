<?php
    class Viagem extends CI_Model{

        public $id;
        public $aprovado;
        public $motivo;
        public $territorio;
        
         public function criarViagem($viagem)
        {
            $this->db->insert('viagem', $viagem);
            return;
        }
        
        public function atualizarViagem($where, $viagem)
        {
            $this->db->update('viagem', $viagem, $where);
            return;
        }
        
        public function buscarTodosOsViagems(){
            
            $retorno = $this->db->get('viagem',100);           
            
            return $retorno->result();
        }
        
        public function buscarViagemPorId($where)
        {
            
            $retorno = $this->db->get_where('viagem', $where);

            return $retorno->result();
        }
        
        
        public function deletarViagemPorId($where)
        {
            $this->db->delete('viagem',$where);
            return;
        } 
    }
?>