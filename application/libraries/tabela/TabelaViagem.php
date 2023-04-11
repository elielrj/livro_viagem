<?php

    include_once('Link.php');

    class TabelaViagem extends Link{

        private $ordem;

        public function viagem($viagens, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDeViagem();

            foreach($viagens as $viagem)
            {
                $this->ordem++;
                $tabela .= $this->linhaDeViagem($viagem);
            }
            return $tabela;
        }

        public function viagemParaAprovacao($viagens, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDeViagemParaAprovacao();

            foreach($viagens as $viagem)
            {
                $this->ordem++;
                $tabela .= $this->linhaDeViagemParaAprovar($viagem);
            }
            return $tabela;
        }

        public function viagensAnalisadas($viagens, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDeViagemAnalisada();

            foreach($viagens as $viagem)
            {
                $this->ordem++;
                $tabela .= $this->linhaDeViagemAnalisada($viagem);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDeViagem()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Aprovada</td>
                    <td>Território</td>
                    <td>Motivo</td>
                    <td>Usuário</td>
                    <td>Endereço</td>
                    <td>Data Ida</td>
                    <td>Data Volta</td>
                    <td>Observação</td>
                    <td>Análisada</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>              
                </tr>";
        }

        private function linhaDeCabecalhoDeViagemParaAprovacao()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Aprovada</td>
                    <td>Território</td>
                    <td>Motivo</td>
                    <td>Usuário</td>
                    <td>Endereço</td>
                    <td>Data Ida</td>
                    <td>Data Volta</td>
                    <td>Observação</td>
                    <td>Análisada</td>
                    <td>Status</td>
                    <td>Autorizar</td>
                    <td>Não Autorizar</td>              
                </tr>";
        }

        private function linhaDeCabecalhoDeViagemAnalisada()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Aprovada</td>
                    <td>Território</td>
                    <td>Motivo</td>
                    <td>Usuário</td>
                    <td>Endereço</td>
                    <td>Data Ida</td>
                    <td>Data Volta</td>
                    <td>Observação</td>
                    <td>Análisada</td>
                    <td>Status</td>
                </tr>";
        }

        private function linhaDeViagem($viagem)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->viagemOrdem() .
                    $this->viagemAprovada($viagem['aprovada']) .
                    $this->viagemTerritorio($viagem['territorio']) .
                    $this->viagemMotivo($viagem['motivo']) .
                    $this->viagemUsuario($viagem['usuario']) .
                    $this->viagemEndereco($viagem['endereco']) .
                    $this->viagemDataIda($viagem['dataIda']) .
                    $this->viagemDataVolta($viagem['dataVolta']) .
                    $this->viagemObservacao($viagem['observacao']) .
                    $this->viagemAnalisada($viagem['analisada']) .
                    $this->viagemStatus($viagem['status']) .
                    $this->viagemAlterar($viagem['id'],$viagem['usuarioId'],$viagem['analisada']) .
                    $this->viagemExcluir($viagem['id'],$viagem['usuarioId'],$viagem['analisada'],$viagem['status']) .
                                
                "</tr>";
        }

        private function linhaDeViagemParaAprovar($viagem)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->viagemOrdem() .
                    $this->viagemAprovada($viagem['aprovada']) .
                    $this->viagemTerritorio($viagem['territorio']) .
                    $this->viagemMotivo($viagem['motivo']) .
                    $this->viagemUsuario($viagem['usuario']) .
                    $this->viagemEndereco($viagem['endereco']) .
                    $this->viagemDataIda($viagem['dataIda']) .
                    $this->viagemDataVolta($viagem['dataVolta']) .
                    $this->viagemObservacao($viagem['observacao']) .
                    $this->viagemAnalisada($viagem['analisada']) .
                    $this->viagemStatus($viagem['status']) .
                    $this->viagemAutorizar($viagem['id'],$viagem['usuarioId'],$viagem['analisada']) .
                    $this->viagemNaoAutorizar($viagem['id'],$viagem['usuarioId'],$viagem['analisada']) .
                                
                "</tr>";
        }

        private function linhaDeViagemAnalisada($viagem)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->viagemOrdem() .
                    $this->viagemAprovada($viagem['aprovada']) .
                    $this->viagemTerritorio($viagem['territorio']) .
                    $this->viagemMotivo($viagem['motivo']) .
                    $this->viagemUsuario($viagem['usuario']) .
                    $this->viagemEndereco($viagem['endereco']) .
                    $this->viagemDataIda($viagem['dataIda']) .
                    $this->viagemDataVolta($viagem['dataVolta']) .
                    $this->viagemObservacao($viagem['observacao']) .
                    $this->viagemAnalisada($viagem['analisada']) .
                    $this->viagemStatus($viagem['status']) .
                                
                "</tr>";
        }

        private function viagemOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }

        private function viagemAprovada($aprovada)
        {
            return 
                "<td><p style='color:" . ($aprovada ? 'green' : 'red') ."'>" . 
                (($aprovada == null) 
                    ? 'Aguardando...' 
                    : ($aprovada ? 'Sim' : 'Não')) .
                    "</p></td>";
        }

        private function viagemTerritorio($territorio)
        {
            if($territorio == Viagem_Model::$NACIONAL){
                $territorio = Viagem_Model::$NACIONAL_PT;
            }else{
                $territorio = Viagem_Model::$INTERNACIONAL_PT;
            }
            return "<td>{$territorio}</td>";
        }

        private function viagemMotivo($motivo)
        {
            if($motivo == Viagem_Model::$PARTICULAR){
                $motivo = Viagem_Model::$PARTICULAR_PT;
            }else if($motivo == Viagem_Model::$SERVICO){
                $motivo = Viagem_Model::$SERVICO_PT;
            }else{
                $motivo = Viagem_Model::$FERIAS_PT;
            }
            return "<td>{$motivo}</td>";
        }

        private function viagemUsuario($usuario)
        {
            return "<td>{$usuario}</td>";
        }

        private function viagemEndereco($endereco)
        {
            return "<td>{$endereco}</td>";
        }

        private function viagemDataIda($dataIda)
        {
            return "<td>" . $this->formatarData($dataIda) ."</td>";
        }

        private function viagemDataVolta($dataVolta)
        {
            
            return "<td>" . $this->formatarData($dataVolta) ."</td>";
        }

        private function viagemObservacao($observacao)
        {
            return "<td>{$observacao}</td>";
        }

        private function viagemAnalisada($analisada)
        {
            return 
                "<td><p style='color:" . ($analisada ? 'green' : 'red') ."'>" . ($analisada ? 'Sim' : 'Não') . "</p></td>";
        }

        private function viagemStatus($status)
        {
            return 
                "<td><p style='color:" . ($status ? 'green' : 'red') ."'>" . ($status ? 'Ativo' : 'Inativa') . "</p></td>";
        }

        private function viagemAlterar($id,$usuarioId,$analisada)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId,$analisada);

            return "<td>{$this->linkAlterar('viagem',$id,$permissao)}</td>";
        }
        
        private function viagemExcluir($id,$usuarioId,$analisada,$status)
        {
            $permissao = $this->verificarNivelDeAcesso($usuarioId,$analisada);

            $recuperar = $status ? false : true;

            return "<td>{$this->linkExcluir('viagem',$id,$permissao,$recuperar)}</td>";
        }
        
        private function verificarNivelDeAcesso($usuarioId, $analisada){            
            if(
                (!$analisada) &&
                ($usuarioId == $_SESSION['id'] || NivelDeAcesso::isRoot())
            )
            {
                return true;
            }
            else{
                return false;
            }
        }

        private function verificarNivelDeAcessoParaAprovador($usuarioId, $analisada){            
            if(
                (!$analisada) &&
                ($usuarioId == $_SESSION['id'] || NivelDeAcesso::isRoot() || NivelDeAcesso::isDispatcher())
            )
            {
                return true;
            }
            else{
                return false;
            }
        }

        private function viagemAutorizar($id,$usuarioId,$analisada)
        {
            $permissao = $this->verificarNivelDeAcessoParaAprovador($usuarioId,$analisada);

            return "<td>{$this->autorizar('viagem',$id,$permissao)}</td>";
        }
        private function viagemNaoAutorizar($id,$usuarioId,$analisada)
        {
            $permissao = $this->verificarNivelDeAcessoParaAprovador($usuarioId,$analisada);

            return "<td>{$this->naoAutorizar('viagem',$id,$permissao)}</td>";
        }

        private function autorizar($tabela, $id, $permitirAlterar = true)
        {
            if($permitirAlterar)
            {
                $link = "index.php/{$tabela}/aprovar/{$id}";
                return "<a href='" . base_url($link) . "'>Autorizar</a>";
            }
            else{
                return "-";
            }
        }

        private function naoAutorizar($tabela, $id, $permitirAlterar = true)
        {
            if($permitirAlterar)
            {
                $link = "index.php/{$tabela}/naoAprovar/{$id}";
                return "<a href='" . base_url($link) . "'>Não Autorizar</a>";
            }
            else{
                return "-";
            }
        }

        public function formatarData($data)
        {
            return form_input(array('type' => 'date', 'value' => $data, 'disabled' => 'disable',  'class' => 'text-center'));
        }
    }