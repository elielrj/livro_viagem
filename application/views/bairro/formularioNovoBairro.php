<h1>
    <?php
        echo $titulo;
    ?>
</h1>

<?php echo form_open('bairrocontroller/incluirNovoBairro'); ?>


<label>Nome do Bairro</label>

<input type='text' name='nome' size='30'>


<br />
<br />

<label>Nome da Cidade</label>


<select name="cidadeId" id="cidadeId">
       
    <?php echo $optionsCidades; ?>
    
</select>

<br />
<br />

<label>Nome do Estado</label>


<select name="estadoId" id="estadoId">       
    <?php echo  $optionsEstados; ?>  
</select>

<br />
<br />

<input type='submit' value='Enviar'>

</form> 

<script>


    let selectEstado = document.getElementById('estadoId');
    let selectCidade = document.getElementById('cidadeId');

    selectEstado.onchange = () => {
        let selectCidade = document.getElementById('cidadeId');
        
        let cidadesDeUmEstado = new CIdade();
        
        selectCidade.innerHTML = cidadesDeUmEstado.buscarTodasAsCidadesDeUmEstado($estado = "Rio de Janeiro");
    }

</script>