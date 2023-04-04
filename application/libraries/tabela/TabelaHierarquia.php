<?php

    include_once('Link.php');

    class TabelaHierarquia extends Link{

        private $ordem;

        public function hierarquia($hierarquias, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDaHierarquia();

            foreach($hierarquias as $hierarquia)
            {
                $this->ordem++;
                $tabela .= $this->linhaDaHierarquia($hierarquia);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaHierarquia()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Posto ou Graduação</td>
                    <td>Sigla</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDaHierarquia($hierarquia)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->hierarquiaOrdem() .
                    $this->hierarquiaPostoOuGraduacao($hierarquia['postoOuGraduacao']) .
                    $this->hierarquiaSigla($hierarquia['sigla']) .
                    $this->hierarquiaStatus($hierarquia['status']) .
                    $this->funcaoAlterar($hierarquia['id']) .
                    $this->funcaoExcluir($hierarquia['id'],$hierarquia['status']) .
                                
                "</tr>";
        }

        private function hierarquiaOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }

        private function hierarquiaPostoOuGraduacao($postoOuGraduacao)
        {
            return "<td>{$postoOuGraduacao}</td>";
        }

        private function hierarquiaSigla($sigla)
        {
            return "<td>{$sigla}</td>";
        }

        private function hierarquiaStatus($status)
        {
            return "<td>{$status}</td>";
        }

        private function funcaoAlterar($id)
        {
            $permissao = $this->verificarNivelDeAcesso();

            return "<td>{$this->linkAlterar('hierarquia',$id,$permissao)}</td>";
        }

        private function funcaoExcluir($id,$status)
        {
            $permissao = $this->verificarNivelDeAcesso();

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('hierarquia',$id,$permissao,$recuperar)}</td>";
        }
        
        private function verificarNivelDeAcesso(){
            if(
                NivelDeAcesso::isRoot() ||
                NivelDeAcesso::isAdmin()
            )
            {
                return true;
            }
            else{
                return false;
            }
        }
    }