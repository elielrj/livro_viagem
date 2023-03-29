<?php if(NivelDeAcesso::isAdmin() || NivelDeAcesso::isRoot()): ?>
                
    <li class="nav-item">
    
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseTwo"
            aria-expanded="true" 
            aria-controls="collapseTwo">
            
            <i class="fas fa-fw fa-cog"></i>

            <span>Banco de Dados</span>

        </a>
        
        <div 
            id="collapseTwo" 
            class="collapse" 
            aria-labelledby="headingTwo" 
            data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">

                <h6 class="collapse-header">Tabela:</h6>
                                        
                <a class="collapse-item" href="<?php echo base_url('index.php/estado');?>">Estado</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/cidade');?>">Cidade</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/endereco');?>">Endereços</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/viagem/listar');?>">Viagem</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/usuario');?>">Usuário</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/telefone');?>">Telefone</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/hierarquia');?>">Hierarquia</a>
                <a class="collapse-item" href="<?php echo base_url('index.php/funcao');?>">Função</a>

            </div>
        </div>
    </li>

<?php endif; ?>