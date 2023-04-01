<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Endereco_Model extends CI_Model {

        public static $TABELA_DB = 'endereco';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($endereco){

            $this->db->insert(
                self::$TABELA_DB, 
                $endereco);
        }
        
        public function update($endereco){

            $this->db->update(
                self::$TABELA_DB,
                $endereco, 
                array('id'=> $endereco['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoEndereco($resultado->result());
        }
        
        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoEndereco($resultado->result());
        }

        public function retriveUsuarioId($usuarioId,$indiceInicial,$mostrar){
          
            $resultado = 
            $this->db
            ->where('usuarioId', $usuarioId)
            ->order_by('nome')
            ->get(self::$TABELA_DB,$indiceInicial,$mostrar);   
            
            return $this->montarObjetoEndereco($resultado->result());
        }        

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }
        
        public function montarObjetoEndereco($result){

            $listaDeEnderecos = array();

            foreach($result as $linha){
                $endereco = $this->endereco(
                    $linha->id,
                    $linha->nome,
                    $linha->logradouro,
                    $linha->numero,
                    $linha->bairro,
                    $linha->cidadeId,
                    $linha->usuarioId
                );

                array_push($listaDeEnderecos, $endereco);
           }
            return $listaDeEnderecos;
        }
        
        public function endereco($id,$nome,$logradouro,$numero,$bairro,$cidadeId,$usuarioId){            
        
            return array(
                'id' => $id,
                'nome' => $nome,
                'logradouro' => $logradouro,
                'numero' => $numero,
                'bairro' => $bairro,
                'cidadeId' => $cidadeId,
                'usuarioId' => $usuarioId,
            );
        }
        
        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function toString($endereco){
            

            $cidade = $this->Cidade_Model->retriveId($endereco['cidadeId']);
            $estado = $this->Estado_Model->retriveId($cidade[0]['estadoId']);

            $endereco_string = "{$endereco['logradouro']}, {$endereco['numero']}, {$endereco['bairro']}"
                . "{$cidade[0]['nome']}, {$estado[0]['nome']}";
            
            return $endereco_string;
        }

        public function selectEndereco($usuario){  

            $select = [];

            $listaDeEnderecosDoUsuario = $this->retriveUsuarioId($usuario[0]['id'],null,null);

            foreach($listaDeEnderecosDoUsuario as $value){
                
                $endereco = array($value['id'] => "{$value['nome']} ({$this->toString($value)})");

                $select += $endereco;
            }
            return $select;
        }

        

    }
?>