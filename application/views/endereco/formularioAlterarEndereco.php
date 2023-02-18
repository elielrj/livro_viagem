<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('enderecocontroller/atualizarEndereco'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />


<label>Nome do Endereço</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />


<label>Nome do Logradouro</label>

<input type='text' name='logradouroId' value="<?php echo $tabela[0]->logradouroId ?>" />

<label>Número da Endereço</label>

<input type='text' name='numeroId' value="<?php echo $tabela[0]->numeroId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>