<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/bairrocontroller/formularioNovoBairro'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Bairro</td>
        <td>Nome do Bairro</td>
        <td>Cidade do Bairro</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $bairro) {

        echo
        "<tr>" .
            "<td>" . $bairro->id .    "</td>" .
            "<td>" . $bairro->nome .        "</td>" .
            "<td>" . $bairro->cidadeId .       "</td>" . //bairro
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