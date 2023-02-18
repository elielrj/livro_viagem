<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('cidadecontroller/incluirNovoCidade'); ?>


<label>Nome da Cidade</label>

<input type='text' name='nome' size='30'>


<label>Nome do Estado</label>

<input type='text' name='estadoId'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>