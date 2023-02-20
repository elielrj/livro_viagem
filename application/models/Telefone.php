<?php
    class Telefone extends CI_Model{

        public $id;
        public $numero;
        public $parentescoDoContato;
        public $contatoDeEmergencia;
        public $contatoDeLocalizacao;
        public $usuarioId;
        
         public function criarTelefone($telefone)
        {
            $this->db->insert('telefone', $telefone);
            return;
        }
        
        public function atualizarTelefone($where, $telefone)
        {
            $this->db->update('telefone', $telefone, $where);
            return;
        }
        
        public function buscarTodosOsTelefones(){
            
            $retorno = $this->db->get('telefone',100);           
            
            return $retorno->result();
        }
        
        public function buscarTelefonePorId($where)
        {
            
            $retorno = $this->db->get_where('telefone', $where);

            return $retorno->result();
        }
        
        
        public function deletarTelefonePorId($where)
        {
            $this->db->delete('telefone',$where);
            return;
        } 
    }
?>