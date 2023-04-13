
-- DATE_FORMAT( evn_dtevento, "%d/%m/%Y" )

-- AAAA-MM-DD HH:MM:SS 
use livro_viagem;




INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (1,'Ler','Ler',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (2,'Escrever','Escrever',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (3,'Despachar','Despachar',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (4,'Administrar','Administrar',true);
INSERT INTO `funcao`(`id`, `nome`, `nivelDeAcesso`, `status`) VALUES (5,'Root','Root',true);

INSERT INTO `usuario`(
`id`, `nome`, `status`, `dataDeCriacao`, `ultimoAcesso`, `hierarquiaId`, `email`, `senha`, funcaoId
) 
VALUES 
(DEFAULT,'Leitor',true,now(),now(),'15','leitor@leitor',md5(123), 1),
(DEFAULT,'Escritor',true,now(),now(),'15','escrito@escritor',md5(123), 2),
(DEFAULT,'Despachante',true,now(),now(),'15','despachante@despachante',md5(123), 3),
(DEFAULT,'Administrador',true,now(),now(),'15','admin@admin',md5(123), 4),
(DEFAULT,'Super Usuário',true,now(),now(),'15','root@root',md5(123), 5);