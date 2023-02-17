<h1>
    <?php
    echo $titulo;
    ?>
</h1>

<?php echo form_open('estadocontroller/incluirNovoEstado'); ?>


<label>Nome</label>

<input type='text' name='nome' size='30'>


<label>Sigla</label>

<input type='text' name='sigla'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>