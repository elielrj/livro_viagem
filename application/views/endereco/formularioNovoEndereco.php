<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('enderecocontroller/incluirNovoEndereco'); ?>


<label>Nome do Endereco</label>

<input type='text' name='nome' size='30'>


<label>Logradouro do Endereço</label>

<input type='text' name='logradouroId'>


<label>Número do Endereço</label>

<input type='text' name='numeroId'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>