<?php

    include_once('Link.php');

    class TabelaHierarquia extends Link{

        public function hierarquia($hierarquias)
        {
            $tabela = $this->linhaDeCabecalhoDaHierarquia();

            foreach($hierarquias as $hierarquia)
            {
                $tabela .= $this->linhaDaHierarquia($hierarquia);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaHierarquia()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Posto ou Graduação</td>
                    <td>Sigla</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDaHierarquia($hierarquia)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->hierarquiaId($hierarquia['id']) .
                    $this->hierarquiaPostoOuGraduacao($hierarquia['postoOuGraduacao']) .
                    $this->hierarquiaSigla($hierarquia['sigla']) .
                    $this->funcaoAlterar($hierarquia['id']) .
                    $this->funcaoExcluir($hierarquia['id']) .
                                
                "</tr>";
        }

        private function hierarquiaId($id)
        {
            return "<td>{$id}</td>";
        }

        private function hierarquiaPostoOuGraduacao($postoOuGraduacao)
        {
            return "<td>{$postoOuGraduacao}</td>";
        }

        private function hierarquiaSigla($sigla)
        {
            return "<td>{$sigla}</td>";
        }

        private function funcaoAlterar($id)
        {
            return "<td>{$this->linkAlterar('hierarquia',$id)}</td>";
        }

        private function funcaoExcluir($id)
        {
            return "<td>{$this->linkExcluir('hierarquia',$id)}</td>";
        }
        
    }