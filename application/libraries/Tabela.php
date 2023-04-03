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

        public function cidade($cidades)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidade($cidades);
        }

        public function cidadeMaisVisitadas($cidades)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidadeMaisVisitadas($cidades);
        }

        public function estado($estados)
        {
            $tabelaEstado = new TabelaEstado();
            return $tabelaEstado->estado($estados);
        }

        public function endereco($enderecos)
        {
            $tabelaEndereco = new TabelaEndereco();
            return $tabelaEndereco->endereco($enderecos);
        }

        public function funcao($funcoes)
        {
            $tabelaFuncao = new TabelaFuncao();
            return $tabelaFuncao->funcao($funcoes);
        }

        public function telefone($telefones)
        {
            $tabelaTelefone = new TabelaTelefone();
            return $tabelaTelefone->telefone($telefones);
        }

        public function usuario($usuarios)
        {
            $tabelaUsuario = new TabelaUsuario();
            return $tabelaUsuario->usuario($usuarios);
        }

        public function hierarquia($hierarquias)
        {
            $tabelaHierarquia = new TabelaHierarquia();
            return $tabelaHierarquia->hierarquia($hierarquias);
        }

        public function viagem($viagens)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagem($viagens);
        }

        public function viagemParaAprovacao($viagens)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagemParaAprovacao($viagens);
        }

        public function viagensAnalisadas($viagens)
        {
            $tabelaViagem = new TabelaViagem();
            return $tabelaViagem->viagensAnalisadas($viagens);
        }
    }

?>