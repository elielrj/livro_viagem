<?php

    class TabelaCidade{

        


        public function listarCidades($listaDeCidades){

            $tabela = $this->tr();

            foreach($listaDeCidades as $cidade)
            {
                $tabela .= $this->tr($cidade);
            }
        }

        private function tr($cidade = null)
        {
            return 
                "
                    <tr class='text-center'>
                        {$this->tdId(($cidade != null) ? $cidade['id'] : null)}
                        {$this->tdCidade(($cidade != null) ? $cidade['nome'] : null)}
                        {$this->estado(($cidade != null) ? $cidade['estado'] : null)}
                        {$this->sigla(($cidade != null) ? $cidade['sigla'] : null)}
                        {$this->tdAlterar(($cidade != null) ? $cidade['id'] : null)}
                        {$this->tdExcluir(($cidade != null) ? $cidade['id'] : null)}
                    </tr>
                ";
        }

        private function tdId($id = 'Id')
        {
            return "<td>{$id}</td>";
        }

        private function tdCidade($cidade = 'Cidade')
        { 
            return "<td>{$cidade}</td>";
        }

        private function tdEstado($estado = 'Estado')
        { 
            return "<td>{$estado}</td>";
        }

        private function tdSigla($sigla = 'Sigla')
        { 
            return "<td>{$sigla}</td>";
        }

        private function tdAlterar($id = null)
        { 
            if($id == null){
                return 'Alterar';
            }else{

                return 
                "
                    <td>
                        <a href='" . base_url() . "index.php/cidade/alterar/{$id}'>
                            Alterar
                        </a>
                    </td>
                "
            ;

            }
        }

        private function tdExcluir($id = null)
        { 
            if($id == null){
                return 'Excluir';
            }else{

                return 
                "
                    <td>
                        <a href='" . base_url() . "index.php/cidade/alterar/{$id}'>
                            Alterar
                        </a>
                    </td>
                "
            ;

            }
        }
    }