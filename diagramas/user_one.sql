
-- DATE_FORMAT( evn_dtevento, "%d/%m/%Y" )

-- AAAA-MM-DD HH:MM:SS 
use livro_viagem;

INSERT INTO `usuario`(
`id`, `nome`, `status`, `dataDeCriacao`, `ultimoAcesso`, `hierarquiaId`, `email`, `senha`
) 
VALUES ('1','Eliel',true,now(),now(),'15','elielrj@gmail.com',md5(9524));