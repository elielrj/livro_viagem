<?php

    include_once('Link.php');

    class TabelaEstado extends Link{

        public function estado($estados)
        {
            $tabela = $this->linhaDeCabecalhoDoEstado();

            foreach($estados as $estado)
            {
                $tabela .= $this->linhaDoEstado($estado);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoEstado()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Estado</td>
                    <td>Sigla</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoEstado($estado)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->estadoId($estado['id']) .
                    $this->estadoNome($estado['nome']) .
                    $this->estadoSigla($estado['sigla']) .
                    $this->estadoAlterar($estado['id']) .
                    $this->estadoExcluir($estado['id']) .
                                
                "</tr>";
        }

        private function estadoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function estadoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function estadoSigla($estado)
        {
            return "<td>{$estado}</td>";
        }

        private function estadoAlterar($id)
        {
            return "<td>{$this->linkAlterar('estado',$id)}</td>";
        }

        private function estadoExcluir($id)
        {
            return "<td>{$this->linkExcluir('estado',$id)}</td>";
        }
        
    }