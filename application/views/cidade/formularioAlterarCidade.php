<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('cidadecontroller/atualizarCidade'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Nome da Cidade</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />

<label>Nome do Estado</label>

<input type='text' name='estadoId' value="<?php echo $tabela[0]->estadoId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>