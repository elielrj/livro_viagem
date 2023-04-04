<?php

    include_once('Link.php');

    class TabelaFuncao extends Link{

        public function funcao($funcoes)
        {
            $tabela = $this->linhaDeCabecalhoDaFuncao();

            foreach($funcoes as $funcao)
            {
                $tabela .= $this->linhaDaFuncao($funcao);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaFuncao()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
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
                
                    $this->funcaoId($funcao['id']) .
                    $this->funcaoNome($funcao['nome']) .
                    $this->funcaoStatus($funcao['status']) .
                    $this->funcaoNivelDeAcesso($funcao['nivelDeAcesso']) .
                    $this->funcaoAlterar($funcao['id']) .
                    $this->funcaoExcluir($funcao['id']) .
                                
                "</tr>";
        }

        private function funcaoId($id)
        {
            return "<td>{$id}</td>";
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
            return "<td>{$this->linkAlterar('funcao',$id)}</td>";
        }

        private function funcaoExcluir($id)
        {
            return "<td>{$this->linkExcluir('funcao',$id)}</td>";
        }
        
    }