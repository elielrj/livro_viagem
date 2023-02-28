
<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/viagemcontroller/formularioNovoViagem'>NOVO</a>
</br>
</br>
<table class="table table-hover">
    <tr>
        <td>Código do Viagem</td>
        <td>Aprovada</td>
        <td>Território</td>
        <td>Motivo da Viagem</td>
        <td>Usuário</td>
        <td>Endereço</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $viagem) {
        echo
        "<tr>" .
            "<td>" . $viagem->id .    "</td>" .
            "<td>" . $viagem->aprovada .        "</td>" .
            "<td>" . $viagem->territorio .        "</td>" .
            "<td>" . $viagem->motivo .        "</td>" .
            "<td>" . $viagem->usuarioId .        "</td>" .
            "<td>" . $viagem->enderecoId .        "</td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/viagemcontroller/formularioAlterarViagem/" . $viagem->id . "'>Alterar</a>
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/viagemcontroller/deletarViagem/" . $viagem->id . "'>Excluir</a>
            </td>" .
        "</tr>";
    }

    ?>


</table>