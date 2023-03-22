<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_poder = array('class' => 'form-control', 'id' => 'poderId');


    echo "<h1>{$titulo}</h1>";
    
    echo form_open('nivelDeAcesso/criar', $form_open);

        echo form_label('Poder');
        echo form_dropdown("poder", $select_nivelDeAcesso, '' , $form_dropdown_poder);

            echo "</br>";

        echo form_label('Status do Nível de Acesso:');
             echo "</br>";
        echo form_radio('status', true, true) . form_label('Ativo');
            echo "</br>";
        echo form_radio('status', false) . form_label('Inativo');

            echo "</br>";
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/nivelDeAcesso') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();    

?>
