<?php

    include_once('Link.php');

    class TabelaTelefone extends Link{

        public function telefone($telefones)
        {
            $tabela = $this->linhaDeCabecalhoDoTelefone();

            foreach($telefones as $telefone)
            {
                $tabela .= $this->linhaDoTelefone($telefone);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoTelefone()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Número</td>
                    <td>Contato</td>
                    <td>Parentesco do Contato</td>
                    <td>Usuário</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDoTelefone($telefone)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->telefoneId($telefone['id']) .
                    $this->telefoneNumero($telefone['numero']) .
                    $this->telefoneContato($telefone['contato']) .
                    $this->telefoneParentescoDoContato($telefone['parentescoDoContato']) .
                    $this->telefoneUsuario($telefone['usuario']) .
                    $this->telefoneAlterar($telefone['id'],$telefone['usuarioId']) .
                    $this->telefoneExcluir($telefone['id'],$telefone['usuarioId']) .
                                
                "</tr>";
        }

        private function telefoneId($id)
        {
            return "<td>{$id}</td>";
        }

        private function telefoneNumero($numero)
        {
            return "<td>{$numero}</td>";
        }

        private function telefoneContato($contato)
        {
            return "<td>{$contato}</td>";
        }

        private function telefoneParentescoDoContato($parentescoDoContato)
        {
            return "<td>{$parentescoDoContato}</td>";
        }

        private function telefoneUsuario($usuario)
        {
            return "<td>{$usuario}</td>";
        }

        private function telefoneAlterar($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkAlterar('telefone',$id,$permissao)}</td>";
        }

        private function telefoneExcluir($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkExcluir('telefone',$id,$permissao)}</td>";
        }
        
        private function verificarNivelDeAcesso($usuarioId){
            if(
                $usuarioId == $_SESSION['id'] ||
                NivelDeAcesso::isRoot()
            )
            {
                return true;
            }
            else{
                return false;
            }
        }
    }