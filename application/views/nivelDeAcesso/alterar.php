<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $form_dropdown_poder = array('class' => 'form-control');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    $ativo = false;
    $inativo = false;

    if($tabela[0]['status']){
        $ativo = true;
    }else{
        $inativo = true;
    }

    echo "<h1>{$titulo}</h1>";
   
    echo form_open('nivelDeAcesso/atualizar', $form_open);

        echo form_input($input_id);

        echo form_label('Poder');
        echo form_dropdown("poder", $select_nivelDeAcesso, $tabela[0]['poder'] , $form_dropdown_poder);

            echo "</br>";

        echo form_label('Status do Nível de Acesso:');
             echo "</br>";
        echo form_radio('status', true, $ativo) . form_label('Ativo');
            echo "</br>";
        echo form_radio('status', false, $inativo) . form_label('Inativo');

            echo "</br>";

        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/nivelDeAcesso') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close(); 
?>
   