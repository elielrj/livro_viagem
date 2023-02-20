<?php
    class Usuario extends CI_Model {

        public $id;
        public $nome;
        public $status;
        public $dataDeCriacao;
        public $ultimoAcesso;
        public $hierarquiaId;
        public $email;
        public $senha;
        
         public function criarUsuario($usuario)
        {
            $this->db->insert('usuario', $usuario);
            return;
        }
        
        public function atualizarUsuario($where, $usuario)
        {
            $this->db->update('usuario', $usuario, $where);
            return;
        }
        
        public function buscarTodasAsUsuarios(){
            
            $retorno = $this->db->get('usuario',100);
            
            return $retorno->result();
        }
        
        public function buscarUsuarioPorId($where)
        {
            
            $retorno = $this->db->get_where('usuario', $where);

            return $retorno->result();
        }
        
        
        public function deletarUsuarioPorId($where)
        {
            $this->db->delete('usuario',$where);
            return;
        }
    }
?>