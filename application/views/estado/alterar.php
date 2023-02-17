<?php
echo form_open('estado/salvaralteracao');
?>

<input type='hidden' name='idestado' value="<?php echo $tabela[0]->idestado ?>"/>

<label>Nome</label>

<input type='text' name='nome' value="<?php echo $tabela[0]->nome ?>" />


<label>Sigla</label>

<input type='text' name='sigla' value="<?php echo $tabela[0]->sigla ?>"/>

<br />
<br />

<input type='submit' value='Salvar'/>

</form>