<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/estadocontroller/formularioNovoEstado'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Estado</td>
        <td>Nome</td>
        <td>Sigla</td>
        <td>Opções</td>
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
                    <a href='/web/livro_viagem/index.php/estadocontroller/deletarEstado/" . $estado->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>