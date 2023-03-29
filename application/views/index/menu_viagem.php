 <?php if(!NivelDeAcesso::isReader()): ?>

    <li class="nav-item">

        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseInformarViagem"
            aria-expanded="true" 
            aria-controls="collapseInformarViagem">

            <i class="fas fa-fw fa-wrench"></i>
            
            <span>Viagem</span>
        </a>
        <div 
            id="collapseInformarViagem" 
            class="collapse" 
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">índices:</h6>

                <a class="collapse-item" href="<?php echo base_url('index.php/viagem/novo');?>">
                    Informar</a>

                <a class="collapse-item" href="<?php echo base_url('index.php/viagem/listarPorUsuarioId');?>">
                    Consultar</a>      
            
            </div>

        </div>
    </li>
    
<?php endif; ?>