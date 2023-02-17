<?php
    class Estado extends CI_Controller{

        public function index(){
            
            $this->load->model('EstadoModel');

            $tabela = $this->EstadoModel->SelecionaTodos();

            $dados = array(
                'titulo'=>'Cadastro de Estados',
                'tabela'=>$tabela,
                'pagina'=>'estado/index.php'
            );

            $this->load->view('index',$dados);
        }

        public function Novo()
        {
            $dados = array(
                'titulo' => 'Cadastro de estados',
                'pagina' => 'estado/novo.php',
            );

            $this->load->view('index', $dados);
        }

        public function Incluir(){
           
            $this->load->model('EstadoModel');
            $this->EstadoModel->Novo();

            redirect('estado');
       
        }

        public function Alterar($codigo){
            
            $this->load->model("EstadoModel");

            $where = array('idestado'=>$codigo);

            $resultado = $this->EstadoModel->Selecionar($where);

            $dados = array(
                'titulo'=>'Alteração do Estado',
                'pagina'=>'estado/alterar.php',
                'tabela'=>$resultado
            );

            $this->load->view('index',$dados);
        }

        public function SalvarAlteracao(){
            $idestado = $this->input->post('idestado');
            $nome = $this->input->post('nome');
            $sigla = $this->input->post('sigla');

            $dados = array(
                'nome'=>$nome,
                'sigla'=>$sigla
            );

            $where = array(
                    'idestado' => $idestado
                );

            $this->load->model('EstadoModel');

            $this->EstadoModel->SalvarAlteracao($where,$dados);

            redirect('estado');
        }

    }

    
?>