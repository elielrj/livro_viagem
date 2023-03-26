<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_aprovada = array('name' => 'aprovada','type' => 'hidden', 'value' => $tabela[0]['aprovada']);
    $input_usuario = array('name' => 'usuarioId','type' => 'hidden', 'value' => $usuario[0]['id']);
    $form_dropdown_endereco = array('class' => 'form-control');
    $input_date_ida = array('name' => 'dataIda', 'class' => '', 'type' => 'date','value' => $tabela[0]['dataIda']);
    $input_date_volta = array('name' => 'dataVolta', 'class' => '', 'type' => 'date','value' => $tabela[0]['dataVolta']);
    $input_observacao = array('name' => 'observacao', 'class' => 'form-control', 'maxlength' => 150,'value' => $tabela[0]['observacao']);

    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    $status_territorio_nacional = false;
    $status_territorio_internacional = false;

    if($tabela[0]['territorio'] == 'NACIONAL'){
        $status_territorio_nacional = true;
    }else{
        $status_territorio_internacional = true;
    }

    $motivo_particular = false;
    $motivo_servico = false;

    if($tabela[0]['motivo'] == 'PARTICULAR'){
        $motivo_particular = true;
    }else{
        $motivo_servico = true;
    }

    echo "<h1>{$titulo}</h1>";
    
    echo form_open('viagem/atualizar', $form_open);

        //* id  *//

        echo form_input($input_id);

        //* aprovada  *//

        echo form_input($input_aprovada);

            echo "</br>";

        echo "<div class='form-row'><div class='col'>";
            //* território  *//

            echo form_label('Território da Viagem:');
                echo "</br>";
            echo form_radio('territorio', 'NACIONAL', $status_territorio_nacional) . form_label('Nacional');
                echo "</br>";
            echo form_radio('territorio', 'INTERNACIONAL',$status_territorio_internacional) . form_label('Internacional');

                echo "</br>";

        echo "</div><div class='col'>";
            //* motivo  *//

            echo form_label('Motivo da Viagem:');
                echo "</br>";
            echo form_radio('motivo', 'PARTICULAR', $motivo_particular) . form_label('Particular');
                echo "</br>";
            echo form_radio('motivo', 'SERVICO', $motivo_servico) . form_label('Serviço');

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
