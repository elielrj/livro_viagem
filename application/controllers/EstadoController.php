<?php
    class EstadoController extends CI_Controller{

        public function index(){
            
            $this->load->model('Estado');       

            $tabela = $this->Estado->buscarTodosOsEstados();
            
            $dados = array(
                'titulo'=>'Cadastro de Estados',
                'tabela'=> $tabela,
                'pagina'=>'estado/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoEstado()       {
            
            $dados = array(
                'titulo' => 'Cadastro de estados',
                'pagina' => 'estado/formularioNovoEstado.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoEstado(){
           
            $this->load->model('Estado');

            $estado = array(
                'nome' => $this->input->post('nome'),
                'sigla' => $this->input->post('sigla')
            );

            $this->Estado->criarEstado($estado);

            redirect('estadocontroller');       
        }

        public function formularioAlterarEstado($codigo){                
            
            $this->load->model("Estado");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Estado->buscarEstadoPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Estado',
                'pagina'=>'estado/formularioAlterarEstado.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarEstado(){

            $nome = $this->input->post('nome');
            $sigla = $this->input->post('sigla');
            
            $estado = array(
                'nome' => $nome,
                'sigla' => $sigla
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Estado');

            $this->Estado->atualizarEstado($where,$estado);

            redirect('estadocontroller');
        }

        public function deletarEstado($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Estado');

            $this->Estado->deletarEstadoPorId($where);

            redirect('estadocontroller');
        }

    }
