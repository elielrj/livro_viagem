<?php
    class TelefoneController extends CI_Controller{

        public function index(){
            
            $this->load->model('Telefone');       

            $tabela = $this->Telefone->buscarTodosOsTelefones();
            
            $dados = array(
                'titulo'=>'Cadastro de Telefones',
                'tabela'=> $tabela,
                'pagina'=>'telefone/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoTelefone()       {
            
            $dados = array(
                'titulo' => 'Cadastro de telefones',
                'pagina' => 'telefone/formularioNovoTelefone.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoTelefone(){
           
            $this->load->model('Telefone');

            $telefone = array(
                'numero' => $this->input->post('numero'),
                'parentescoDoContato' => $this->input->post('parentescoDoContato'),
                'contatoDeEmergencia' => $this->input->post('contatoDeEmergencia'),
                'contatoDeLocalizacao' => $this->input->post('contatoDeLocalizacao'),
                'usuarioId' => $this->input->post('usuarioId'),
            );

            $this->Telefone->criarTelefone($telefone);

            redirect('telefonecontroller');       
        }

        public function formularioAlterarTelefone($codigo){                
            
            $this->load->model("Telefone");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Telefone->buscarTelefonePorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Telefone',
                'pagina'=>'telefone/formularioAlterarTelefone.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarTelefone(){

            $numero = $this->input->post('numero');
            $parentescoDoContato = $this->input->post('parentescoDoContato');
            $contatoDeEmergencia = $this->input->post('contatoDeEmergencia');
            $contatoDeLocalizacao = $this->input->post('contatoDeLocalizacao');
            $usuarioId = $this->input->post('usuarioId');
            
            $telefone = array(
                'numero' =>  $numero,
                'parentescoDoContato' => $parentescoDoContato,
                'contatoDeEmergencia' => $contatoDeEmergencia,
                'contatoDeLocalizacao' => $contatoDeLocalizacao,
                'usuarioId' => $usuarioId,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Telefone');

            $this->Telefone->atualizarTelefone($where,$telefone);

            redirect('telefonecontroller');
        }

        public function deletarTelefone($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Telefone');

            $this->Telefone->deletarTelefonePorId($where);

            redirect('telefonecontroller');
        }

    }
