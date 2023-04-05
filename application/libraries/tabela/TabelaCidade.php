<?php

    include_once('Link.php');

    class TabelaCidade extends Link{

        private $ordem;
        
        public function cidade($cidades, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDaCidade();

            foreach($cidades as $cidade)
            {
                $this->ordem++;
                $tabela .= $this->linhaDeCidade($cidade);
            }
            return $tabela;
        }

        public function cidadeMaisVisitadas($cidades)
        {
            $tabela = $this->linhaDeCabecalhoDaCidadeMaisVisitadas();

            $ordem = 0;
            foreach($cidades as $cidade)
            {
                $ordem++;
                $tabela .= $this->linhaDeCidadeMaisVisitadas($cidade, $ordem);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaCidade()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Cidade</td>
                    <td>Estado</td>
                    <td>Sigla</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDeCabecalhoDaCidadeMaisVisitadas()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Quantidades de Viagens</td>
                    <td>Cidade</td>
                    <td>Estado</td>             
                </tr>";
        }

        private function linhaDeCidade($cidade)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->cidadeOrdem() .
                    $this->cidadeNome($cidade['nome']) .
                    $this->cidadeNomeDoEstado($cidade['estado']) .
                    $this->cidadeSiglaDoEstado($cidade['sigla']) .
                    $this->cidadeStatus($cidade['status']) .
                    $this->cidadeAlterar($cidade['id']) .
                    $this->cidadeExcluir($cidade['id'],$cidade['status']) .
                                
                "</tr>";
        }

        private function linhaDeCidadeMaisVisitadas($cidade, $ordem)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->cidadeOrdem() .
                    $this->cidadeNome($cidade['count']) .
                    $this->cidadeId($cidade['cidade_nome']) .
                    $this->cidadeNomeDoEstado($cidade['estado_nome']) .
                                
                "</tr>";
        }

        private function cidadeOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }

        private function cidadeId($id)
        {
            return "<td>{$id}</td>";
        }

        private function cidadeNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function cidadeNomeDoEstado($estado)
        {
            return "<td>{$estado}</td>";
        }

        private function cidadeSiglaDoEstado($sigla)
        {
            return "<td>{$sigla}</td>";
        }
        
        private function cidadeStatus($status)
        {
            return "<td><p style='color:" . ($status ? 'green' : 'red') . "'>" . ($status ? 'Ativo' : 'Inativo') . "</p></td>";
        }

        private function cidadeAlterar($id)
        {
            return "<td>{$this->linkAlterar('cidade',$id)}</td>";
        }

        private function cidadeExcluir($id,$status)
        {
            $permissao = $this->verificarNivelDeAcesso();

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('cidade',$id,$permissao,$recuperar)}</td>";
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