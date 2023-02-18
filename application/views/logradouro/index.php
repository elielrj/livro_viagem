<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/logradourocontroller/formularioNovoLogradouro'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Logradouro</td>
        <td>Nome do Logradouro</td>
        <td>Bairro do Logradouro</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $logradouro) {

        echo
        "<tr>" .
            "<td>" . $logradouro->id .    "</td>" .
            "<td>" . $logradouro->nome .        "</td>" .
            "<td>" . $logradouro->bairroId .       "</td>" . //logradouro
            "<td>
                    <a href='/web/livro_viagem/index.php/logradourocontroller/formularioAlterarLogradouro/" . $logradouro->id . "'>Alterar</a>
            </td>" .
            "<td>            
                    <a href='/web/livro_viagem/index.php/logradourocontroller/deletarLogradouro/" . $logradouro->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>