
drop database livro_viagem;
drop database mydb;
-- MySQL Workbench Forward Engineering
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema livro_viagem
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema livro_viagem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `livro_viagem` DEFAULT CHARACTER SET utf8 ;
USE `livro_viagem` ;

-- -----------------------------------------------------
-- Table `livro_viagem`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `sigla` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE,
  UNIQUE INDEX `sigla_UNIQUE` (`sigla` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Cidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `estadoId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Cidade_Estado_idx` (`estadoId` ASC) VISIBLE,
  CONSTRAINT `fk_Cidade_Estado`
    FOREIGN KEY (`estadoId`)
    REFERENCES `livro_viagem`.`Estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Bairro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cidadeId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Bairro_Cidade1_idx` (`cidadeId` ASC) VISIBLE,
  CONSTRAINT `fk_Bairro_Cidade1`
    FOREIGN KEY (`cidadeId`)
    REFERENCES `livro_viagem`.`Cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `logradouro` VARCHAR(100) NOT NULL,
  `numero` VARCHAR(100) NOT NULL,
  `bairroId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Endereco_Bairro1_idx` (`bairroId` ASC) VISIBLE,
  CONSTRAINT `fk_Endereco_Bairro1`
    FOREIGN KEY (`bairroId`)
    REFERENCES `livro_viagem`.`Bairro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Hierarquia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Hierarquia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `postoOuGraduacao` VARCHAR(100) NOT NULL,
  `sigla` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `postoOuGraduacao_UNIQUE` (`postoOuGraduacao` ASC) VISIBLE,
  UNIQUE INDEX `sigla_UNIQUE` (`sigla` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `status` TINYINT NOT NULL,
  `dataDeCriacao` DATETIME NOT NULL,
  `ultimoAcesso` DATETIME NOT NULL,
  `hierarquiaId` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Usuario_Hierarquia1_idx` (`hierarquiaId` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_Hierarquia1`
    FOREIGN KEY (`hierarquiaId`)
    REFERENCES `livro_viagem`.`Hierarquia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Telefone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(100) NOT NULL,
  `contato` ENUM("EMERGENCIA", "LOCALIZACAO") NOT NULL,
  `parentescoDoContato` VARCHAR(100) NOT NULL,
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Telefone_Usuario1_idx` (`usuarioId` ASC) VISIBLE,
  CONSTRAINT `fk_Telefone_Usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `livro_viagem`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Viagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Viagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aprovada` TINYINT NOT NULL,
  `territorio` ENUM("NACIONAL", "INTERNACIONAL") NOT NULL,
  `motivo` ENUM("PARTICULAR", "SERVICO") NOT NULL,
  `usuarioId` INT NOT NULL,
  `enderecoId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Viagem_Usuario1_idx` (`usuarioId` ASC) VISIBLE,
  INDEX `fk_Viagem_Endereco1_idx` (`enderecoId` ASC) VISIBLE,
  CONSTRAINT `fk_Viagem_Usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `livro_viagem`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Viagem_Endereco1`
    FOREIGN KEY (`enderecoId`)
    REFERENCES `livro_viagem`.`Endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

