<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('telefonecontroller/incluirNovoTelefone'); ?>


<label>Número</label>

<input type='text' name='numero' size='30'>



<label>Parentesco Do Contato</label>

<input type='text' name='parentescoDoContato' size='30'>



<label>Contato de Emergência ou Localização</label>

<input type='readonly' name='contato' size='30'>




<label>Usuário do Telefone</label>

<input type='text' name='usuarioId' size='30'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>