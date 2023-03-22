<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $input_nome = array('name' => 'nome', 'class' => 'form-control', 'maxlength' => 100);
    $input_logradouro = array('name' => 'logradouro', 'class' => 'form-control', 'maxlength' => 100);
    $input_numero = array('name' => 'numero', 'class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_estado = array('class' => 'form-control', 'id' => 'estadoId' );
    $form_dropdown_cidade = array('class' => 'form-control', 'id' => 'cidadeId');
    $form_dropdown_bairro = array('class' => 'form-control', 'id' => 'bairroId');


    echo "<h1>{$titulo}</h1>";

    echo form_open('endereco/criar', $form_open);

    echo form_label('Nome do Endereço (Exemplo: Home, Casa de Praia, Casa do Pai, Férias)');
    echo form_input($input_nome);

    echo "</br>";

    echo form_label('Logradouro (Rua x, Av Y, Travessa Z)');
    echo form_input($input_logradouro);

    echo "</br>";

    echo form_label('Número (Incluir complemento, se houver)');
    echo form_input($input_numero);

    echo "</br>";

    echo form_label('Estado');

    echo "</br>";

    echo form_dropdown("estadoId", $select_estado, $selected_estado, $form_dropdown_estado);

    echo "</br>";

    echo form_label('Cidade');

    echo "</br>";

    echo form_dropdown("cidadeId", $select_cidade, $selected_cidade, $form_dropdown_cidade);

    echo "</br>";

    echo form_label('Bairro');

    echo "</br>";

    echo form_dropdown("bairroId", $select_bairro, $selected_bairro, $form_dropdown_bairro);

    echo "</br>";

    echo form_submit('enviar', 'Enviar', $form_submit_btn);
    echo "<a href=" . base_url('index.php/bairro') .
        " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript"> 

 
    
    $(function(){
        $('#estadoId').change(function(){

            $('#cidadeId').attr('disabled','disabled');
            $('#cidadeId').html('<option>Carregando...</option>');
            
            $('#bairroId').html('<option>Selecione uma cidade...</option>');
            $('#bairroId').attr('disabled','disabled');

            var estadoId = $('#estadoId').val();
            
            $.post(
                "<?php echo base_url('index.php/bairro/optionsCidade') ?>",
                {estadoId:estadoId},
                function(data){
                    $('#cidadeId').html(data);
                    $('#cidadeId').removeAttr('disabled');
                }
            );
        });    
        
        $('#cidadeId').change(function(){

            $('#bairroId').attr('disabled','disabled');
            $('#bairroId').html('<option>Carregando...</option>');

            var cidadeId = $('#cidadeId').val();
            
            $.post(
                "<?php echo base_url('index.php/bairro/optionsBairro') ?>",
                {cidadeId:cidadeId},
                function(data){
                    $('#bairroId').html(data);
                    $('#bairroId').removeAttr('disabled');
                }
            );
        }); 
        
    });
</script>
