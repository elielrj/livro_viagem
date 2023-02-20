<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/telefonecontroller/formularioNovoTelefone'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Numero</td>
        <td>Número do Telefone</td>
        <td>Parentesco do Contato</td>
        <td>Contato de Emergência</td>
        <td>Contato de Localização</td>
        <td>Usuário do Telefone</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $telefone) {
        echo
        "<tr>" .
            "<td>" . $telefone->id .    "</td>" .
            "<td>" . $telefone->numero .        "</td>" .
            "<td>" . $telefone->parentescoDoContato .        "</td>" .
            "<td>" . $telefone->contatoDeEmergencia .        "</td>" .
            "<td>" . $telefone->contatoDeLocalizacao .        "</td>" .
            "<td>" . $telefone->usuarioId .        "</td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/telefonecontroller/formularioAlterarTelefone/" . $telefone->id . "'>Alterar</a>
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/telefonecontroller/deletarTelefone/" . $telefone->id . "'>Excluir</a>
            </td>" .
        "</tr>";
    }

    ?>


</table>