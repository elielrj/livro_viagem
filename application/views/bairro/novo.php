<?php defined('BASEPATH') OR exit('No direct script access allowed');

    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100);
    $form_open = array('class' => 'form-group');
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


    echo "<h1>{$titulo}</h1>";

    echo form_open('bairro/criar', $form_open);

        echo form_label('Estado','estadoId'); 
            
            echo "</br>";

        echo form_dropdown("estadoId", $select_estado );

            echo "</br>";

        echo form_label('Cidade','estadoId'); 
            
            echo "</br>";

        echo form_dropdown("cidadeId", $select_cidade );

            echo "</br>";

        echo form_label( 'Bairro', 'nome');        
        echo form_input($input_nome);

            echo "</br>"; 
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/bairro') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";


    echo form_close();    

?>



<!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>vendor/jquery/jquery.min.js"></script>



<script type="text/javascript" >

    var base_url = "<?php echo base_url()?>" + 'index.php/BairroController/selectCidadesPorIdEstado';


    $(function(){
        $('#estadoId').change(function(){

            //$('#cidadeId').attr('disabled','disabled');
            //$('#cidadeId').html("<option>Carregando...</option>");

            var estadoId = $('#estadoId').val();


            alert(estadoId);            
            
            $('#cidadeId').removeAttr('disabled');
            $('#nome').removeAttr('disabled');


            $.post(base_url,{estadoId : estadoId}, function(data){
                    $('#cidadeId').html(data);
                }
            );
            
        });
    });




</script>
