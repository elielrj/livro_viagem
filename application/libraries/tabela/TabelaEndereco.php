<?php

    include_once('Link.php');

    class TabelaEndereco extends Link{

        public function endereco($enderecos)
        {
            $tabela = $this->linhaDeCabecalhoDoEndereco();

            foreach($enderecos as $endereco)
            {
                $tabela .= $this->linhaDoEndereco($endereco);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoEndereco()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Nome do Endereço</td>
                    <td>Logradouro</td>
                    <td>Número</td>
                    <td>Bairro</td>
                    <td>Cidade</td>
                    <td>Estado</td>
                    <td>Sigla</td>
                    <td>Cadastrador</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoEndereco($endereco)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->enderecoId($endereco['id']) .
                    $this->enderecoNome($endereco['nome']) .
                    $this->enderecoLogradouro($endereco['logradouro']) .
                    $this->enderecoNumero($endereco['numero']) .
                    $this->enderecoNomeDoBairro($endereco['bairro']) .
                    $this->enderecoNomeDaCidade($endereco['cidade']) .
                    $this->enderecoNomeDoEstado($endereco['estado']) .
                    $this->enderecoSiglaDoEstado($endereco['sigla']) .
                    $this->enderecoNomeDoCadastrador($endereco['usuario']) .
                    $this->enderecoAlterar($endereco['id'], $endereco['usuarioId']) .
                    $this->enderecoExcluir($endereco['id'], $endereco['usuarioId']) .
                                
                "</tr>";
        }

        private function enderecoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function enderecoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function enderecoLogradouro($logradouro)
        {
            return "<td>{$logradouro}</td>";
        }

        private function enderecoNumero($numero)
        {
            return "<td>{$numero}</td>";
        }

        private function enderecoNomeDoBairro($bairro)
        {
            return "<td>{$bairro}</td>";
        }

        private function enderecoNomeDaCidade($cidade)
        {
            return "<td>{$cidade}</td>";
        }

        private function enderecoNomeDoEstado($estado)
        {
            return "<td>{$estado}</td>";
        }

        private function enderecoSiglaDoEstado($sigla)
        {
            return "<td>{$sigla}</td>";
        }

        private function enderecoNomeDoCadastrador($usuario)
        {
            return "<td>{$usuario}</td>";
        }

        private function enderecoAlterar($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkAlterar('endereco',$id,$permissao)}</td>";
        }

        private function enderecoExcluir($id,$usuarioId)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId);

            return "<td>{$this->linkExcluir('endereco',$id,$permissao)}</td>";
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