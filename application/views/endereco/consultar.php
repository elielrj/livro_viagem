<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 

<!-- título -->    
<h1><?php echo $titulo ?></h1>

    </br>
    </br>

    <!-- tabela -->
    <table class="table table-responsive-md table-hover">
        <?php echo $tabela; ?>
    </table>

    <!-- botão na horizontal --> 
    <?php echo "<div class='row'>{$botoes}</div>"; ?>