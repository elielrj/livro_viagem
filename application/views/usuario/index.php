<h1><?php echo $titulo ?></h1>

<a href='/web/livro_viagem/index.php/usuariocontroller/formularioNovoUsuario'>NOVO</a>

<table border=1>
    <tr>
        <td>Código do Usuario</td>
        <td>Nome da Usuario</td>
        <td>Status</td>
        <td>Data da Criação</td>
        <td>Último Acesso</td>
        <td>Hierarquia</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php
    
    foreach ($tabela as $usuario) {

        echo
        "<tr>" .
            "<td>" . $usuario->id .    "</td>" .
            "<td>" . $usuario->nome .        "</td>" .
            "<td>" . $usuario->status .       "</td>" . //estado
            "<td>" . $usuario->dataDeCriacao .       "</td>" . //data de criação
            "<td>" . $usuario->ultimoAcesso .       "</td>" . //último acesso
            "<td>" . $usuario->hierarquiaId .       "</td>" . //hierarquia
            "<td>
                    <a href='/web/livro_viagem/index.php/usuariocontroller/formularioAlterarUsuario/" . $usuario->id . "'>Alterar</a>
            </td>" .
            "<td>            
                    <a href='/web/livro_viagem/index.php/usuariocontroller/deletarUsuario/" . $usuario->id . "'>Deletar</a>
                </td>" .
            "</tr>";
    }

    ?>


</table>