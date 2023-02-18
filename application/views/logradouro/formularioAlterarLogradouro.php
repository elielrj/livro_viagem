<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('logradourocontroller/atualizarLogradouro'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Nome do Logradouro</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />

<label>Nome da Bairro</label>

<input type='text' name='bairroId' value="<?php echo $tabela[0]->bairroId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>