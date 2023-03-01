<?php
    class Cidade extends CI_Model {

        public $id;
        public $nome;
        public $estado;
        
         public function criarCidade($cidade)
        {
            $this->db->insert('cidade', $cidade);
            return;
        }
        
        public function atualizarCidade($where, $cidade)
        {
            $this->db->update('cidade', $cidade, $where);
            return;
        }
        
        public function buscarTodasAsCidades(
            $quantidadesDeRegistrosParaMostrar,
            $apartirDoIndiceDoVetor){
            
            $retorno = $this->db->get(
                'cidade',
                $quantidadesDeRegistrosParaMostrar, 
                $apartirDoIndiceDoVetor); 

            $listaDeCidades = array();

            $this->load->model('Estado');
            foreach($retorno->result() as $cidade){

                $novaCidade = new Cidade();

                $novaCidade->id = $cidade->id;
                $novaCidade->nome = $cidade->nome;

           
                
                $whare = array('id' => $cidade->estadoId);

                $estado = $this->Estado->buscarEstadoPorId($whare);

                $novaCidade->estado = $estado;

                array_push($listaDeCidades,$novaCidade);
            }
            
            return $listaDeCidades;
        }
        
        public function buscarCidadePorId($where)
        {
            
            $retorno = $this->db->get_where('cidade', $where);

            
            $novaCidade = new Cidade();
            foreach($retorno->result() as $cidade){

                $novaCidade->id = $cidade->id;
                $novaCidade->nome = $cidade->nome;

                $this->load->model('Estado');

                $where = array('id' => $cidade->estadoId);

                $novaCidade->estado = $this->Estado->buscarEstadoPorId($where);
            }

            return $novaCidade;
        }
        
        
        public function deletarCidadePorId($where)
        {
            $this->db->delete('cidade',$where);
            return;
        }

        public function quantidadeDeRegistros(){
            return $this->db->count_all_results('cidade');
        }
    }
?>