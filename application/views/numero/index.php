<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/numerocontroller/formularioNovoNumero'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Numero</td>
        <td>Valor</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $numero) {
        echo
        "<tr>" .
            "<td>" . $numero->id .    "</td>" .
            "<td>" . $numero->valor .        "</td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/numerocontroller/formularioAlterarNumero/" . $numero->id . "'>Alterar</a>
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/numerocontroller/deletarNumero/" . $numero->id . "'>Excluir</a>
            </td>" .
        "</tr>";
    }

    ?>


</table>