<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_aprovada = array('name' => 'aprovada','type' => 'hidden');
    $input_usuario = array('name' => 'usuarioId','type' => 'hidden', 'value' => $usuario[0]['id']);
    $form_dropdown_endereco = array('class' => 'form-control');
    $input_date_ida = array('name' => 'dataIda', 'class' => 'daterange', 'type' => 'date');
    $input_date_volta = array('name' => 'dataVolta', 'class' => '', 'type' => 'date');
    $input_observacao = array('name' => 'observacao', 'class' => 'form-control', 'maxlength' => 150);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


    echo "<h1>{$titulo}</h1>";
    
    echo form_open('viagem/criar', $form_open);

        //* aprovada  *//

        echo form_input($input_aprovada);

            echo "</br>";


        echo "<div class='form-row'><div class='col'>";
            //* território  *//

            echo form_label('Território da Viagem:');
                echo "</br>";
            echo form_radio('territorio', Viagem_Model::$NACIONAL, true) . form_label(Viagem_Model::$NACIONAL_PT);
                echo "</br>";
            echo form_radio('territorio', Viagem_Model::$INTERNACIONAL) . form_label(Viagem_Model::$INTERNACIONAL_PT);

                echo "</br></br>";

        echo "</div><div class='col'>";
            //* motivo  *//

            echo form_label('Motivo da Viagem:');
                echo "</br>";
            echo form_radio('motivo', Viagem_Model::$PARTICULAR, true) . form_label(Viagem_Model::$PARTICULAR_PT);
                echo "</br>";
            echo form_radio('motivo', Viagem_Model::$SERVICO) . form_label(Viagem_Model::$SERVICO_PT);
                echo "</br>";
            echo form_radio('motivo', Viagem_Model::$FERIAS) . form_label(Viagem_Model::$FERIAS_PT);

        echo "</div></div>";

            echo "</br>";

        //* usuário  *//
        echo form_input($input_usuario);

            echo "</br>";

        //* endereço  *//

        echo form_label('Endereços do usuário (Selecione um endereço cadastrado)');
             echo "</br>";
        echo form_dropdown('enderecoId', $select_endereco, '', $form_dropdown_endereco);

            echo "</br>";
        
        //* data de ida  *//
        echo "<div class='form-row'><div class='col'>";
            echo form_label('Data de Ida') . " " . form_input($input_date_ida);

        echo "</div><div class='col'>";

            //* data de volta  *//
            echo form_label('Data de Retorno') . " " . form_input($input_date_volta);

        echo "</div></div>";

            echo "</br></br>";

        //* observacao  *//
        echo form_label('Observação (Descreva sucintamente)');
        echo form_input($input_observacao);

            echo "</br>";
          
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/viagem') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
        
    echo form_close();
?>
