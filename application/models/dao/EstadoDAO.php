<?php

    include('application/models/bo/EstadoModel.php');

    class EstadoDAO extends CI_Model{

        public function create($estado)
        {
            $this->db->insert('estado', $estado);
            return;
        }

        public function update($where, $estado)
        {
            $this->db->update('estado', $estado, $where);

            return;
        }

        public function retrive(){

            $retorno = $this->db->get('estado',100);

            $listaDeEstados = [];
            foreach($retorno->result() as $linha){
                $estadoModel = new EstadoModel($linha->id, $linha->nome, $linha->sigla);
                array_push($listaDeEstados, $estadoModel);
            }
          
            return $listaDeEstados;
        }

        public function retriveIdEstado($where)
        {
            $retorno = $this->db->get_where('estado', $where);

            foreach($retorno->result() as $linha){
                $estadoModel = new EstadoModel($linha->id, $linha->nome, $linha->sigla);
                return $estadoModel;
            }
        }      

        public function delete($where)
        {
            $this->db->delete('estado',$where);
            return;
        }
    }
