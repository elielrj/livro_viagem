<?php

    class Link{

        public function linkAlterar($tabela, $id, $permitirAlterar = true)
        {
     
            if($permitirAlterar)
            {
                $link = "index.php/{$tabela}/alterar/{$id}";
                return "<a href='" . base_url($link) . "'>Alterar</a>";
            }
            else{
                return "-";
            }           
        }

        public function linkExcluir($tabela, $id, $permitirExcluir = true, $recuperar = false)
        {
            
            if($permitirExcluir)
            {
                $link = "index.php/{$tabela}/deletar/{$id}";

                if($recuperar)
                {
                    $link = "index.php/{$tabela}/recuperarUsuario/{$id}";
                }
                return "<a href='" . base_url($link) . "'>" . ($recuperar ? 'Recuperar': 'Excluir'). "</a>";
            }
            else
            {
                return "-";
            }
        }       
        
    }

?>