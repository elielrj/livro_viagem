<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['nome']);
    $form_dropdown_nivelDeAcesso = array('class' => 'form-control', 'id' => 'nivelDeAcesso' );

    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    $ativo = false;
    $inativo = false;

    if($tabela[0]['status']){
        $ativo = true;
    }else{
        $inativo = true;
    }
    
    echo "<h1>{$titulo}</h1>";
   
    echo form_open('funcao/atualizar', $form_open);

        echo form_input($input_id);

        echo form_label( 'Descrição');        
        echo form_input($input_nome);

            echo "</br>";

        echo form_label('Status da Função:');
             echo "</br>";
        echo form_radio('status', true, $ativo) . form_label('Ativo');
            echo "</br>";
        echo form_radio('status', false,  $inativo) . form_label('Inativo');

            echo "</br>";

        echo form_label('Nível de Acesso');
        echo form_dropdown("nivelDeAcesso", $select_nivelDeAcesso, $selected_nivelDeAcesso , $form_dropdown_nivelDeAcesso);

            echo "</br>";

        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/funcao') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close(); 
?>
   