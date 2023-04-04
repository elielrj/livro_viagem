<?php

    include_once('Link.php');

    class TabelaEstado extends Link{

        private $ordem;

        public function estado($estados, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoEstado();

            foreach($estados as $estado)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoEstado($estado);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoEstado()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
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
                
                    $this->estadoOrdem() .
                    $this->estadoNome($estado['nome']) .
                    $this->estadoSigla($estado['sigla']) .
                    $this->estadoAlterar($estado['id']) .
                    $this->estadoExcluir($estado['id']) .
                                
                "</tr>";
        }

        private function estadoOrdem()
        {
            return "<td>{$this->ordem}</td>";
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