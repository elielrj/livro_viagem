<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_status = array('name' => 'status', 'class' => 'form-control', 'value' => false, 'type' => 'hidden');
    $input_nome = array('name' => 'nome', 'class' => 'form-control', 'maxlength' => 100,'value' => $tabela[0]['nome']);
    $input_dataDeCriacao = array('name' => 'dataDeCriacao', 'class' => 'form-control',  'type' => 'hidden', 'value' => $tabela[0]['dataDeCriacao']);        
    $input_email = array('name' => 'email', 'class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['email']);        
    $input_senha = array('name' => 'senha', 'class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['senha']);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_hierarquia = array('class' => 'form-control', 'id' => 'hierarquiaId');


    echo "<h1>{$titulo}</h1>";

    echo form_open('usuario/atualizar', $form_open);

        echo form_input($input_id);

        echo form_input($input_status);

            echo "</br>";

        echo form_label('Nome');

            echo "</br>";

        echo form_input($input_nome);

            echo "</br>";

        echo form_input($input_dataDeCriacao);

        
        
        echo form_label('Hierarquia');

            echo "</br>";

        echo form_dropdown('hierarquiaId', $select_hierarquia, $selected_hierarquia, $form_dropdown_hierarquia);

            echo "</br>";
        
        
        echo form_label('Email');

            echo "</br>";

        echo form_input($input_email);

            echo "</br>";
        
        echo form_label('Senha');

            echo "</br>";

        echo form_input($input_senha);

            echo "</br>";

        echo form_submit('enviar', 'Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/usuario') .
            " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

    echo form_close();
      
?>