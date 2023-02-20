<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('viagemcontroller/atualizarViagem'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Aprovação da Viagem</label>

<input type='text' name='aprovada' value="<?php echo $tabela[0]->aprovada ?>" />


<label>Território da Viagem</label>

<input type='text' name='territorio' value="<?php echo $tabela[0]->territorio ?>" />



<label>Motivo da Viagem</label>

<input type='text' name='motivo' value="<?php echo $tabela[0]->motivo ?>" />


<label>Usuário da Viagem</label>

<input type='text' name='usuarioId' value="<?php echo $tabela[0]->usuarioId ?>" />


<label>Endereço da Viagem</label>

<input type='text' name='enderecoId' value="<?php echo $tabela[0]->enderecoId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>