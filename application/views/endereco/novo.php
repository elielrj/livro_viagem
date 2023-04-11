<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $input_nome = array('name' => 'nome', 'class' => 'form-control', 'maxlength' => 100);
    $input_bairro = array('name' => 'bairro', 'class' => 'form-control', 'maxlength' => 100);
    $input_logradouro = array('name' => 'logradouro', 'class' => 'form-control', 'maxlength' => 100);
    $input_numero = array('name' => 'numero', 'class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_estado = array('class' => 'form-control', 'id' => 'estadoId' );
    $form_dropdown_cidade = array('class' => 'form-control', 'id' => 'cidadeId');


    echo "<h1>{$titulo}</h1>";

    echo form_open($metodo, $form_open);

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
    echo form_input($input_bairro);


    echo "</br>";

    echo form_submit('enviar', 'Enviar', $form_submit_btn);
    echo "<a href=" . base_url('index.php/endereco') .
        " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript"> 

 
    
    $(function(){
        $('#estadoId').change(function(){

            $('#cidadeId').attr('disabled','disabled');
            $('#cidadeId').html('<option>Carregando...</option>');

            var estadoId = $('#estadoId').val();
            
            $.post(
                "<?php echo base_url('index.php/cidade/optionsCidade') ?>",
                {estadoId:estadoId},
                function(data){
                    $('#cidadeId').html(data);
                    $('#cidadeId').removeAttr('disabled');
                }
            );
        });    
        
        
    });
</script>
