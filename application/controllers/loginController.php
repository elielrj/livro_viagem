<?php

    class LoginController extends CI_Controller{


        public function index(){                      
            $this->load->view('login/login.php');
        }


        public function logarUsuario(){

            $email = $this->input->post('email');

            $senha = $this->input->post('senha');
            
            $this->load->model("Login");

            $where = array('email' => $email);

      

            $resultado = $this->Login->buscarLoginPorEmail($where);


            if(isset($resultado)){
              
                echo "<script>alert('Usuário não cadastrado!);</script>";
               
                //redirect('');

            }else{

                $senhaEstaValida = $this->verificarSenha($resultado[0]->senha, $senha);

                if($senhaEstaValida){

                    //session_start();
                   // $_SESSION['email'] = $email;
                    //$_SESSION['senha'] = $senha;

                   // include_once('session.php');

                    redirect('viagemcontroller');
                   // echo"<script>alert('Login com sucesso!');</script>";
                    

                }else{
                     echo"<script>alert('Senha inválida!');</script>"; 
                     //redirect('');                   
                } 
            }

    
        }

        private function verificarSenha($senhaInformado,$senhaDoBanco){
             if($senhaInformado == $senhaDoBanco){
                return true;
            }else{
                return false;
            }
        }
    }
?>