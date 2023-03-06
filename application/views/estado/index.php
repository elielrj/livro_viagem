<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/estadocontroller/formularioNovoEstado'>NOVO</a>
</br>
</br>
<table class="table table-hover">
    <tr>
        <td>Id</td>
        <td>Nome</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $estado) {
        echo
        "<tr>" .
            "<td>" . $estado->id .    "</td>" .
            "<td>" . $estado->nome .        "</td>" .
            "<td>" . $estado->sigla .       "</td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/estadocontroller/formularioAlterarEstado/" . $estado->id . "'>Alterar</a>
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/estadocontroller/deletarEstado/" . $estado->id . "'>Excluir</a>
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