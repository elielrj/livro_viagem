<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('usuariocontroller/atualizarUsuario'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />


<label>Nome da Usuario</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />


<label>Status do Usuário</label>

<input type='text' name='status' value="<?php echo $tabela[0]->status ?>" />


<label>Hierarquia</label>

<input type='text' name='hierarquiaId' value="<?php echo $tabela[0]->hierarquiaId ?>" />

<br />
<br />

<input type='submit' value='Salvar' />

</form>