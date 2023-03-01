<h1><?php echo $titulo ?></h1>

<a class="btn btn-primary btn-sm" href='/web/livro_viagem/index.php/bairrocontroller/formularioNovoBairro'>NOVO</a>
</br>
</br>
<table class="table table-hover">
    <tr>
        <td>Id</td>
        <td>Nome</td>
        <td>Bairro</td>
        <td>Cidade</td>
        <td>Sigla</td>
        <td>Alterar</td>
        <td>Excluir</td>
    </tr>

    <?php

    foreach ($tabela as $bairro) {

        echo
        "<tr>" .
            "<td>" . $bairro->id .    "</td>" .
            "<td>" . $bairro->nome .        "</td>" .
            "<td>" . $bairro->cidade->nome .       "</td>" . //cidade
            "<td>" . $bairro->cidade->estado->nome .       "</td>" . //estado
            "<td>" . $bairro->cidade->estado->sigla .      "</td>" . //sigla
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
                echo "<div class='col-md-1'><a class='btn btn-primary disabled'  href='/web/livro_viagem/index.php/bairrocontroller/listarBairros/" . $index . "'> " . ($index + 1) . "</a></div>";
            }else{
                echo "<div class='col-md-1'><a class='btn btn-primary'  href='/web/livro_viagem/index.php/bairrocontroller/listarBairros/" . $index . "'> " . ($index + 1) . "</a></div>";
            }

            }
        
        echo "</div>";
  
    ?>