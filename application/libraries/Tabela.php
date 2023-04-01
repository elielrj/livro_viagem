<?php
    
    include_once('tabela/TabelaCidade.php');

    class Tabela {

        public function cidade($cidades)
        {
            $tabelaCidade = new TabelaCidade();
            return $tabelaCidade->cidade($cidades);
        }
    }

?>