<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_status = array('name' => 'status','type' => 'hidden', 'value' => $tabela[0]['status']);
    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['nome']);
    $input_sigla = array('name' => 'sigla','class' => 'form-control','maxlength' => 2, 'value' => $tabela[0]['sigla']);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    echo "<h1>{$titulo}</h1>";
   
    echo form_open('estado/atualizar', $form_open);

        echo form_input($input_id);
        echo form_input($input_status);

        echo form_label( 'Estado', 'nome');        
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
   