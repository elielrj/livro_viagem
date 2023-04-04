<?php

    include_once('Link.php');

    class TabelaFuncao extends Link{

        private $ordem;

        public function funcao($funcoes, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDaFuncao();

            foreach($funcoes as $funcao)
            {
                $this->ordem++;
                $tabela .= $this->linhaDaFuncao($funcao);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaFuncao()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Nome da Função</td>
                    <td>Status</td>
                    <td>Nível de Acesso</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDaFuncao($funcao)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->funcaoOrdem() .
                    $this->funcaoNome($funcao['nome']) .
                    $this->funcaoStatus($funcao['status']) .
                    $this->funcaoNivelDeAcesso($funcao['nivelDeAcesso']) .
                    $this->funcaoAlterar($funcao['id']) .
                    $this->funcaoExcluir($funcao['id'],$funcao['status']) .
                                
                "</tr>";
        }

        private function funcaoOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }

        private function funcaoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function funcaoStatus($status)
        {
            return "<td><p style='color:" . ($status ? 'green' : 'red') ."'>" . ($status ? 'Ativo' : 'Inativo') . "</p></td>";
        }

        private function funcaoNivelDeAcesso($nivelDeAcesso)
        {
            return "<td>{$nivelDeAcesso}</td>";
        }

        private function funcaoAlterar($id)
        {
            $permissao = $this->verificarNivelDeAcesso();

            return "<td>{$this->linkAlterar('funcao',$id,$permissao)}</td>";
        }

        private function funcaoExcluir($id,$status)
        {
            $permissao = $this->verificarNivelDeAcesso();

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('funcao',$id,$permissao,$recuperar)}</td>";
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