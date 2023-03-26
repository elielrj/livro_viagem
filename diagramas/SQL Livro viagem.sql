
drop database livro_viagem;
drop database mydb;

-- MySQL Workbench Synchronization
-- Generated: 2023-03-25 15:06
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: esfso

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `livro_viagem`.`Cidade` 
DROP FOREIGN KEY `fk_Cidade_Estado`;

ALTER TABLE `livro_viagem`.`Endereco` 
DROP FOREIGN KEY `fk_Endereco_Cidade1`;

ALTER TABLE `livro_viagem`.`Usuario` 
DROP FOREIGN KEY `fk_Usuario_Funcao1`;

ALTER TABLE `livro_viagem`.`Telefone` 
DROP FOREIGN KEY `fk_Telefone_Usuario1`;

ALTER TABLE `livro_viagem`.`Viagem` 
DROP FOREIGN KEY `fk_Viagem_Endereco1`;

ALTER TABLE `livro_viagem`.`Funcao` 
DROP FOREIGN KEY `fk_Funcao_NivelDeAcesso1`;

ALTER TABLE `livro_viagem`.`Usuario` 
CHANGE COLUMN `email` `email` VARCHAR(100) NOT NULL AFTER `nome`,
CHANGE COLUMN `senha` `senha` VARCHAR(100) NOT NULL AFTER `email`,
CHANGE COLUMN `status` `status` TINYINT(4) NOT NULL AFTER `ultimoAcesso`;

ALTER TABLE `livro_viagem`.`Telefone` 
CHANGE COLUMN `contato` `contato` ENUM("Emergência", "Localização") NOT NULL ;

ALTER TABLE `livro_viagem`.`Viagem` 
CHANGE COLUMN `usuarioId` `usuarioId` INT(11) NOT NULL AFTER `analisada`,
CHANGE COLUMN `enderecoId` `enderecoId` INT(11) NOT NULL AFTER `usuarioId`,
CHANGE COLUMN `territorio` `territorio` ENUM("Nacional", "Internacional") NOT NULL ,
CHANGE COLUMN `motivo` `motivo` ENUM("Particular", "Serviço") NOT NULL ;

ALTER TABLE `livro_viagem`.`Funcao` 
DROP COLUMN `nivelDeAcessoId`,
ADD COLUMN `nivelDeAcesso` ENUM("Ler", "Escrever", "Despachar", "Administrar", "Root") NOT NULL AFTER `nome`,
CHANGE COLUMN `descricao` `nome` VARCHAR(45) NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`),
DROP INDEX `fk_Funcao_NivelDeAcesso1_idx` ;
;

DROP TABLE IF EXISTS `livro_viagem`.`niveldeacesso` ;

ALTER TABLE `livro_viagem`.`Cidade` 
ADD CONSTRAINT `fk_Cidade_Estado`
  FOREIGN KEY (`estadoId`)
  REFERENCES `livro_viagem`.`Estado` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `livro_viagem`.`Endereco` 
DROP FOREIGN KEY `fk_Endereco_Usuario1`;

ALTER TABLE `livro_viagem`.`Endereco` ADD CONSTRAINT `fk_Endereco_Usuario1`
  FOREIGN KEY (`usuarioId`)
  REFERENCES `livro_viagem`.`Usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Endereco_Cidade1`
  FOREIGN KEY (`cidadeId`)
  REFERENCES `livro_viagem`.`Cidade` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `livro_viagem`.`Usuario` 
DROP FOREIGN KEY `fk_Usuario_Hierarquia1`;

ALTER TABLE `livro_viagem`.`Usuario` ADD CONSTRAINT `fk_Usuario_Hierarquia1`
  FOREIGN KEY (`hierarquiaId`)
  REFERENCES `livro_viagem`.`Hierarquia` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Usuario_Funcao1`
  FOREIGN KEY (`funcaoId`)
  REFERENCES `livro_viagem`.`Funcao` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `livro_viagem`.`Telefone` 
ADD CONSTRAINT `fk_Telefone_Usuario1`
  FOREIGN KEY (`usuarioId`)
  REFERENCES `livro_viagem`.`Usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `livro_viagem`.`Viagem` 
DROP FOREIGN KEY `fk_Viagem_Usuario1`;

ALTER TABLE `livro_viagem`.`Viagem` ADD CONSTRAINT `fk_Viagem_Usuario1`
  FOREIGN KEY (`usuarioId`)
  REFERENCES `livro_viagem`.`Usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Viagem_Endereco1`
  FOREIGN KEY (`enderecoId`)
  REFERENCES `livro_viagem`.`Endereco` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
