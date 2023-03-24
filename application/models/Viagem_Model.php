<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Viagem_Model extends CI_Model{

        public static $TABELA_DB = 'viagem';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($viagem){
            $this->db->insert(
                self::$TABELA_DB, 
                $viagem);
        }
        
        public function update($viagem){

            $this->db->update(
                self::$TABELA_DB,
                $viagem, 
                array('id'=> $viagem['id'])
            );
        }
        
        public function retrive($indiceInicial,$mostrar){
            
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
            ); 

            return $this->montarObjetoViagem($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoViagem($resultado->result());
        }

        
        public function retriveUsuarioId($usuarioId,$indiceInicial,$mostrar){
            
            $resultado = 
            $this->db
                ->where('usuarioId',$usuarioId)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB,$indiceInicial,$mostrar); 
            
            return $this->montarObjetoViagem($resultado->result());
        }

        public function delete($id){
            $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoViagem($result){

            $listaDeViagens = array();
            
            foreach($result as $linha){
                
                $viagem = $this->viagem(
                    $linha->id,
                    $linha->aprovada,
                    $linha->territorio,
                    $linha->motivo,
                    $linha->usuarioId,
                    $linha->enderecoId,
                    $linha->dataIda,
                    $linha->dataVolta,
                    $linha->observacao,
                    $linha->analisada,
                );

                array_push($listaDeViagens, $viagem);
           }
            return $listaDeViagens;
        }
        
        public function viagem(
            $id,
            $aprovada,
            $territorio,
            $motivo,
            $usuarioId,
            $enderecoId,
            $dataIda,
            $dataVolta,
            $observacao,
            $analisada){            
        
            return array(
                'id' => $id,
                'aprovada' => $aprovada,
                'territorio' => $territorio,
                'motivo' => $motivo,
                'usuarioId' => $usuarioId,
                'enderecoId' => $enderecoId,
                'dataIda' => $dataIda,
                'dataVolta' => $dataVolta,
                'observacao' => $observacao,
                'analisada' => $analisada,
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        /*
      
        $query = $this->db->query('SELECT name, title, email FROM my_table');

            foreach ($query->result() as $row)
            {
                    echo $row->title;
                    echo $row->name;
                    echo $row->email;
            }

            echo 'Total Results: ' . $query->num_rows();
        */
        public function cidadesNacionaisMaisVisitadas(){
            
            $query = $this->db->query(
                "
                    SELECT v.territorio, c.nome, c.id, c.estadoId, COUNT(*) 
                        FROM viagem as v

                        INNER JOIN endereco as e
                        ON e.id = v.enderecoId and v.territorio = 'NACIONAL'

                        JOIN bairro as b
                        ON e.bairroId = b.id

                        JOIN cidade as c
                        ON b.cidadeId = c.id

                        GROUP BY c.nome
                        HAVING count(*) >= 0
                ");
            
            $dados = [];

            $count = "COUNT(*)";

            foreach ($query->result() as $row)
            {

                $estado = $this->Estado_Model->retriveId($row->estadoId);
                $estado_nome = $estado[0]['nome'] . "/" . $estado[0]['sigla'];

                $cidade = array( 
                    'cidade_nome' => $row->nome,
                    'count' => $row->$count,
                    'estado_nome' => $estado_nome,
                );

                array_push($dados,$cidade);
            }

            //var_dump($dados);
            return $dados;
        }
/*
        public function retriveViagensNaoAprovadas($indiceInicial,$mostrar){
            
            $resultado = 
            $this->db
                ->where('aprovada', false)
                ->where('analisada', true)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB,$indiceInicial,$mostrar); 
            
            return $this->montarObjetoViagem($resultado->result());
        }

        public function retriveViagensAprovadas($indiceInicial,$mostrar){
            
            $resultado = 
            $this->db
                ->where('aprovada', true)
                ->where('analisada', true)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB,$indiceInicial,$mostrar); 
            
            return $this->montarObjetoViagem($resultado->result());
        }
*/
        public function retriveViagensNaoAnalisada($indiceInicial,$mostrar){
            
            $resultado = 
            $this->db
                ->where('analisada', false)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB,$indiceInicial,$mostrar); 
            
            return $this->montarObjetoViagem($resultado->result());
        }

        public function retriveViagensAnalisada($indiceInicial,$mostrar){
            
            $resultado = 
            $this->db
                ->where('analisada', true)
                ->order_by('dataIda')
                ->get(self::$TABELA_DB,$indiceInicial,$mostrar); 
            
            return $this->montarObjetoViagem($resultado->result());
        }
    }
?>