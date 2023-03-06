<?php
    class CidadeController extends CI_Controller{

        public function index(){
            
            $this->listarCidades();
            
        }

        public function listarCidades($apartirDoIndiceDoVetor = 0){

            $quantidadesDeRegistrosParaMostrar = 10;

            $this->load->model('Cidade');       

            $tabela = $this->Cidade->buscarTodasAsCidades(
                $quantidadesDeRegistrosParaMostrar, 
                ($apartirDoIndiceDoVetor * 10));

            $count = $this->Cidade->quantidadeDeRegistros();

            $dados = array(
                'titulo'=>'Cadastro de Cidades',
                'tabela'=> $tabela,
                'pagina'=>'cidade/index.php',
                'apartirDoIndiceDoVetor'=> $apartirDoIndiceDoVetor,
                'count'=> $count
            );
            
            $this->load->view('index',$dados);

        }

        public function formularioNovoCidade()       {           

            $this->load->model('Estado');
            $qtdRegistros = $this->Estado->quantidadeDeRegistros();
            $estados = $this->Estado->buscarTodosOsEstados(((int)$qtdRegistros));

            $dados = array(
                'titulo' => 'Cadastro de cidades',
                'pagina' => 'cidade/formularioNovoCidade.php',
                'estados'=>$estados,
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoCidade(){
           
            

            $cidade = array(
                'nome' => $this->input->post('nome'),
                'estadoId' => $this->input->post('estadoId')
            );

            $this->load->model('Cidade');
            $this->Cidade->criarCidade($cidade);

            redirect('cidadecontroller');       
        }

        public function formularioAlterarCidade($codigo){                
            
            $this->load->model("Cidade");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Cidade->buscarCidadePorId($where);

            $this->load->model('Estado');
            $qtdRegistros = $this->Estado->quantidadeDeRegistros();
            $estados = $this->Estado->buscarTodosOsEstados(((int)$qtdRegistros));
            
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
