<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/hierarquiacontroller/formularioNovoHierarquia'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Hierarquia</td>
        <td>Pouto ou Graduação</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $hierarquia) {
        echo
        "<tr>" .
            "<td>" . $hierarquia->id .    "</td>" .
            "<td>" . $hierarquia->postoOuGraduacao .        "</td>" .
            "<td>" . $hierarquia->sigla .        "</td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/hierarquiacontroller/formularioAlterarHierarquia/" . $hierarquia->id . "'>Alterar</a>
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/hierarquiacontroller/deletarHierarquia/" . $hierarquia->id . "'>Excluir</a>
            </td>" .
        "</tr>";
    }

    ?>


</table>