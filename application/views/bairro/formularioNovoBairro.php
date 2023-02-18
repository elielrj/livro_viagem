<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('bairrocontroller/incluirNovoBairro'); ?>


<label>Nome do Bairro</label>

<input type='text' name='nome' size='30'>


<label>Nome da Cidade</label>

<input type='text' name='cidadeId'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>