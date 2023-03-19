<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['nome']);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');
    $form_dropdown_estado = array('class' => 'form-control', 'id' => 'estadoId' );
    $form_dropdown_cidade = array('class' => 'form-control', 'id' => 'cidadeId');
    
    
    echo "<h1>{$titulo}</h1>";
    
    echo form_open('bairro/atualizar', $form_open);


    echo form_input($input_id);


    echo form_label('Estado'); 
            
        echo "</br>";

    echo form_dropdown('estadoId',$select_estado, $estado_selected, $form_dropdown_estado);

        echo "</br>";

    echo form_label('Cidade'); 
            
        echo "</br>";

    echo form_dropdown('cidadeId',$select_cidade, $cidade_selected, $form_dropdown_cidade);

        echo "</br>";

    echo form_label( 'Bairro');        
    echo form_input($input_nome);

        echo "</br>";

    echo form_submit('enviar','Enviar', $form_submit_btn);
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