    <?php defined('BASEPATH') OR exit('No direct script access allowed');

    $form_open = array('class' => 'form-group');
    $input_id = array('name' => 'id','type' => 'hidden', 'value' => $tabela[0]['id']);
    $input_nome = array('name' => 'nome','class' => 'form-control', 'maxlength' => 100, 'value' => $tabela[0]['nome']);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');

    echo "<h1>{$titulo}</h1>";
   
    echo form_open('cidade/atualizar', $form_open);

        echo form_input($input_id);

        echo form_label( 'Cidade', 'nome');        
        echo form_input($input_nome);

            echo "</br>";
        
       
        echo form_dropdown('estadoId',$select, array('id' => $tabela[0]['estadoId']));

            echo "</br>";

        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/cidade') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

    echo form_close(); 
?>