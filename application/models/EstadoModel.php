<?php
    class EstadoModel extends CI_Model{


        public $idestado;
        public $nome;
        public $sigla;

        public function SelecionaTodos(){

            $retorno = $this->db->get('estado',100);

            return $retorno->result();
        }

        public function  Novo(){
            $campos = array(
                'nome' => $_POST['nome'],
                'sigla' => $_POST['sigla']
            );

            $this->db->insert('estado', $campos);
        }

        public function Selecionar($where){

            $retorno = $this->db->get_where('estado',$where);

            return $retorno->result();
        }

        public function SalvarAlteracao($where,$dados){
            $this->db->update('estado',$dados,$where);

            return;
        }
    }
?>