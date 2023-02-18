<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/enderecocontroller/formularioNovoEndereco'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Endereco</td>
        <td>Nome do Endereco</td>
        <td>Logradouro do Endereco</td>
        <td>Número do Endereco</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $endereco) {

        echo
        "<tr>" .
            "<td>" . $endereco->id .    "</td>" .
            "<td>" . $endereco->nome .        "</td>" .
            "<td>" . $endereco->logradouroId .       "</td>" . //logradouro
            "<td>" . $endereco->numeroId .       "</td>" . //numero
            "<td>
                    <a href='/web/livro_viagem/index.php/enderecocontroller/formularioAlterarEndereco/" . $endereco->id . "'>Alterar</a>
            </td>" .
            "<td>            
                    <a href='/web/livro_viagem/index.php/enderecocontroller/deletarEndereco/" . $endereco->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>