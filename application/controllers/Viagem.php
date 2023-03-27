<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Viagem extends CI_Controller{

        public static $PAGINA_TITULO = 'Cadastro de Viagens';
        public static $PAGINA_TITULO_NAO_AUTORIZADAS = 'Viagens Não Autorizadas';
        public static $PAGINA_TITULO_AUTORIZADAS = 'Viagens Autorizadas';
        public static $PAGINA_TITULO_NAO_ANALISADA = 'Viagens Não Analisada';
        public static $PAGINA_TITULO_VIGEM_ANALISADA = 'Viagens Analisada';
        public static $PAGINA_INDEX = 'viagem/index.php';
        public static $PAGINA_APROVAR = 'viagem/aprovar.php';
        public static $PAGINA_FORM_CREATE = 'viagem/novo.php';
        public static $PAGINA_FORM_UPDATE = 'viagem/alterar.php';

        public function __contruct(){            
            parent::__contruct();              
        }

        public function index(){   
            $this->listar();
        }
        
        public function listar($indice = 1){

            $indice--;
            

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Viagem_Model->retrive($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function listarPorUsuarioId($indice = 1){

            $indice--;
            
            $usuarioId = $this->session->id;

            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO,
                'tabela'=> $this->tabela(
                    $this->Viagem_Model->retriveUsuarioId($usuarioId,$indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }


        public function novo(){

            $usuario = $this->Usuario_Model->buscarUsuario();

            $selectEndereco = $this->Endereco_Model->selectEndereco($usuario);

            $dados = array(
                'titulo' => self::$PAGINA_TITULO,
                'pagina' => self::$PAGINA_FORM_CREATE,
                'usuario' => $usuario,
                'select_endereco' => $selectEndereco,
                //'selected_endereco' => $selectEndereco[0],
            );

            $this->load->view('index', $dados);
        }

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
                false,
            );

            $this->Viagem_Model->criar($viagem);

            redirect('viagem');       
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
            );

            $this->Viagem_Model->update($viagem);

            redirect('viagem');
        }

        public function deletar($id){            

            $this->Viagem_Model->delete($id);

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
/*
        public function  viagensNaoAprovadas($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_NAO_AUTORIZADAS,
                'tabela'=> $this->tabelaAprovar(
                    $this->Viagem_Model->retriveViagensNaoAprovadas($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function  viagensAprovadas($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_AUTORIZADAS,
                'tabela'=> $this->tabelaAprovar(
                    $this->Viagem_Model->retriveViagensAprovadas($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_INDEX,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }
*/
        public function  viagensNaoAnalisada($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_NAO_ANALISADA,
                'tabela'=> $this->tabelaAprovar(
                    $this->Viagem_Model->retriveViagensNaoAnalisada($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_APROVAR,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function  viagensAnalisada($indice = 1){

            $indice--;
            
            $mostrar = 10;
            $indiceInicial  = $indice * $mostrar;

            $dados = array(
                'titulo'=> self::$PAGINA_TITULO_VIGEM_ANALISADA,
                'tabela'=> $this->tabelaAnalisadas(
                    $this->Viagem_Model->retriveViagensAnalisada($indiceInicial,$mostrar)),
                'pagina'=> self::$PAGINA_APROVAR,
                'botoes'=> $this->botoes($indice,$mostrar),
            );
            
            $this->load->view('index',$dados);
        }

        public function tabela($listaDeViagens){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Aprovada</td>
                        <td>Território</td>
                        <td>Motivo</td>
                        <td>Usuário</td>
                        <td>Endereço</td>
                        <td>Data Ida</td>
                        <td>Data Volta</td>
                        <td>Observação</td>
                        <td>Análisada</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                "
            ;

            foreach($listaDeViagens as $viagem){

                $usuario = $this->Usuario_Model->retriveId($viagem['usuarioId']);
                $endereco = $this->Endereco_Model->retriveId($viagem['enderecoId']);
                $endereco_string = $this->Endereco_Model->toString($endereco[0]);

                $color_aprovado = ($viagem['aprovada'] == 0) ? 'red' : 'green';
                $aprovado = (($viagem['aprovada'] == 1) ? 'Sim' : 'Não');

                $color_analisada = ($viagem['analisada'] == 0) ? 'red' : 'green';
                $analisada = (($viagem['analisada'] == 1) ? 'Sim' : 'Não');

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$viagem['id']}</td>
                            <td><p class='text-center' style='color:$color_aprovado'>" . $aprovado ."</td>
                            <td>{$viagem['territorio']}</td>
                            <td>{$viagem['motivo']}</td>
                            <td>{$usuario[0]['nome']}</td>
                            <td>" . nl2br($endereco_string) . "</td>
                            <td>{$viagem['dataIda']}</td>
                            <td>{$viagem['dataVolta']}</td>
                            <td><p class='text-justify'>" . nl2br($viagem['observacao']) . "</p></td>
                            <td><p class='text-center' style='color:$color_analisada'>" . $analisada ."</td>
                            <td><a href='" . base_url() . "index.php/viagem/alterar/" . $viagem['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/viagem/deletar/" . $viagem['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function tabelaAprovar($listaDeViagens){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Aprovada</td>
                        <td>Território</td>
                        <td>Motivo</td>
                        <td>Usuário</td>
                        <td>Endereço</td>
                        <td>Data Ida</td>
                        <td>Data Volta</td>
                        <td>Observação</td>
                        <td>Análisada</td>
                        <td>Autorizar</td>
                        <td>Não Autorizar</td>
                    </tr>
                "
            ;

            foreach($listaDeViagens as $viagem){

                $usuario = $this->Usuario_Model->retriveId($viagem['usuarioId']);
                $endereco = $this->Endereco_Model->retriveId($viagem['enderecoId']);
                $endereco_string = $this->Endereco_Model->toString($endereco[0]);

                $analisada = (($viagem['analisada'] == 1) ? 'Sim' : 'Não');

                $aprovada = ($viagem['aprovada'] == null) 
                    ? '(Não Análisada)' 
                    : ($viagem['aprovada'] == 1) 
                        ? 'Aprovada' 
                        : 'Não Aprovada';
                    

                if($viagem['aprovada'] == null){
                    
                    $aprovada = '(Não Análisada)';
                    $color_aprovado = 'red';
                    $color_analisada = 'red';

                }else if($viagem['aprovada'] == 1){

                    $aprovada = 'Sim';
                    $color_aprovado = 'green';
                    $color_analisada = 'green';

                }else if($viagem['aprovada'] == 0){

                    $aprovada = 'Não';
                    $color_aprovado = 'red';
                    $color_analisada = 'green';

                }

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$viagem['id']}</td>
                            <td><p class='text-center' style='color:$color_aprovado'>" . nl2br($aprovada) . "</p></td>
                            <td>{$viagem['territorio']}</td>
                            <td>{$viagem['motivo']}</td>
                            <td>{$usuario[0]['nome']}</td>
                            <td>" . nl2br($endereco_string) . "</td>
                            <td>{$viagem['dataIda']}</td>
                            <td>{$viagem['dataVolta']}</td>
                            <td><p class='text-justify'>" . nl2br($viagem['observacao']) . "</p></td>
                            <td><p class='text-center' style='color:$color_analisada'>" . $analisada . "</td>
                            <td><a href='" . base_url() . "index.php/viagem/aprovar/" . nl2br($viagem['id']) . "'>Autorizar</a></td>
                            <td><p class='text-center' style='color:$color_aprovado'>
                                <a href='" . base_url() . "index.php/viagem/naoAprovar/" . nl2br($viagem['id']) . "'>Não Autorizar</a></p>
                            </td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function tabelaAnalisadas($listaDeViagens){
            $line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Aprovada</td>
                        <td>Território</td>
                        <td>Motivo</td>
                        <td>Usuário</td>
                        <td>Endereço</td>
                        <td>Data Ida</td>
                        <td>Data Volta</td>
                        <td>Observação</td>
                        <td>Análisada</td>
                    </tr>
                "
            ;

            foreach($listaDeViagens as $viagem){

                $usuario = $this->Usuario_Model->retriveId($viagem['usuarioId']);
                $endereco = $this->Endereco_Model->retriveId($viagem['enderecoId']);
                $endereco_string = $this->Endereco_Model->toString($endereco[0]);

                $analisada = (($viagem['analisada'] == 1) ? 'Sim' : 'Não');

                $aprovada = ($viagem['aprovada'] == null) 
                    ? '(Não Análisada)' 
                    : ($viagem['aprovada'] == 1) 
                        ? 'Aprovada' 
                        : 'Não Aprovada';
                    

                if($viagem['aprovada'] == null){
                    
                    $aprovada = '(Não Análisada)';
                    $color_aprovado = 'red';
                    $color_analisada = 'red';

                }else if($viagem['aprovada'] == 1){

                    $aprovada = 'Sim';
                    $color_aprovado = 'green';
                    $color_analisada = 'green';

                }else if($viagem['aprovada'] == 0){

                    $aprovada = 'Não';
                    $color_aprovado = 'red';
                    $color_analisada = 'green';

                }

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$viagem['id']}</td>
                            <td><p class='text-center' style='color:$color_aprovado'>" . nl2br($aprovada) . "</p></td>
                            <td>{$viagem['territorio']}</td>
                            <td>{$viagem['motivo']}</td>
                            <td>{$usuario[0]['nome']}</td>
                            <td>" . nl2br($endereco_string) . "</td>
                            <td>{$viagem['dataIda']}</td>
                            <td>{$viagem['dataVolta']}</td>
                            <td><p class='text-justify'>" . nl2br($viagem['observacao']) . "</p></td>
                            <td><p class='text-center' style='color:$color_analisada'>" . $analisada . "</td>
                    </tr>"
                ;

            }
            return $line;
        }

        public function botoes(
            $indiceInicial,
            $mostrar){
                
                return 
                $this->botao->paginar(
                    'viagem',
                    $indiceInicial,
                    $this->Viagem_Model->quantidade(),
                    $mostrar);
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
            $line =
                "
                    <tr class='text-center'>
                        <td>Cidade</td>
                        <td>Quantidade</td>
                        <td>Estado</td>
                    </tr>
                "
            ;

            foreach($listaDeCidades as $cidade){

                $line .= 
                    "<tr class='text-center'> 
                            <td>{$cidade['cidade_nome']}</td>
                            <td>{$cidade['count']}</td>
                            <td>{$cidade['estado_nome']}</td>
                    </tr>"
                ;

            }
            return $line;
        }
    }
