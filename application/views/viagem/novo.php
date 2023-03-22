<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_aprovada = array('name' => 'aprovada','type' => 'hidden', 'value' => false);
    $input_usuario = array('name' => 'usuarioId','type' => 'hidden', 'value' => $usuario[0]['id']);
    $form_dropdown_endereco = array('class' => 'form-control', 'id' => 'bairroId');
    $input_date_ida = array('name' => 'dataIda', 'class' => 'panel panel-default', 'type' => 'date');
    $input_date_volta = array('name' => 'dataVolta', 'class' => '', 'type' => 'date');
    $form_textarea = array('class' => 'form-control');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


    echo "<h1>{$titulo}</h1>";
    
    echo form_open('viagem/criar', $form_open);

        //* aprovada  *//

        echo form_input($input_aprovada);

            echo "</br>";

        //* território  *//

        echo form_label('Território da Viagem:');
             echo "</br>";
        echo form_radio('territorio', 'NACIONAL', true) . form_label('Nacional');
            echo "</br>";
        echo form_radio('territorio', 'INTERNACIONAL') . form_label('Internacional');

            echo "</br></br>";

        //* motivo  *//

        echo form_label('Motivo da Viagem:');
             echo "</br>";
        echo form_radio('motivo', 'PARTICULAR', true) . form_label('Particular');
            echo "</br>";
        echo form_radio('motivo', 'SERVICO') . form_label('Serviço');

            echo "</br>";

        //* usuário  *//
        echo form_input($input_usuario);

            echo "</br>";

        //* endereço  *//

        echo form_label('Endereços do usuário');
             echo "</br>";
        echo form_dropdown('enderecoId', $select_endereco, '', $form_dropdown_endereco);

            echo "</br>";
        //* data de ida  *//
        echo form_label('Data de Ida');
            echo "</br>";
        echo form_input($input_date_ida);

            echo "</br></br>";

        //* data de volta  *//

        echo form_label('Data de Retorno');
            echo "</br>";
        echo form_input($input_date_volta);

            echo "</br></br>";

        //* observacao  *//
        echo form_textarea('observacao', '' , $form_textarea);

            echo "</br>";
          
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/viagem') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
        
    echo form_close();
?>
