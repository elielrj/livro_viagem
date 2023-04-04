<?php

    include_once('Link.php');

    class TabelaUsuario extends Link{

        private $ordem;

        public function usuario($usuarios, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoUsuario();

            foreach($usuarios as $usuario)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoUsuario($usuario);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoUsuario()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Nome</td>
                    <td>Status</td>
                    <td>Data de Criação</td>
                    <td>Último Acesso</td>
                    <td>Hierarquia</td>
                    <td>Email</td>
                    <td>Senha</td>
                    <td>Função</td>
                    <td>Nível de Acesso</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDoUsuario($usuario)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->usuarioOrdem() .
                    $this->usuarioNome($usuario['nome']) .
                    $this->usuarioStatus($usuario['status']) .
                    $this->usuarioDataDeCriacao($usuario['dataDeCriacao']) .
                    $this->usuarioUltimoAcesso($usuario['ultimoAcesso']) .
                    $this->usuarioSiglaDaHierarquia($usuario['hierarquia']) .
                    $this->usuarioEmail($usuario['email']) .
                    $this->usuarioSenha($usuario['senha']) .
                    $this->usuarioNomeDaFuncao($usuario['funcao']) .
                    $this->usuarioNivelDeAcesso($usuario['nivelDeAcesso']) .
                    $this->usuarioAlterar($usuario['id'],$usuario['id']) .
                    $this->usuarioExcluir($usuario['id'],$usuario['id'],$usuario['status']) .
                                
                "</tr>";
        }

        private function usuarioOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }

        private function usuarioNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function usuarioStatus($status)
        {
            return "<td><p style='color:" . ($status ? 'green' : 'red') . "'>" . ($status ? 'Ativo' : 'Inativo') . "</p></td>";
        }

        private function usuarioDataDeCriacao($dataDeCriacao)
        {
            return "<td>{$dataDeCriacao}</td>";
        }

        private function usuarioUltimoAcesso($ultimoAcesso)
        {
            return "<td>{$ultimoAcesso}</td>";
        }

        private function usuarioSiglaDaHierarquia($hierarquia)
        {
            return "<td>{$hierarquia}</td>";
        }

        private function usuarioEmail($email)
        {
            return "<td>{$email}</td>";
        }

        private function usuarioSenha($senha)
        {
            return "<td>{$senha}</td>";
        }

        private function usuarioNomeDaFuncao($funcao)
        {
            return "<td>{$funcao}</td>";
        }

        private function usuarioNivelDeAcesso($nivelDeAcesso)
        {
            return "<td>{$nivelDeAcesso}</td>";
        }

        private function usuarioAlterar($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkAlterar('usuario',$id,$permissao)}</td>";
        }

        private function usuarioExcluir($id,$usuarioId,$status)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('usuario',$id,$permissao,$recuperar)}</td>";
        }
        
        private function verificarNivelDeAcesso($usuarioId){
            if(
                $usuarioId == $_SESSION['id'] ||
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