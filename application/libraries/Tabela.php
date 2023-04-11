<?php
    
    include_once('tabela/TabelaCidade.php');
    include_once('tabela/TabelaEstado.php');
    include_once('tabela/TabelaEndereco.php');
    include_once('tabela/TabelaFuncao.php');
    include_once('tabela/TabelaTelefone.php');
    include_once('tabela/TabelaUsuario.php');
    include_once('tabela/TabelaHierarquia.php');
    include_once('tabela/TabelaViagem.php');

    class Tabela {

        public function cidade($cidades, $ordem)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidade($cidades, $ordem);
        }

        public function cidadeMaisVisitadas($cidades)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidadeMaisVisitadas($cidades);
        }

        public function estado($estados, $ordem)
        {
            $tabelaEstado = new TabelaEstado();
            return $tabelaEstado->estado($estados, $ordem);
        }

        public function endereco($enderecos, $ordem)
        {
            $tabelaEndereco = new TabelaEndereco();
            return $tabelaEndereco->endereco($enderecos, $ordem);
        }

        public function funcao($funcoes, $ordem)
        {
            $tabelaFuncao = new TabelaFuncao();
            return $tabelaFuncao->funcao($funcoes, $ordem);
        }

        public function telefone($telefones, $ordem)
        {
            $tabelaTelefone = new TabelaTelefone();
            return $tabelaTelefone->telefone($telefones, $ordem);
        }

        public function usuario($usuarios, $ordem)
        {
            $tabelaUsuario = new TabelaUsuario();
            return $tabelaUsuario->usuario($usuarios, $ordem);
        }

        public function hierarquia($hierarquias, $ordem)
        {
            $tabelaHierarquia = new TabelaHierarquia();
            return $tabelaHierarquia->hierarquia($hierarquias, $ordem);
        }

        public function viagem($viagens, $ordem)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagem($viagens, $ordem);
        }

        public function viagemParaAprovacao($viagens, $ordem)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagemParaAprovacao($viagens, $ordem);
        }

        public function viagensAnalisadas($viagens, $ordem)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagensAnalisadas($viagens, $ordem);
        }
    }

?>