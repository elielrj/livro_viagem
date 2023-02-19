
CREATE SCHEMA IF NOT EXISTS `livro_viagem` DEFAULT CHARACTER SET utf8 ;
USE `livro_viagem` ;

-- -----------------------------------------------------
-- Table `livro_viagem`.`Numero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Numero` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
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
  `nome` VARCHAR(45) NOT NULL,
  `estadoId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Cidade_Estado_idx` (`estadoId` ASC) VISIBLE,
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE,
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
  `nome` VARCHAR(45) NOT NULL,
  `cidadeId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Bairro_Cidade1_idx` (`cidadeId` ASC) VISIBLE,
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE,
  CONSTRAINT `fk_Bairro_Cidade1`
    FOREIGN KEY (`cidadeId`)
    REFERENCES `livro_viagem`.`Cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Logradouro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Logradouro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `bairroId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Logradouro_Bairro1_idx` (`bairroId` ASC) VISIBLE,
  CONSTRAINT `fk_Logradouro_Bairro1`
    FOREIGN KEY (`bairroId`)
    REFERENCES `livro_viagem`.`Bairro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `logradouroId` INT NOT NULL,
  `numeroId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Endereco_Logradouro1_idx` (`logradouroId` ASC) VISIBLE,
  INDEX `fk_Endereco_Numero1_idx` (`numeroId` ASC) VISIBLE,
  CONSTRAINT `fk_Endereco_Logradouro1`
    FOREIGN KEY (`logradouroId`)
    REFERENCES `livro_viagem`.`Logradouro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Endereco_Numero1`
    FOREIGN KEY (`numeroId`)
    REFERENCES `livro_viagem`.`Numero` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Hierarquia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Hierarquia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `postoOuGraduacao` VARCHAR(15) NOT NULL,
  `sigla` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `postoOuGraduacao_UNIQUE` (`postoOuGraduacao` ASC) VISIBLE,
  UNIQUE INDEX `sigla_UNIQUE` (`sigla` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `status` TINYINT NOT NULL,
  `dataDeCriacao` DATETIME NOT NULL,
  `ultimoAcesso` DATETIME NOT NULL,
  `hierarquiaId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Usuario_Hierarquia1_idx` (`hierarquiaId` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_Hierarquia1`
    FOREIGN KEY (`hierarquiaId`)
    REFERENCES `livro_viagem`.`Hierarquia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Viagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Viagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Viagem_Usuario1_idx` (`usuarioId` ASC) VISIBLE,
  CONSTRAINT `fk_Viagem_Usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `livro_viagem`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Internacional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Internacional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aprovada` TINYINT NOT NULL,
  `tipo` ENUM("PARTICULAR", "TRABALHO") NOT NULL,
  `enderecoId` INT NOT NULL,
  `viagemId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Internacional_Endereco1_idx` (`enderecoId` ASC) VISIBLE,
  INDEX `fk_Internacional_Viagem1_idx` (`viagemId` ASC) VISIBLE,
  CONSTRAINT `fk_Internacional_Endereco1`
    FOREIGN KEY (`enderecoId`)
    REFERENCES `livro_viagem`.`Endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Internacional_Viagem1`
    FOREIGN KEY (`viagemId`)
    REFERENCES `livro_viagem`.`Viagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Nacional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Nacional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aprovada` TINYINT NOT NULL,
  `tipo` ENUM("PARTICULAR", "TRABALHO") NOT NULL,
  `enderecoId` INT NOT NULL,
  `viagemId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Nacional_Endereco1_idx` (`enderecoId` ASC) VISIBLE,
  INDEX `fk_Nacional_Viagem1_idx` (`viagemId` ASC) VISIBLE,
  CONSTRAINT `fk_Nacional_Endereco1`
    FOREIGN KEY (`enderecoId`)
    REFERENCES `livro_viagem`.`Endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nacional_Viagem1`
    FOREIGN KEY (`viagemId`)
    REFERENCES `livro_viagem`.`Viagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `livro_viagem`.`Telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `livro_viagem`.`Telefone` (
  `id` INT NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `parentescoDoContato` VARCHAR(45) NOT NULL,
  `contatoDeEmergencia` TINYINT NOT NULL,
  `contatoDeLocalizacao` TINYINT NOT NULL,
  `usuarioId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Telefone_Usuario1_idx` (`usuarioId` ASC) VISIBLE,
  CONSTRAINT `fk_Telefone_Usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `livro_viagem`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


