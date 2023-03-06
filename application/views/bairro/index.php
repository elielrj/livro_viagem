<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/bairrocontroller/formularioNovoBairro'>NOVO</a>
</br>
</br>
<table class="table table-hover">
    <tr>
        <td>Id</td>
        <td>Nome</td>
        <td>Bairro</td>
        <td>Cidade</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $bairro) {

        echo
        "<tr>" .
            "<td>" . $bairro->id .    "</td>" .
            "<td>" . $bairro->nome .        "</td>" .
            "<td>" . $bairro->cidade->nome .       "</td>" . //cidade
            "<td>" . $bairro->cidade->estado->nome .       "</td>" . //estado
            "<td>" . $bairro->cidade->estado->sigla .      "</td>" . //sigla
            "<td>
                    <a href='/web/livro_viagem/index.php/bairrocontroller/formularioAlterarBairro/" . $bairro->id . "'>Alterar</a>
            </td>" .
            "<td>            
                    <a href='/web/livro_viagem/index.php/bairrocontroller/deletarBairro/" . $bairro->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>


<!-- início do botão na horizontal --> 
<?php 
        if(isset($apartirDoIndiceDoVetor)){
            include_once ('botoes.php');
        }; 
?>

