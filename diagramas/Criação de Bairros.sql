create table bairro
(
id int primary key auto_increment not null,
nome varchar(30) not null,
cidadeId int not null,
status boolean not null,
foreign key (cidadeId) references cidade(id)
);


INSERT INTO bairro (id, nome, cidadeId) values
(1,'São Bernardo',4429),
(2,'São João',4429),
(3,'Humaitá de Cima',4429),
(4,'Humaitá Centro',4429),
(5,'Vila Esperança',4429),
(6,'Morrotes',4429),
(7,'Dehon',4429),
(8,'Revoredo',4429),
(9,'Cruzeiro',4429),
(10,'Fábio Silva',4429),
(11,'Monte Castelo',4429),
(12,'Oficinas',4429),
(13,'Centro',4429),
(14,'Santo Antônio de Pádua',4429),
(15,'Vila Moema',4429),
(16,'Recife',4429),
(17,'Passagem',4429),
(18,'Passo do gado',4429),
(19,'Santa Luzia',4429),
(20,'Praia Redonda',4429),
(21,'São Clemente',4429),
(22,'Campestre',4429),
(23,'São Cristóvão',4429);

select id,nome from cidade order by nome;
select id, nome from bairro where cidadeId = 4429;
select * from bairro;
drop table bairro;