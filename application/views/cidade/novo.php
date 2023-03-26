<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $selected = array('name' => 24);
    $form_dropdown_estado = array('class' => 'form-control', 'id' => 'estadoId' );
    
    echo "<h1>{$titulo}</h1>";
    
    echo form_open('cidade/criar', $form_open);
    
        echo form_label( 'Cidade', 'nome');        
        echo form_input($input_nome);

            echo "</br>";        

        echo form_label('Estado','estadoId'); 
            
            echo "</br>";
             
        echo form_dropdown("estadoId", $select, $selected, $form_dropdown_estado);

            echo "</br>";
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/cidade') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();    

?>
