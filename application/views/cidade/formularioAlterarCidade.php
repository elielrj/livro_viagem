<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('cidadecontroller/atualizarCidade'); ?>




<input type='hidden' name='id' value="<?php echo $tabela->id;?>" />


<label>Nome da Cidade</label>
<input type='text' name='nome' value="<?php echo $tabela->nome ?>" />


</br>

<input type='hidden' name='estadoId' value="<?php echo $tabela->estado->id ?>"/>

</br>
<label>Nome do Estado</label>
<select name="estadoId">
       
    <?php

        foreach($estados as $estado){

            if($estado->id == $tabela->estadoId){
                echo "<option value=" . $estado->id . " selected>" . $estado->nome . " - " . $estado->sigla . "</option>";
            }else{
                echo "<option value=" . $estado->id . ">" . $estado->nome . " - " . $estado->sigla . "</option>";
            }
            
       
        }
    ?>
    
</select>

<br />
<br />

<input type='submit' value='Salvar' />

</form>