<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $input_status = array('name' => 'status', 'class' => 'form-control', 'value' => false, 'type' => 'hidden');
    $input_nome = array('name' => 'nome', 'class' => 'form-control', 'maxlength' => 100);
    $input_senha = array('name' => 'senha', 'class' => 'form-control', 'maxlength' => 100);
    $input_email = array('name' => 'email', 'class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_hierarquia = array('class' => 'form-control', 'id' => 'hierarquiaId' );
    $form_dropdown_funcao = array('class' => 'form-control', 'id' => 'funcaoId' );


    echo "<h1>{$titulo}</h1>";

    echo form_open('usuario/criar', $form_open);

        echo form_input($input_status);

            echo "</br>";

        echo form_label('Nome');
        echo form_input($input_nome);

            echo "</br>";
        
        
        echo form_label('Hierarquia');
        echo form_dropdown("hierarquiaId", $select_hierarquia, '' , $form_dropdown_hierarquia);

            echo "</br>";
        
        
        echo form_label('Email');
        echo form_input($input_email);

            echo "</br>";
        
        echo form_label('Senha');
        echo form_input($input_senha);

            echo "</br>";

        echo form_label('Função');
        echo form_dropdown("funcaoId", $select_funcao, '' , $form_dropdown_funcao);

            echo "</br>";

        echo form_submit('enviar', 'Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/usuario') .
            " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

    echo form_close();
      
?>