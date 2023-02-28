<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/cidadecontroller/formularioNovoCidade'>NOVO</a>
</br>
</br>
<table class="table table-hover">
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
            "<td>" . $cidade->estado->nome .       "</td>" . //estado
            "<td>" . $cidade->estado->sigla .       "</td>" . //sigla
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

<table>
    <tr>
    <?php

        for($index=0 ; $index < count($tabela) ; $index++){
            //<!-- Standard button -->
           echo 
                "
                <td> 
                    <ul>
                        <button type='button class='btn btn-default'>" . ((int)$index+1) . "</button> 
                    </ul>
                </td>";
        }

        

    ?>
    </tr>
</table>
    
    