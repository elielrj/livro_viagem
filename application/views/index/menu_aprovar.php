 <?php if(NivelDeAcesso::isDispatcher() || NivelDeAcesso::isRoot()): ?>

    <li class="nav-item">
        
        <a 
            class="nav-link collapsed" 
            href="viagem/viagensAnalisada" 
            data-toggle="collapse" 
            data-target="#collapseAprovarViagem"
            aria-expanded="true" 
            aria-controls="collapseAprovarViagem"
             >

                <i class="fas fa-fw fa-wrench"></i>

                <span>Aprovar</span>

        </a>
            
        <div 
            id="collapseAprovarViagem" 
            class="collapse" 
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            
            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">índices:</h6>
                
                <a 
                    class="collapse-item" 
                    href="<?php echo base_url('index.php/viagem/viagensNaoAnalisada');?>">
                    Não Analisada</a>
                
                <a 
                    class="collapse-item"
                    href="<?php echo base_url('index.php/viagem/viagensAnalisada');?>">
                    Analisada</a>  

            </div>

        </div>

    </li>

<?php endif; ?>