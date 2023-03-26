<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_nivelDeAcesso = array('class' => 'form-control', 'id' => 'nivelDeAcesso' );


    echo "<h1>{$titulo}</h1>";
    
    echo form_open('funcao/criar', $form_open);
    
        echo form_label( 'Descrição');        
        echo form_input($input_nome);

            echo "</br>";
        
        echo form_label('Status da Função:');
            echo "</br>";
        echo form_radio('status', true, true) . form_label('Ativo');
            echo "</br>";
        echo form_radio('status', false) . form_label('Inativo');

            echo "</br>";

        echo form_label('Nível de Acesso');
        echo form_dropdown("nivelDeAcesso", $select_nivelDeAcesso, '', $form_dropdown_nivelDeAcesso);

            echo "</br>";
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/funcao') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();    

?>
