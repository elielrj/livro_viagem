<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/cidadecontroller/formularioNovoCidade'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Cidade</td>
        <td>Nome da Cidade</td>
        <td>Estado</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $cidade) {

        echo
        "<tr>" .
            "<td>" . $cidade->id .    "</td>" .
            "<td>" . $cidade->nome .        "</td>" .
            "<td>" . $cidade->estadoId .       "</td>" . //estado
            "<td>" . $cidade->estadoId .       "</td>" . //sigla
            "<td>
                    <a href='/web/livro_viagem/index.php/cidadecontroller/formularioAlterarCidade/" . $cidade->id . "'>Alterar</a>
            </td>" .
            "<td>            
                    <a href='/web/livro_viagem/index.php/cidadecontroller/deletarCidade/" . $cidade->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>