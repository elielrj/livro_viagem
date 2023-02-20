<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('viagemcontroller/incluirNovoViagem'); ?>



<label>Território</label>

<input type='text' name='territorio' size='30'>



<label>Motivo da Viagem</label>

<input type='text' name='motivo' size='30'>


<label>Usuário</label>

<input type='text' name='usuarioId' size='30'>

<label>Endereço</label>

<input type='text' name='enderecoId' size='30'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>