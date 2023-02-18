<?php
    class NumeroController extends CI_Controller{

        public function index(){
            
            $this->load->model('Numero');       

            $tabela = $this->Numero->buscarTodosOsNumeros();
            
            $dados = array(
                'titulo'=>'Cadastro de Numeros',
                'tabela'=> $tabela,
                'pagina'=>'numero/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoNumero()       {
            
            $dados = array(
                'titulo' => 'Cadastro de numeros',
                'pagina' => 'numero/formularioNovoNumero.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoNumero(){
           
            $this->load->model('Numero');

            $numero = array(
                'valor' => $this->input->post('valor'),
            );

            $this->Numero->criarNumero($numero);

            redirect('numerocontroller');       
        }

        public function formularioAlterarNumero($codigo){                
            
            $this->load->model("Numero");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Numero->buscarNumeroPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Numero',
                'pagina'=>'numero/formularioAlterarNumero.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarNumero(){

            $valor = $this->input->post('valor');
            
            $numero = array(
                'valor' => $valor,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Numero');

            $this->Numero->atualizarNumero($where,$numero);

            redirect('numerocontroller');
        }

        public function deletarNumero($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Numero');

            $this->Numero->deletarNumeroPorId($where);

            redirect('numerocontroller');
        }

    }
