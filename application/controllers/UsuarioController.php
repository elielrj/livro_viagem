<?php
    class UsuarioController extends CI_Controller{

        public function index(){
            
            $this->load->model('Usuario');       

            $tabela = $this->Usuario->buscarTodasAsUsuarios();
            
            $dados = array(
                'titulo'=>'Cadastro de Usuários',
                'tabela'=> $tabela,
                'pagina'=>'usuario/index.php'
            );
            
            $this->load->view('index',$dados);
        }

        public function formularioNovoUsuario()       {
            
            $dados = array(
                'titulo' => 'Cadastro de usuários',
                'pagina' => 'usuario/formularioNovoUsuario.php',
            );

            $this->load->view('index', $dados);
        }

        public function incluirNovoUsuario(){
           
            $this->load->model('Usuario');
            
            $this->load->helper('date');
            $timestamp = now('America/Sao_Paulo');
            $datestring = '%Y-%m-%d %h:%i:%a';
            $dataHoraAgora = mdate($datestring,$timestamp);

            $usuario = array(
                'nome' => $this->input->post('nome'),
                'status' => true,
                'dataDeCriacao' => $dataHoraAgora,
                'ultimoAcesso' => $dataHoraAgora,
                'hierarquiaId' => $this->input->post('hierarquiaId'),
                'email' => $this->input->post('email'),
                'senha' => $this->input->post('senha'),
            );

            $this->Usuario->criarUsuario($usuario);

            redirect('usuariocontroller');       
        }

        public function formularioAlterarUsuario($codigo){                
            
            $this->load->model("Usuario");
            
            $where = array('id'=>$codigo);

            $tabela = $this->Usuario->buscarUsuarioPorId($where);
            
            $dados = array(
                'titulo'=>'Alteração do Usuario',
                'pagina'=>'usuario/formularioAlterarUsuario.php',
                'tabela'=> $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function atualizarUsuario(){

            $nome = $this->input->post('nome');
            $status = $this->input->post('status');
            $hierarquiaId = $this->input->post('hierarquiaId');
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            
            $usuario = array(
                'nome' => $nome,
                'status' => $status,
                'hierarquiaId' => $hierarquiaId,
            );

            $id = $this->input->post('id');
            
            $where = array('id' => $id);

            $this->load->model('Usuario');

            $this->Usuario->atualizarUsuario($where,$usuario);

            redirect('usuariocontroller');
        }

        public function deletarUsuario($codigo){
            
           $where = array('id' => $codigo);

            $this->load->model('Usuario');

            $this->Usuario->deletarUsuarioPorId($where);

            redirect('usuariocontroller');
        }
        
       

    }
