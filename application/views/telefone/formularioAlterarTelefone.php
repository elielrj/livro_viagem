<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('telefonecontroller/atualizarTelefone'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Nome do Numero</label>

<input type='text' name='numero' value="<?php echo $tabela[0]->numero ?>" />



<label>Parentesco do Telefone</label>

<input type='text' name='parentescoDoContato' value="<?php echo $tabela[0]->parentescoDoContato ?>" />


<label>Contato de Emergência</label>

<input type='text' name='contatoDeEmergencia' value="<?php echo $tabela[0]->contatoDeEmergencia ?>" />


<label>Contato de Localização</label>

<input type='text' name='contatoDeLocalizacao' value="<?php echo $tabela[0]->contatoDeLocalizacao ?>" />



<label>Usuário do Telefone</label>

<input type='text' name='usuarioId' value="<?php echo $tabela[0]->usuarioId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>