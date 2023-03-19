<?php defined('BASEPATH') or exit('No direct script access allowed'); 

    $input_nome = array('name' => 'nome', 'class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_estado = array('class' => 'form-control', 'id' => 'estadoId' );
    $form_dropdown_cidade = array('class' => 'form-control', 'id' => 'cidadeId');


    echo "<h1>{$titulo}</h1>";

    echo form_open('bairro/criar', $form_open);

    echo form_label('Estado');

    echo "</br>";

    echo form_dropdown("estadoId", $select_estado, $selected_estado, $form_dropdown_estado);

    echo "</br>";

    echo form_label('Cidade');

    echo "</br>";

    echo form_dropdown("cidadeId", $select_cidade, $selected_cidade, $form_dropdown_cidade);

    echo "</br>";

    echo form_label('Bairro');
    echo form_input($input_nome);

    echo "</br>";

    echo form_submit('enviar', 'Enviar', $form_submit_btn);
    echo "<a href=" . base_url('index.php/bairro') .
        " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();
      
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript"> 

    var base_url = "<?php echo base_url('index.php/bairro/optionsCidade') ?>";
    
    $(function(){
        $('#estadoId').change(function(){

            var estadoId = $('#estadoId').val();
            
            $.post(
                base_url,
                {estadoId:estadoId},
                function(data){
                    $('#cidadeId').html(data);
                }
            );
        });           
    });
</script>