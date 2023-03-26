<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_numero = array('name' => 'numero', 'class' => 'form-control', 'type' => 'telephone', 'maxlength' => 11 , 'minlength' => 11, 'placeholder' => "(xx) xxxxx-xxxx");
    $input_parentesco_contato = array('name' => 'parentescoDoContato', 'class' => 'form-control form-group', 'maxlength' => 100 );
    $input_usuario = array('name' => 'usuarioId','class' => 'form-control', 'type' => 'hidden', 'value' => $usuarioId);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


    
    echo "<h1>{$titulo}</h1>";
    
    echo form_open('telefone/criar', $form_open);

        //* id  *//
        //* número  *//
        
        echo form_label('Número');

            echo "</br>";
        
        echo form_input($input_numero);

            echo "</br></br>";

        //* contato  *//
        
        echo form_label('Contato:');
             echo "</br>";
        echo form_radio('contato', 'EMERGENCIA') . form_label('Emergência');
            echo "</br>";
        echo form_radio('contato', 'LOCALIZACAO', true) . form_label('Localização');

            echo "</br></br>";

        //* contato do parentesco  *//

        echo form_label('Parentesco do Contato');
             echo "</br>";
        echo form_input($input_parentesco_contato);

        echo "</br>";

        //* usuario ID  *//    
        
        echo form_input($input_usuario);

        echo "</br>";

        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/telefone') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
        
    echo form_close();
?>
