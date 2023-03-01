<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/estadocontroller/formularioNovoEstado'>NOVO</a>
</br>
</br>
<table class="table table-hover">
    <tr>
        <td>Id</td>
        <td>Nome</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
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
            </td>" .
            "<td>
                    <a href='/web/livro_viagem/index.php/estadocontroller/deletarEstado/" . $estado->id . "'>Excluir</a>
            </td>" .
        "</tr>";
    }

    ?>


</table>

    <!-- início do botão na horizontal --> 
    <?php
       
       $fim = $apartirDoIndiceDoVetor + 5;
       $inicio = $fim - 5 - 4;

       if($inicio < 0){
            $inicio = 0;
            $fim = 9;
       }

       
       $quantidadeDePaginasMaxima = 0;
       $resultado = $count/10;

       if(is_float($resultado)){

        $paginas = ((int)$resultado) + 1;

       }else{
        $paginas = $resultado;
       }

       $quantidadeDePaginasMaxima = $paginas;
    
       if($fim > $quantidadeDePaginasMaxima){
            $fim = $quantidadeDePaginasMaxima;
       }
       
       echo "<div class='row'>" ; 
        
            for($index= $inicio ; $index < $fim ; $index++){
            
            if($index == $apartirDoIndiceDoVetor){
                echo "<div class='col-md-1'><a class='btn btn-primary disabled'  href='/web/livro_viagem/index.php/estadocontroller/listarEstados/" . $index . "'> " . ($index + 1) . "</a></div>";
            }else{
                echo "<div class='col-md-1'><a class='btn btn-primary'  href='/web/livro_viagem/index.php/estadocontroller/listarEstados/" . $index . "'> " . ($index + 1) . "</a></div>";
            }

            }
        
        echo "</div>";
  
    ?>