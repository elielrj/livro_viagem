
-- DATE_FORMAT( evn_dtevento, "%d/%m/%Y" )

-- AAAA-MM-DD HH:MM:SS 
use livro_viagem;




INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (DEFAULT,'Ler','Ler',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (DEFAULT,'Escrever','Escrever',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (DEFAULT,'Despachar','Despachar',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (DEFAULT,'Administrar','Administrar',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (DEFAULT,'Root','Root',true);

INSERT INTO `usuario`(
`id`, `nome`, `status`, `dataDeCriacao`, `ultimoAcesso`, `hierarquiaId`, `email`, `senha`, funcaoId
) 
VALUES 
(DEFAULT,'Eliel',true,now(),now(),'15','ler@gmail.com',md5(9524), 2),
(DEFAULT,'Eliel',true,now(),now(),'15','esc@gmail.com',md5(9524), 3),
(DEFAULT,'Eliel',true,now(),now(),'15','adm@gmail.com',md5(9524), 5),
(DEFAULT,'Eliel',true,now(),now(),'15','roo@gmail.com',md5(9524), 1),
(DEFAULT,'Eliel',true,now(),now(),'15','des@gmail.com',md5(9524), 4);