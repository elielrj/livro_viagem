<?php
    class Bairro extends CI_Model {

        public $id;
        public $nome;
        public $cidade;
        
         public function criarBairro($bairro)
        {
            $this->db->insert('bairro', $bairro);
            return;
        }
        
        public function atualizarBairro($where, $bairro)
        {
            $this->db->update('bairro', $bairro, $where);
            return;
        }
        
        public function buscarTodosOsBairros(
            $quantidadesDeRegistrosParaMostrar,
            $apartirDoIndiceDoVetor){
            
            $retorno = $this->db->get(
                'bairro',
                $quantidadesDeRegistrosParaMostrar, 
                $apartirDoIndiceDoVetor);

            $listaDeBairros = array();

            $this->load->model('Cidade');
            foreach($retorno->result() as $bairro){

                $novoBairro = new Bairro();

                $novoBairro->id = $bairro->id;
                $novoBairro->nome = $bairro->nome;

                $where = array('id' => $bairro->cidadeId);

                $cidade = $this->Cidade->buscarCidadePorId($where);

                $novoBairro->cidade = $cidade;

                array_push($listaDeBairros,$novoBairro);
            }
            
            return $listaDeBairros;
        }
        
        public function buscarBairroPorId($where)
        {
            
            $retorno = $this->db->get_where('bairro', $where);

            return $retorno->result();
        }
        
        
        public function deletarBairroPorId($where)
        {
            $this->db->delete('bairro',$where);
            return;
        }

        public function quantidadeDeRegistros(){
            return $this->db->count_all_results('bairro');
        }
    }
?>