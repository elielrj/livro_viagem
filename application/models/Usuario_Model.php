<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuario_Model extends CI_Model {
        
        public static $TABELA_DB = 'usuario';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($usuario){
            $this->db->insert(
                self::$TABELA_DB, 
                $usuario);
        }
        
        public function update($usuario){

            $this->db->update(
                self::$TABELA_DB,
                $usuario, 
                array('id'=> $usuario['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoUsuario($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoUsuario($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function retriveEmail($email){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('email'=> $email)
            );   
            
            return $this->montarObjetoUsuario($resultado->result());
        }

        public function montarObjetoUsuario($result){

            $listaDeUsuarios = array();

            foreach($result as $linha){
                $usuario = $this->usuario(
                    $linha->id,
                    $linha->nome,
                    $linha->status,
                    $linha->dataDeCriacao,
                    $linha->ultimoAcesso,
                    $linha->hierarquiaId,
                    $linha->email,
                    $linha->senha,
                    $linha->funcaoId,
                );

                array_push($listaDeUsuarios, $usuario);
           }
            return $listaDeUsuarios;
        }
        
        public function usuario(
            $id,
            $nome,
            $status,
            $dataDeCriacao,
            $ultimoAcesso,
            $hierarquiaId,
            $email,
            $senha,
            $funcaoId){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'status' => $status,
                'dataDeCriacao' => $dataDeCriacao,
                'ultimoAcesso' => $ultimoAcesso,
                'hierarquiaId' => $hierarquiaId,
                'email' => $email,
                'senha' => $senha,
                'funcaoId' => $funcaoId,
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function buscarUsuario(){
           
            $email = $this->session->email;
           
            return $this->retriveEmail($email);
        }

           

        public function selectEndereco($usuario){
            return $this->Endereco_Model->selectEndereco($usuario);
        }

        public function selectedEndereco($usuario){
            return $this->Endereco_Model->selectedEndereco($usuario);
        }
    }
?>