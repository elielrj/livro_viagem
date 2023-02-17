<?php
    class EstadoModel extends CI_Model{

        private $id;
        private $nome;
        private $sigla;
        
        public function __construct($id,$nome,$sigla){
            $this->id = $id;
            $this->nome = $nome;
            $this->sigla = $sigla;
        }

        public function  __get($key){
            return $this->{$key};
        }

        public function __set($key,$value){

            $this->{$key} = $value;
        }
    }
?>