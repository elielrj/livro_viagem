<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('numerocontroller/incluirNovoNumero'); ?>


<label>Valor</label>

<input type='text' name='valor' size='30'>



<br />
<br />

<input type='submit' value='Enviar'>

</form>