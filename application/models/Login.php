<?php

class Login{

    public $email;
    public $senha;

    public function criarLogin($login){
        $this->db->insert('login',$login);
        return;
    }

    public function atualizarUsuario($where, $Login)
    {
        $this->db->update('login', $login, $where);
        return;
    }
    
    public function buscarTodasAsLogins(){
        
        $retorno = $this->db->get('login',100);
        
        return $retorno->result();
    }
    
    public function buscarLoginPorId($where)
    {
        
        $retorno = $this->db->get_where('login', $where);

        return $retorno->result();
    }
    
    
    public function deletarLoginPorId($where)
    {
        $this->db->delete('login',$where);
        return;
    }
}
    
?>