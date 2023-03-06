<?php

    class Login extends CI_Model{

        public function verificarEmail($where){

            $resultado = $this->db->get_where('usuario',$where);

            return $resultado->result();
        }

        public function verificarSenha($where){
            
            $resultado = $this->db->get_where('usuario',$where);   
            
            return $resultado->result();
        }

    }


?>