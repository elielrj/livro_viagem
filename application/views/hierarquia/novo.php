<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $form_open = array('class' => 'form-group');
    $input_postoOuGraduacao = array('name' => 'postoOuGraduacao', 'class' => 'form-control', 'maxlength' => 100);
    $input_sigla = array('name' => 'sigla', 'class' => 'form-control', 'maxlength' => 10);  
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    
    echo "<h1>{$titulo}</h1>";

    echo form_open($metodo, $form_open);

        echo form_label('Posto ou Graduação');
        echo form_input($input_postoOuGraduacao);

            echo "</br>";

        echo form_label('Sigla');
        echo form_input($input_sigla);

            echo "</br>";

        echo form_submit('enviar', 'Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/hierarquia') .
            " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

    echo form_close();
      
?>
