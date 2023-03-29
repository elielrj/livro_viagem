<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Tabela{

        public function __contruct(){
            parent::__construct();
        }

        public function cidade($listaDeCidades){

            /*$line =
                "
                    <tr class='text-center'>
                        <td>Id</td>
                        <td>Cidade</td>
                        <td>Estado</td>
                        <td>Sigla</td>
                        <td>Alterar</td>
                        <td>
                            Excluir
                        </td>
                    </tr>
                "
            ;

            foreach($listaDeCidade as $cidade){
                
                $estado = $this->Estado_Model->retriveId($cidade['estadoId']);
                
                $line .= 
                    "<tr class='text-center'> 
                            <td>{$cidade['id']}</td>
                            <td>{$cidade['nome']}</td>
                            <td>{$estado[0]['nome']}</td>
                            <td>{$estado[0]['sigla']}</td>
                            <td><a href='" . base_url() . "index.php/cidade/alterar/" . $cidade['id'] . "'>Alterar</a></td>
                            <td><a href='" . base_url() . "index.php/cidade/deletar/" . $cidade['id'] . "'>Excluir</a></td>
                    </tr>"
                ;

            }
            return $line;*/

            $vetor = [];

            foreach($listaDeCidades as $cidade){

                $estado = $this->Estado_Model->retriveId($cidade['estadoId']);

                $vetor += array(
                    $cidade['id'],
                    $cidade['nome'],
                    $estado[0]['nome'],
                    $estado[0]['sigla'],
                );
            }

            include_once('tabela/TabelaCidade.php');
            $tabelaCidade = new TabelaCidade();

            return $tabelaCidade->listarCidades($vetor);

        }

        
        
    }