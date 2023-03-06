<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('cidadecontroller/incluirNovoCidade'); ?>


<label>Nome da Cidade</label>

<input type='text' name='nome' size='30'>

<br />
<br />


<label>Nome do Estado</label>

<select name="estadoId">
       
    <?php


        foreach($estados as $estado){

            if($estado->id == "1"){
                echo "<option value=" . $estado->id . " selected>" . $estado->nome . " - " . $estado->sigla . "</option>";
            }else{
                echo "<option value=" . $estado->id . ">" . $estado->nome . " - " . $estado->sigla . "</option>";
            }
            
       
        }
    ?>
    
</select>

<br />
<br />

<input type='submit' value='Enviar'>

</form>