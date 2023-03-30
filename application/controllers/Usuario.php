<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuario extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Usuários';
        public static $PAGINA_INDEX = 'usuario/index.php';
        public static $PAGINA_FORM_CREATE = 'usuario/novo.php';
        public static $PAGINA_FORM_UPDATE = 'usuario/alterar.php';

        public function __contruct(){            
            parent::__contruct();              
        }

        public function index(){   

            if(!isset($this->session->email)){

                $this->load->view('login.php');

            }else{
                $this->listar();
            }            
        }

        public function listar($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Usuario_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

       public function novo(){

          $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'select_hierarquia' => $this->selectHierarquia(),
                'select_funcao' => $this->selectFuncao(),
            );

            $this->load->view('index', $dados);
        }

        public function criar(){

            $data = $this->input->post();

            $timestamp = now('America/Sao_Paulo');
            $datestring = '%Y-%m-%d';
            $dataHoraAgora = mdate($datestring,$timestamp);

            $usuario = 
            $this->Usuario_Model->usuario(
                null,
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $dataHoraAgora,
                $dataHoraAgora,
                $data['hierarquiaId'],
                $data['email'],
                md5($data['senha']),
                $data['funcaoId']
            );

            $this->Usuario_Model->criar($usuario);

            redirect('usuario');       
        }
        
        public function alterar($id){                
            
            $tabela = $this->Usuario_Model->retriveId($id);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'pagina'=> self::$PAGINA_FORM_UPDATE,
                'tabela'=> $tabela,
                'select_hierarquia' => $this->selectHierarquia(),
                'selected_hierarquia' => $tabela[0]['hierarquiaId'],
                'select_funcao' => $this->selectFuncao(),
                'selected_funcao' => $tabela[0]['funcaoId'],
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();

            $dataDeCriacao = new DateTime($data['dataDeCriacao']);

            $timestamp = now('America/Sao_Paulo');
            $datestring = '%Y-%m-%d';
            $dataHoraAgora = mdate($datestring,$timestamp);
            
            $usuario = 
            $this->Usuario_Model->usuario(
                $data['id'],
                ucwords(strtolower($data['nome'])),
                $data['status'],
                $dataDeCriacao->format('Y-m-d'),
                $dataHoraAgora,
                $data['hierarquiaId'],
                $data['email'],
                md5($data['senha']),
                $data['funcaoId']
            );

            $this->Usuario_Model->update($usuario);

            redirect('usuario');
        }

        public function deletar($id){            

            $this->Usuario_Model->delete($id);

            redirect('usuario');
        }

        public function recuperarUsuario($id){            

            $this->Usuario_Model->recuperarUsuario($id);

            redirect('usuario');
        }
        
        public function selectHierarquia(){
            return $this->Hierarquia_Model->selectHierarquia();
        }

        public function selectFuncao(){
            return $this->Funcao_Model->selectFuncao();
        }
        
        public function tabela($listaDeUsuarios){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Nome</td>
                        <td>Status</td>
                        <td>Data de Criação</td>
                        <td>Último Acesso</td>
                        <td>Hierarquia</td>
                        <td>Email</td>
                        <td>Senha</td>
                        <td>Função</td>
                        <td>Nível de Acesso</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeUsuarios as $usuario){
 
                $hierarquia = $this->Hierarquia_Model->retriveId($usuario['hierarquiaId']);
                $funcao = $this->Funcao_Model->retriveId($usuario['funcaoId']);

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$usuario['id']}</td>
                            <td>{$usuario['nome']}</td>
                            <td>{$usuario['status']}</td>
                            <td>{$usuario['dataDeCriacao']}</td>
                            <td>{$usuario['ultimoAcesso']}</td>
                            <td>{$hierarquia[0]['sigla']}</td>
                            <td>{$usuario['email']}</td>
                            <td>{$usuario['senha']}</td>
                            <td>{$funcao[0]['nome']}</td>
                            <td>{$funcao[0]['nivelDeAcesso']}</td>";
                            if($usuario['status'] == 1):
                                 $line .=
                                "<td><a href='" . base_url() . "index.php/usuario/alterar/" . $usuario['id'] . "'>Alterar</a></td>
                                <td><a href='" . base_url() . "index.php/usuario/deletar/" . $usuario['id'] . "'>Excluir</a></td>";
                            elseif($usuario['status'] == 0):
                                $line .=
                                "<td><a href='" . base_url() . "index.php/usuario/alterar/" . $usuario['id'] . "'>Alterar</a></td>
                                 <td><a href='" . base_url() . "index.php/usuario/recuperarUsuario/" . $usuario['id'] . "'>Recuperar</a></td>";
                            endif;
                                $line .= "</tr>";

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){
                
                return 
                $this->botao->paginar(
                    'usuario',
                    $indiceInicial,
                    $this->Usuario_Model->quantidade(),
                    $mostrar);
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

            $this->session->sess_destroy();

            redirect(base_url());
        }

        public function criarSessao(){

            $email = $this->input->post('email');            
            
            $usuario = $this->Usuario_Model->retriveEmail($email);

            $hierarquia = $this->Hierarquia_Model->retriveId($usuario[0]['hierarquiaId']);

            $funcao = $this->Funcao_Model->retriveId($usuario[0]['funcaoId']);
            
           $data = array(
            'id' => $usuario[0]['id'],
            'nome' => $usuario[0]['nome'],
            'status' => $usuario[0]['status'],
            'dataDeCriacao' => $usuario[0]['dataDeCriacao'],
            'ultimoAcesso' => $usuario[0]['ultimoAcesso'],
            'hierarquia' => $hierarquia[0],
            'email' => $usuario[0]['email'],
            'funcao' => $funcao[0],
            //'nivelDeAcesso' => $funcao[0]['nivelDeAcesso'],
           );     

           $this->session->set_userdata($data);            
        }

        public function logar(){

                if($this->verificarEmail()){
             
                    if($this->verificarSenha()){

                     $this->criarSessao();
                     //$this->redirecionaParaTelaViagem();
                     //$this->index();
                        redirect('viagem');
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

            //$this->load->model('Login');

           
           $resultado = $this->Usuario_Model->verificarEmail($where); 


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

            //$this->load->model('Login');


           $resultado = $this->Usuario_Model->verificarSenha($where);

           if(isset($resultado[0])){

                $this->session->set_userdata('senha_valida',true);

           }else{
                $this->session->set_userdata('senha_valida',false);
           }

           return isset($resultado[0]);
        }
        
    }
       


