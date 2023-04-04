<?php

    include_once('Link.php');

    class TabelaCidade extends Link{

        public function cidade($cidades)
        {
            $tabela = $this->linhaDeCabecalhoDaCidade();

            foreach($cidades as $cidade)
            {
                $tabela .= $this->linhaDeCidade($cidade);
            }
            return $tabela;
        }

        public function cidadeMaisVisitadas($cidades)
        {
            $tabela = $this->linhaDeCabecalhoDaCidadeMaisVisitadas();

            foreach($cidades as $cidade)
            {
                $tabela .= $this->linhaDeCidadeMaisVisitadas($cidade);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDaCidade()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Cidade</td>
                    <td>Estado</td>
                    <td>Sigla</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDeCabecalhoDaCidadeMaisVisitadas()
        {
            return
                "<tr class='text-center'> 
                    <td>Id</td>
                    <td>Cidade</td>
                    <td>Estado</td>             
                </tr>";
        }

        private function linhaDeCidade($cidade)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->cidadeId($cidade['id']) .
                    $this->cidadeNome($cidade['nome']) .
                    $this->cidadeNomeDoEstado($cidade['estado']) .
                    $this->cidadeSiglaDoEstado($cidade['sigla']) .
                    $this->cidadeAlterar($cidade['id']) .
                    $this->cidadeExcluir($cidade['id']) .
                                
                "</tr>";
        }

        private function linhaDeCidadeMaisVisitadas($cidade)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->cidadeId($cidade['cidade_nome']) .
                    $this->cidadeNome($cidade['count']) .
                    $this->cidadeNomeDoEstado($cidade['estado_nome']) .
                                
                "</tr>";
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

        private function cidadeAlterar($id)
        {
            return "<td>{$this->linkAlterar('cidade',$id)}</td>";
        }

        private function cidadeExcluir($id)
        {
            return "<td>{$this->linkExcluir('cidade',$id)}</td>";
        }
        
    }