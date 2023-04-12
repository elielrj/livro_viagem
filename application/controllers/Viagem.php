<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Viagem extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Viagens';
        public static $PAGINA_TITULO_NAO_AUTORIZADAS = 'Viagens Não Autorizadas';
        public static $PAGINA_TITULO_AUTORIZADAS = 'Viagens Autorizadas';
        public static $PAGINA_TITULO_NAO_ANALISADA = 'Viagens Não Analisada';
        public static $PAGINA_TITULO_VIGEM_ANALISADA = 'Viagens Analisada';
        public static $PAGINA_INDEX = 'viagem/index.php';
        public static $PAGINA_APROVAR = 'viagem/aprovar.php';
        public static $PAGINA_FORM_INFORMAR = 'viagem/novo.php';
        public static $PAGINA_FORM_NOVO = 'viagem/novo.php';
        public static $PAGINA_FORM_UPDATE = 'viagem/alterar.php';

        public function __contruct(){            
            parent::__contruct();              
        }

        public function index(){   
            $this->listarPorUsuarioId();
        }
        
        public function listar($indice = 1){

            if(NivelDeAcesso::isRoot()){
                $indice--;
                

                $mostrar = 10;
                $indiceInicial  = $indice * $mostrar;

                $viagens = $this->Viagem_Model->retrive($indiceInicial,$mostrar);
                $botoes = empty($viagens) ? '' : $this->botao('viagem/listar',$indice,$mostrar);

                $dados = array(
                    'titulo'=> self::$PAGINA_TITULO,
                    'tabela'=> $this->tabela(
                        $viagens,
                        $indiceInicial
                    ),
                    'pagina'=> 'viagem/consultar.php',
                    'botoes'=> $botoes,
                );
                
                $this->load->view('index',$dados);

            }else{
                //session_destroy();
                //if(!isset($_SESSION['email'])){
                header("Location:" . base_url());
               // exit();
    //}
            }
        }

        public function listarPorUsuarioId($indice = 1){

            $indice--;
            
            $usuarioId = $this->session->id;

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $viagens = $this->Viagem_Model->retriveUsuarioId($usuarioId,$indiceInicial,$mostrar);
            $botoes = empty($viagens) ? '' : $this->botao('viagem/listarPorUsuarioId',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $viagens,
                    $indiceInicial
                ),
                'pagina'=> 'viagem/consultar.php',
                'botoes'=> $botoes,
            );
            
            $this->load->view('index',$dados);
        }


        public function novo(){

            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_NOVO,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
                'metodo' => 'viagem/criar'
            );

            $this->load->view('index', $dados);
        }
        
        public function informar(){

            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_INFORMAR,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
                'metodo' => 'viagem/criarInformacao',
            );

            $this->load->view('index', $dados);
        }
        /**
         * recebe como parâmetro o nome do menu criado
         * por meio do objeto Menu, na biblioteca do CI,
         * para designar a rota correta
         */
        public function criar(){

            $data = $this->input->post();

            $dataIda = new DateTime($data['dataIda']);
            $dataVolta = new DateTime($data['dataVolta']);
            
            $viagem = 
            $this->Viagem_Model->viagem(
                null,
                null,
                $data['territorio'],
                $data['motivo'],
                $data['usuarioId'],
                $data['enderecoId'],
                $dataIda->format('Y-m-d'),
                $dataVolta->format('Y-m-d'),
                $data['observacao'],
                $analisada = false,
                $status = true
            );

            $this->Viagem_Model->criar($viagem);
                redirect('viagem');
            
                  
        }

        public function criarInformacao(){

            $data = $this->input->post();

            $dataIda = new DateTime($data['dataIda']);
            $dataVolta = new DateTime($data['dataVolta']);
            
            $viagem = 
            $this->Viagem_Model->viagem(
                null,
                null,
                $data['territorio'],
                $data['motivo'],
                $data['usuarioId'],
                $data['enderecoId'],
                $dataIda->format('Y-m-d'),
                $dataVolta->format('Y-m-d'),
                $data['observacao'],
                $analisada = false,
                $status = true
            );

            $this->Viagem_Model->criar($viagem);

           
            redirect('viagem/listarPorUsuarioId'); 
           
            
                  
        }

        public function alterar($id){                
            
            $tabela = $this->Viagem_Model->retriveId($id);
            
            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_UPDATE,
                'tabela' => $tabela,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
            );

            $this->load->view('index',$dados);
        }

        public function atualizar(){

            $data = $this->input->post();
            
            $viagem = 
            $this->Viagem_Model->viagem(
                $data['id'],
                $data['aprovada'],
                $data['territorio'],
                $data['motivo'],
                $data['usuarioId'],
                $data['enderecoId'],
                $data['dataIda'],
                $data['dataVolta'],
                $data['observacao'],
                $data['analisada'],
                $data['status']
            );

            $this->Viagem_Model->update($viagem);

            redirect('viagem');
        }

        public function deletar($id){            

            $this->Viagem_Model->delete($id);

            redirect('viagem');
        }
        
        public function recuperar($id){            

            $this->Viagem_Model->recuperar($id);

            redirect('viagem');
        }

        public function aprovar($id){                
            $this->aprovarAnalisarViagem($id,true);
        }

        public function naoAprovar($id){              
            $this->aprovarAnalisarViagem($id,false);
        }

        private function aprovarAnalisarViagem($id,$estaAprovada){
            $viagem = $this->Viagem_Model->retriveId($id);

            $viagem[0]['aprovada'] = $estaAprovada;
            $viagem[0]['analisada'] = true;

            $this->Viagem_Model->update($viagem[0]);

            redirect('viagem/viagensNaoAnalisada');
        }

        public function  viagensNaoAnalisada($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $viagens = $this->Viagem_Model->retriveViagensNaoAnalisada($indiceInicial,$mostrar);
            $botoes = empty($viagens) ? '' : $this->botao('viagem/viagensNaoAnalisada',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_NAO_ANALISADA,
                'tabela'=> $this->tabelaAprovar(
                    $viagens,
                    $indiceInicial
                ),
                'pagina'=> self::$PAGINA_APROVAR,
                'botoes'=> $botoes,
            );
            
            $this->load->view('index',$dados);
        }

        public function  viagensAnalisada($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $viagens = $this->Viagem_Model->retriveViagensAnalisada($indiceInicial,$mostrar);
            $botoes = empty($viagens) ? '' : $this->botao('viagem/viagensAnalisada',$indice,$mostrar);

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_VIGEM_ANALISADA,
                'tabela'=> $this->tabelaAnalisadas(
                    $viagens,
                    $indiceInicial
                ),
                'pagina'=> self::$PAGINA_APROVAR,
                'botoes'=> $botoes,
            );
            
            $this->load->view('index',$dados);
        }

        public function tabela($listaDeViagens, $ordem){
            
            $line = [];

            foreach($listaDeViagens as $viagem){

                $data = $this->montarArrayViagem($viagem);

                array_push($line,$data);
            }
           
            return $this->tabela->viagem($line, $ordem);
        }

        public function tabelaAprovar($listaDeViagens, $ordem){
            $line = [];

            foreach($listaDeViagens as $viagem){

                $data = $this->montarArrayViagem($viagem);

                array_push($line,$data);
            }
            return $this->tabela->viagemParaAprovacao($line, $ordem);
        }

        public function tabelaAnalisadas($listaDeViagens, $ordem){
            $line =[];

            foreach($listaDeViagens as $viagem){

                $data = $this->montarArrayViagem($viagem);

                array_push($line,$data);

            }
            return $this->tabela->viagensAnalisadas($line, $ordem);
        }

        private function montarArrayViagem($viagem)
        {
            $usuario = $this->Usuario_Model->retriveId($viagem['usuarioId']);
            $endereco = $this->Endereco_Model->retriveId($viagem['enderecoId']);
            $endereco_string = $this->Endereco_Model->toString($endereco[0]);

            return array(
                'id' => $viagem['id'],
                'aprovada' => $viagem['aprovada'],
                'territorio' => $viagem['territorio'],
                'motivo' => $viagem['motivo'],
                'usuario' => $usuario[0]['nome'],
                'endereco' => nl2br($endereco_string),
                'dataIda' => $viagem['dataIda'],
                'dataVolta' => $viagem['dataVolta'],
                'observacao' => $viagem['observacao'],
                'analisada' => $viagem['analisada'],
                'usuarioId' => $viagem['usuarioId'],
                'status' => $viagem['status'],
            );
        }

        public function botao($link,$indice,$mostrar){
            return $this->botao->paginar(
                    $link,
                    $indice,
                    $this->Viagem_Model->quantidade(),
                    $mostrar
                );
        }

        public function cidadesNacionaisMaisVisitadas(){

            $listaDeCidades =  $this->Viagem_Model->cidadesNacionaisMaisVisitadas();

            $tabela = $this->tabelaDeCidadesMaisVisitadas($listaDeCidades);

            $dados = array(
                'titulo' => 'Cidades mais visitadas',
                'pagina' => 'viagem/relatorio.php',
                'tabela' => $tabela,
            );

            $this->load->view('index',$dados);
        }

        public function tabelaDeCidadesMaisVisitadas($listaDeCidades){
            return $this->tabela->cidadeMaisVisitadas($listaDeCidades);
        }

    }
