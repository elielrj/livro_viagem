<?php
    
    include_once('tabela/TabelaCidade.php');
    include_once('tabela/TabelaEstado.php');

    class Tabela {

        public function cidade($cidades)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidade($cidades);
        }

        public function estado($estados)
        {
            $tabelaEstado = new TabelaEstado();
            return $tabelaEstado->estado($estados);
        }
    }

?>