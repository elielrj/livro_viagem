<?php
    class ViagemController extends CI_Controller{

        public function index(){
            
    
            $this->load->model('Viagem');       

            $tabela = $this->Viagem->buscarTodosOsViagems();
            
            $dados = array(
                'titulo'=>'Cadastro de Viagems',
                'tabela'=> $tabela,
                'pagina'=>'viagem/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoViagem()       {
            
            $dados = array(
                'titulo' => 'Cadastro de viagems',
                'pagina' => 'viagem/formularioNovoViagem.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoViagem(){
           
            $this->load->model('Viagem');

            $viagem = array(
                'aprovada' => false,
                'territorio' => $this->input->post('territorio'),
                'motivo' => $this->input->post('motivo'),
                'usuarioId' => $this->input->post('usuarioId'),
                'enderecoId' => $this->input->post('enderecoId'),
            );

            $this->Viagem->criarViagem($viagem);

            redirect('viagemcontroller');       
        }

        public function formularioAlterarViagem($codigo){                
            
            $this->load->model("Viagem");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Viagem->buscarViagemPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Viagem',
                'pagina'=>'viagem/formularioAlterarViagem.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarViagem(){

            $aprovada = $this->input->post('aprovada');
            $territorio = $this->input->post('territorio');
            $motivo = $this->input->post('motivo');
            $usuarioId = $this->input->post('usuarioId');
            $enderecoId = $this->input->post('enderecoId');
            
            $viagem = array(
                'aprovada' => $aprovada,
                'territorio' => $territorio,
                'motivo' => $motivo,
                'usuarioId' => $usuarioId,
                'enderecoId' => $enderecoId,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Viagem');

            $this->Viagem->atualizarViagem($where,$viagem);

            redirect('viagemcontroller');
        }

        public function deletarViagem($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Viagem');

            $this->Viagem->deletarViagemPorId($where);

            redirect('viagemcontroller');
        }

    }
