<h1>
    Criar conta
</h1>


<!-- abertura de formulário para criar conta de usuário -->
<?php echo form_open('logincontroller/criarUsuario'); ?>

<!-- nome  -->
<label>Nome da Usuario</label>

<input type='text' name='nome' size='30'>


<!-- status será atribuido pelo controller -->
<!-- dataDeCriacao será atribuido pelo controller -->
<!-- ultimoAcesso será atribuido pelo controller -->

<!-- hierarquia -->
<label>Hierarquia</label>

<input type='text' name='hierarquiaId'>

<!-- email -->
<label>Email</label>

<input type='text' name='email'>


<!-- senha -->
<label>Senha</label>

<input type='text' name='senha'>

<br />
<br />

<input type='submit' value='Enviar'>

</form>