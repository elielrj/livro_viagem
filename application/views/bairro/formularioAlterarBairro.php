<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('bairrocontroller/atualizarBairro'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Nome do Bairro</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />

<label>Nome da Cidade</label>

<input type='text' name='cidadeId' value="<?php echo $tabela[0]->cidadeId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>