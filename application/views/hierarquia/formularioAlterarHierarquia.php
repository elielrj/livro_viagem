<h1>
    <?php
        echo $titulo;
    ?>
</h1>
   
    <?php echo form_open('hierarquiacontroller/atualizarHierarquia'); ?>

<input type='hidden' name='id' value="<?php echo $tabela[0]->id ?>" />

<label>Posto ou Graduação</label>

<input type='text' name='postoOuGraduacao' value="<?php echo $tabela[0]->postoOuGraduacao ?>" />



<label>Sigla</label>

<input type='text' name='sigla' value="<?php echo $tabela[0]->sigla ?>" />



<br />
<br />

<input type='submit' value='Salvar' />

</form>