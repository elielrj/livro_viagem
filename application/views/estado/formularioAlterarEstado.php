<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('estadocontroller/atualizarEstado'); ?>

<input type='hidden' name='id' value="<?php echo $tabela->id ?>" />

<label>Nome do Estado</label>

<input type='text' name='nome' value="<?php echo $tabela->nome ?>" />


<label>Sigla do Estado</label>

<input type='text' name='sigla' value="<?php echo $tabela->sigla ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>