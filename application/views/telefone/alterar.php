<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_numero = array('name' => 'numero', 'value' => $tabela[0]['numero']);
    $input_parentesco_contato = array('name' => 'parentescoDoContato', 'value' => $tabela[0]['parentescoDoContato']);
    $input_usuario = array('name' => 'usuarioId','type' => 'hidden', 'value' => $tabela[0]['usuarioId']);
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


    $contato_emergencia = false;
    $contato_localizacao = false;

    if($tabela[0]['contato'] == 'EMERGENCIA'){
        $contato_emergencia = true;
    }else{
        $contato_localizacao = true;
    }

    echo "<h1>{$titulo}</h1>";
    
    echo form_open('telefone/atualizar', $form_open);

        //* id  *//

        echo form_input($input_id);

        //* número  *//
        
        echo form_label('Território da Viagem:');

            echo "</br>";
        
        echo form_input($input_numero);

            echo "</br>";

        //* contato  *//
        
        echo form_label('Contato:');
             echo "</br>";
        echo form_radio('contato', 'EMERGENCIA', $contato_emergencia) . form_label('Emergência');
            echo "</br>";
        echo form_radio('contato', 'LOCALIZACAO', $contato_localizacao) . form_label('Localização');

            echo "</br>";

        //* contato do parentesco  *//

        echo form_label('Parentesco do Contato');
             echo "</br>";
        echo form_input($input_parentesco_contato);

        echo "</br>";

        //* usuario ID  *//    
        
        echo form_input($input_usuario);

        echo "</br>";

        echo form_submit('enviar', 'Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/telefone') .
            " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
        
    echo form_close();
?>