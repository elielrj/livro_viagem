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