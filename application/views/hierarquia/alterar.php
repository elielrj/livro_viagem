<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_postoOuGraduacao = array('name' => 'postoOuGraduacao', 'class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['postoOuGraduacao']);
    $input_sigla = array('name' => 'sigla', 'class' => 'form-control', 'maxlength' => 10, 'value' => $tabela[0]['sigla']);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
   
    
    
    echo "<h1>{$titulo}</h1>";
    
    echo form_open('hierarquia/atualizar', $form_open);


    echo form_input($input_id);


    echo form_label('Posto ou Graduação'); 
            
        echo "</br>";

    echo form_input($input_postoOuGraduacao);
    
        echo "</br>";

    echo form_label('Sigla'); 

        echo "</br>";

    echo form_input($input_sigla);

        echo "</br>";

    echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/hierarquia') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

    echo form_close(); 
?>