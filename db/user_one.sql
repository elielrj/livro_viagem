
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
(1,'Leitor',true,now(),now(),'15','leitor@leitor',md5(123), 1),
(2,'Escritor',true,now(),now(),'15','escrito@escritor',md5(123), 2),
(3,'Despachante',true,now(),now(),'15','despachante@despachante',md5(123), 3),
(4,'Administrador',true,now(),now(),'15','admin@admin',md5(123), 4),
(5,'Super Usuário',true,now(),now(),'15','root@root',md5(123), 5);


INSERT INTO `endereco`(`id`, `nome`, `logradouro`, `numero`, `bairro`, `usuarioId`, `cidadeId`, `status`) 
VALUES 
(1,'Home','Rua João Mendes','234','Centro','1','4429',true),
(2,'Casa da Praia','Rua Canadá Mendes','333','Canidé','1','4429',true),
(3,'Casa da Praia','Rua Canadá Mendes','23','Alves','1','4429',true),
(4,'Quartel','Rua Lauro Muller','2327','Passagem','1','4429',true),
(5,'Apt','Rua Cel Cabral','458','Centro','1','4429',true),
(6,'Home','Rua João Mendes','234','Centro','2','4429',true),
(7,'Casa da Praia','Rua Canadá Mendes','333','Canidé','2','4429',true),
(8,'Casa da Praia','Rua Canadá Mendes','23','Alves','3','4429',true),
(9,'Quartel','Rua Lauro Muller','2327','Passagem','4','4429',true),
(10,'Apt','Rua Cel Cabral','458','Centro','5','4429',true);


INSERT INTO `telefone`(`id`, `numero`, `contato`, `parentescoDoContato`, `usuarioId`, `status`)
VALUES 
 ('1','63573890','Emergência','Pai','1',true),
 ('2','12312312','Localização','Pai','1',true),
 ('3','43454543','Emergência','Pai','1',true),
 ('4','97593458','Emergência','Pai','1',true),
 ('5','64458358','Localização','Pai','1',true),
  ('6','63573890','Emergência','Pai','2',true),
 ('7','12312312','Localização','Pai','3',true),
 ('8','43454543','Emergência','Pai','4',true),
 ('9','97593458','Emergência','Pai','5',true),
 ('10','64458358','Localização','Pai','4',true);