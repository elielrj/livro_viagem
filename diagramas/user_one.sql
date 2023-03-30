
-- DATE_FORMAT( evn_dtevento, "%d/%m/%Y" )

-- AAAA-MM-DD HH:MM:SS 
use livro_viagem;



insert INTO `Funcao` (
`id`,`nome`,`nivelDeAcesso`,`status`
)
VALUES ('1','Root', 1 ,true);

INSERT INTO `Usuario`(
`id`, `nome`, `status`, `dataDeCriacao`, `ultimoAcesso`, `hierarquiaId`, `email`, `senha`, funcaoId
) 
VALUES ('1','Eliel',true,now(),now(),'15','elielrj@gmail.com',md5(9524), 1);