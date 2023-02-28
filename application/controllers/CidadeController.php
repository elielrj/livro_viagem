<?php
    class CidadeController extends CI_Controller{

        public function index(){
            
            $this->load->model('Cidade');       

            $tabela = $this->Cidade->buscarTodasAsCidades();

            $dados = array(
                'titulo'=>'Cadastro de Cidades',
                'tabela'=> $tabela,
                'pagina'=>'cidade/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoCidade()       {
            
            $dados = array(
                'titulo' => 'Cadastro de cidades',
                'pagina' => 'cidade/formularioNovoCidade.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoCidade(){
           
            $this->load->model('Cidade');

            $cidade = array(
                'nome' => $this->input->post('nome'),
                'estadoId' => $this->input->post('estadoId')
            );

            $this->Cidade->criarCidade($cidade);

            redirect('cidadecontroller');       
        }

        public function formularioAlterarCidade($codigo){                
            
            $this->load->model("Cidade");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Cidade->buscarCidadePorId($where);

            $this->load->model('Estado');
            $estados = $this->Estado->buscarTodosOsEstados();
            
            $dados = array(
                'titulo'=>'Alteração do Cidade',
                'pagina'=>'cidade/formularioAlterarCidade.php',
                'tabela'=> $tabela,
                'estados'=>$estados,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarCidade(){

            $nome = $this->input->post('nome');
            $estadoId = $this->input->post('estadoId');
            
            $cidade = array(
                'nome' => $nome,
                'estadoId' => $estadoId
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Cidade');

            $this->Cidade->atualizarCidade($where,$cidade);

            redirect('cidadecontroller');
        }

        public function deletarCidade($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Cidade');

            $this->Cidade->deletarCidadePorId($where);

            redirect('cidadecontroller');
        }
        
       

    }
