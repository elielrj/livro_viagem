<?php

    class LoginController extends CI_Controller{


        public function index(){         

            //$this->load->view('login.php');
            
            
            if(!isset($this->session->email)){

                $this->load->view('login.php');

            }else{
                redirect('ViagemController');
            }
        }

        public function logar(){

                if($this->verificarEmail()){
             
                    if($this->verificarSenha()){

                     $this->criarSessao();
                     //$this->redirecionaParaTelaViagem();
                     $this->index();

                    }else{
                        //$this->redirecionarParaTelaLogin();
                    }

                }else{
                    //$this->redirecionarParaTelaLogin();
                }

    
            //$this->index();
            //redirect('LoginController');
            redirect(base_url());
        }

        public function verificarEmail(){

            $email = $this->input->post('email');

            $where = array('email' => $email);

            $this->load->model('Login');

           
           $resultado = $this->Login->verificarEmail($where); 


           if(isset($resultado[0])){

                $this->session->set_userdata('email_valido',true);

           }else{
                $this->session->set_userdata('email_valido',false);
           }

            return isset($resultado[0]);

        }

        public function verificarSenha(){

            $senha = md5($this->input->post('senha'));

            $where = array('senha' => $senha);

            $this->load->model('Login');


           $resultado = $this->Login->verificarSenha($where);

           if(isset($resultado[0])){

                $this->session->set_userdata('senha_valida',true);

           }else{
                $this->session->set_userdata('senha_valida',false);
           }

           return isset($resultado[0]);
        }

        public function criarSessao(){

            $whereUsuario = array('email' => $this->input->post('email'));
            
            $this->load->model('Usuario');
            
            $usuario = $this->Usuario->buscarUsuarioPorId($whereUsuario);

            $whereHierarquia = array('id' => $usuario[0]->hierarquiaId);

            $this->load->model('Hierarquia');
            $resultado = $this->Hierarquia->buscarHierarquiaPorId($whereHierarquia);

            $hierarquia = array(
                'id' => $resultado[0]->id,
                'postoOuGraduacao' => $resultado[0]->postoOuGraduacao,
                'sigla' => $resultado[0]->sigla,
            );

           $data = array(
            'id' => $usuario[0]->id,
            'nome' => $usuario[0]->nome,
            'status' => $usuario[0]->status,
            'dataDeCriacao' => $usuario[0]->dataDeCriacao,
            'ultimoAcesso' => $usuario[0]->ultimoAcesso,
            'hierarquia' => $hierarquia,
            'email' => $usuario[0]->email,
           );

     

           $this->session->set_userdata($data);            
        }

        private function redirecionarParaTelaLogin(){

            //header('Location:' . base_url());            
            //exit();
            redirect(base_url());
            //$this->index();
        }

        public function redirecionaParaTelaViagem(){
            header('Location:' . base_url() . 'index.php/ViagemController');
            
           // exit();
        }

        public function removerSessao(){

            $data = array(
                'id',
                'nome' ,
                'status',
                'dataDeCriacao',
                'ultimoAcesso',
                'hierarquia',
                'email',
                'email_valido',
                'senha_valida',
           );

            //$this->session->unset_userdata($data); 
            //redirect(LoginController);
            //$this->index();

            $this->session->sess_destroy();


           redirect(base_url());
        }

        
        
    }
?>
