<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('usuariocontroller/incluirNovoUsuario'); ?>


<label>Nome da Usuario</label>

<input type='text' name='nome' size='30'>


<label>Hierarquia</label>

<input type='text' name='hierarquiaId'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>