<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/estadocontroller/formularioNovoEstado'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Estado</td>
        <td>Nome do Estado</td>
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