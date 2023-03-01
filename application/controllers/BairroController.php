<?php
    class BairroController extends CI_Controller{

        public function index(){
            
            $this->listarBairros();
            
        }

        public function listarBairros($apartirDoIndiceDoVetor = 0){

            $quantidadesDeRegistrosParaMostrar = 10;

            $this->load->model('Bairro');       

            $tabela = $this->Bairro->buscarTodosOsBairros(
                $quantidadesDeRegistrosParaMostrar, 
                ($apartirDoIndiceDoVetor * 10));

            $count = $this->Bairro->quantidadeDeRegistros();
            
            $dados = array(
                'titulo'=>'Cadastro de Bairros',
                'tabela'=> $tabela,
                'pagina'=>'bairro/index.php',
                'apartirDoIndiceDoVetor'=> $apartirDoIndiceDoVetor,
                'count'=> $count
            );
            
            $this->load->view('index',$dados);

        }

        public function formularioNovoBairro()       {
            
            $dados = array(
                'titulo' => 'Cadastro de bairros',
                'pagina' => 'bairro/formularioNovoBairro.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoBairro(){
           
            $this->load->model('Bairro');

            $bairro = array(
                'nome' => $this->input->post('nome'),
                'cidadeId' => $this->input->post('cidadeId')
            );

            $this->Bairro->criarBairro($bairro);

            redirect('bairrocontroller');       
        }

        public function formularioAlterarBairro($codigo){                
            
            $this->load->model("Bairro");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Bairro->buscarBairroPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Bairro',
                'pagina'=>'bairro/formularioAlterarBairro.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarBairro(){

            $nome = $this->input->post('nome');
            $cidadeId = $this->input->post('cidadeId');
            
            $bairro = array(
                'nome' => $nome,
                'cidadeId' => $cidadeId
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Bairro');

            $this->Bairro->atualizarBairro($where,$bairro);

            redirect('bairrocontroller');
        }

        public function deletarBairro($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Bairro');

            $this->Bairro->deletarBairroPorId($where);

            redirect('bairrocontroller');
        }
        
       

    }
