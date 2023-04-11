<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100);
    $input_sigla = array('name' => 'sigla','class' => 'form-control','maxlength' => 2);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    echo "<h1>{$titulo}</h1>";
    
    echo form_open($metodo, $form_open);
    
        echo form_label( 'Nome', 'nome');        
        echo form_input($input_nome);

            echo "</br>";
        
        echo form_label('Sigla','sigla');        
        echo form_input($input_sigla);

            echo "</br>";
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/estado') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();    

?>
