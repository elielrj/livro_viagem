<?php

    include_once('opcoes/OpcoesCidade.php');
    
    class Opcoes{

        public function cidade($cidades)
        {
            $optionsCidade = new OpcoesCidade();
            return $optionsCidade->cidade($cidades);
        }
    }
?>