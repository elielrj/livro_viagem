<?php
    class LogradouroController extends CI_Controller{

        public function index(){
            
            $this->load->model('Logradouro');       

            $tabela = $this->Logradouro->buscarTodosOsLogradouros();
            
            $dados = array(
                'titulo'=>'Cadastro de Logradouros',
                'tabela'=> $tabela,
                'pagina'=>'logradouro/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoLogradouro()       {
            
            $dados = array(
                'titulo' => 'Cadastro de logradouros',
                'pagina' => 'logradouro/formularioNovoLogradouro.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoLogradouro(){
           
            $this->load->model('Logradouro');

            $logradouro = array(
                'nome' => $this->input->post('nome'),
                'bairroId' => $this->input->post('bairroId')
            );

            $this->Logradouro->criarLogradouro($logradouro);

            redirect('logradourocontroller');       
        }

        public function formularioAlterarLogradouro($codigo){                
            
            $this->load->model("Logradouro");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Logradouro->buscarLogradouroPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Logradouro',
                'pagina'=>'logradouro/formularioAlterarLogradouro.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarLogradouro(){

            $nome = $this->input->post('nome');
            $bairroId = $this->input->post('bairroId');
            
            $logradouro = array(
                'nome' => $nome,
                'bairroId' => $bairroId
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Logradouro');

            $this->Logradouro->atualizarLogradouro($where,$logradouro);

            redirect('logradourocontroller');
        }

        public function deletarLogradouro($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Logradouro');

            $this->Logradouro->deletarLogradouroPorId($where);

            redirect('logradourocontroller');
        }
        
       

    }
