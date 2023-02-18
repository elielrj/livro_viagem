<?php
    class EnderecoController extends CI_Controller{

        public function index(){
            
            $this->load->model('Endereco');       

            $tabela = $this->Endereco->buscarTodosOsEnderecos();
            
            $dados = array(
                'titulo'=>'Cadastro de Enderecos',
                'tabela'=> $tabela,
                'pagina'=>'endereco/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoEndereco()       {
            
            $dados = array(
                'titulo' => 'Cadastro de enderecos',
                'pagina' => 'endereco/formularioNovoEndereco.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoEndereco(){
           
            $this->load->model('Endereco');

            $endereco = array(
                'nome' => $this->input->post('nome'),
                'logradouroId' => $this->input->post('logradouroId'),
                'numeroId' => $this->input->post('numeroId'),
            );

            $this->Endereco->criarEndereco($endereco);

            redirect('enderecocontroller');       
        }

        public function formularioAlterarEndereco($codigo){                
            
            $this->load->model("Endereco");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Endereco->buscarEnderecoPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Endereco',
                'pagina'=>'endereco/formularioAlterarEndereco.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarEndereco(){

            $nome = $this->input->post('nome');
            $logradouroId = $this->input->post('logradouroId');
            $numeroId = $this->input->post('numeroId');
            
            $endereco = array(
                'nome' => $nome,
                'logradouroId' => $logradouroId,
                'numeroId' => $numeroId,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Endereco');

            $this->Endereco->atualizarEndereco($where,$endereco);

            redirect('enderecocontroller');
        }

        public function deletarEndereco($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Endereco');

            $this->Endereco->deletarEnderecoPorId($where);

            redirect('enderecocontroller');
        }
        
       

    }
