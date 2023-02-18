<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('hierarquiacontroller/incluirNovoHierarquia'); ?>


<label>Posto ou Graduação</label>

<input type='text' name='postoOuGraduacao' size='30'>


<label>Sigla</label>

<input type='text' name='sigla' size='30'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>