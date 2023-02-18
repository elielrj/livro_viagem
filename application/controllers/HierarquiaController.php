<?php
    class HierarquiaController extends CI_Controller{

        public function index(){
            
            $this->load->model('Hierarquia');       

            $tabela = $this->Hierarquia->buscarTodosOsHierarquias();
            
            $dados = array(
                'titulo'=>'Cadastro de Hierarquias',
                'tabela'=> $tabela,
                'pagina'=>'hierarquia/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoHierarquia()       {
            
            $dados = array(
                'titulo' => 'Cadastro de hierarquias',
                'pagina' => 'hierarquia/formularioNovoHierarquia.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoHierarquia(){
           
            $this->load->model('Hierarquia');

            $hierarquia = array(
                'postoOuGraduacao' => $this->input->post('postoOuGraduacao'),
                'sigla' => $this->input->post('sigla'),
            );

            $this->Hierarquia->criarHierarquia($hierarquia);

            redirect('hierarquiacontroller');       
        }

        public function formularioAlterarHierarquia($codigo){                
            
            $this->load->model("Hierarquia");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Hierarquia->buscarHierarquiaPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Hierarquia',
                'pagina'=>'hierarquia/formularioAlterarHierarquia.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarHierarquia(){

            $postoOuGraduacao = $this->input->post('postoOuGraduacao');
            $sigla = $this->input->post('sigla');
            
            $hierarquia = array(
                'postoOuGraduacao' => $postoOuGraduacao,
                'sigla' => $sigla,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Hierarquia');

            $this->Hierarquia->atualizarHierarquia($where,$hierarquia);

            redirect('hierarquiacontroller');
        }

        public function deletarHierarquia($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Hierarquia');

            $this->Hierarquia->deletarHierarquiaPorId($where);

            redirect('hierarquiacontroller');
        }

    }
