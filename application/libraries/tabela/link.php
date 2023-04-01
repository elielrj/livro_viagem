<?php

    class Link{

        public function linkAlterar($tabela, $id)
        {
            $link = "index.php/{$tabela}/alterar/{$id}";
            return "<a href='" . base_url($link) . "'>Alterar</a>";
        }

        public function linkExcluir($tabela, $id)
        {
            $link = "index.php/{$tabela}/deletar/{$id}";
            return "<a href='" . base_url($link) . "'>Excluir</a>";
        }
        
    }

?>