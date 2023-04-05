<?php

    include_once('Link.php');

    class TabelaTelefone extends Link{

        private $ordem;

        public function telefone($telefones, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoTelefone();

            foreach($telefones as $telefone)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoTelefone($telefone);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoTelefone()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Número</td>
                    <td>Contato</td>
                    <td>Parentesco do Contato</td>
                    <td>Usuário</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDoTelefone($telefone)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->telefoneOrdem() .
                    $this->telefoneNumero($telefone['numero']) .
                    $this->telefoneContato($telefone['contato']) .
                    $this->telefoneParentescoDoContato($telefone['parentescoDoContato']) .
                    $this->telefoneUsuario($telefone['usuario']) .
                    $this->telefoneStatus($telefone['status']) .
                    $this->telefoneAlterar($telefone['id'],$telefone['usuarioId']) .
                    $this->telefoneExcluir($telefone['id'],$telefone['usuarioId'], $telefone['status']) .
                                
                "</tr>";
        }

        private function telefoneOrdem()
        {
            return "<td>{$this->ordem}</td>";
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

        private function telefoneStatus($status)
        {
            return 
                "<td><p style='color:" . ($status ? 'green' : 'red') ."'>" . ($status ? 'Ativo' : 'Inativa') . "</p></td>";
        }

        private function telefoneAlterar($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkAlterar('telefone',$id,$permissao)}</td>";
        }

        private function telefoneExcluir($id,$usuarioId,$status)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('telefone',$id,$permissao,$recuperar)}</td>";
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