<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('logradourocontroller/incluirNovoLogradouro'); ?>


<label>Nome do Logradouro</label>

<input type='text' name='nome' size='30'>


<label>Nome do Bairro</label>

<input type='text' name='bairroId'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>