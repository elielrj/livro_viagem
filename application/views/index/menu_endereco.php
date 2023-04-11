 <?php if(!NivelDeAcesso::isReader()): ?>

    <li class="nav-item">
        
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseEndereco"
            aria-expanded="true" 
            aria-controls="collapseEndereco">

            <i class="fas fa-fw fa-wrench"></i>

            <span>Endereco</span>

        </a>
            
        <div 
            id="collapseEndereco" 
            class="collapse" 
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">índices:</h6>
                
                <a class="collapse-item" href="<?php echo base_url('index.php/endereco/cadastrar');?>">
                    Cadastrar</a>
            
                <a class="collapse-item" href="<?php echo base_url('index.php/endereco/listarPorUsuarioId');?>">
                    Consultar</a>     

            </div>

        </div>

    </li>
    
<?php endif; ?>