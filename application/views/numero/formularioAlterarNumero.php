<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('numerocontroller/atualizarNumero'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Nome do Numero</label>

<input type='text' name='valor' value="<?php echo $tabela[0]->valor ?>" />



<br />
<br />

<input type='submit' value='Salvar' />

</form>