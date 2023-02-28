<?php

    class Login extends CI_Model{

        public $email;
        public $senha;

        public function buscarLoginPorEmail($where){
            
            $retorno = $this->db->get_where('usuario', $where);

            return $retorno->result();
        }
    }

?>