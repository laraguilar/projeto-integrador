-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP TABLE IF EXISTS
	Aloca,
	Vaga,
	Pessoa,
	Endereco,
	estacionamento,
	empresa;
-- -----------------------------------------------------
-- Table pessoa
-- -----------------------------------------------------

CREATE TABLE pessoa (
  idPessoa INT NOT NULL AUTO_INCREMENT,
  nomPessoa VARCHAR(45),
  datNasc DATE,
  sexPessoa VARCHAR(5),
  cpfPessoa VARCHAR(45) NOT NULL,
  PRIMARY KEY (idPessoa))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table empresa
-- -----------------------------------------------------

CREATE TABLE empresa (
  idEmpresa INT NOT NULL AUTO_INCREMENT,
  nomEmpresa VARCHAR(45) NOT NULL,
  dscCpfCnpj VARCHAR(45) NULL,
  email VARCHAR(45) NULL,
  senha VARCHAR(255) NOT NULL,
  PRIMARY KEY (idEmpresa))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table endereco
-- -----------------------------------------------------

CREATE TABLE endereco (
  idEnd INT NOT NULL AUTO_INCREMENT,
  dscLogradouro VARCHAR(45) NULL,
  numero VARCHAR(45) NULL,
  cep VARCHAR(45) NULL,
  bairro VARCHAR(45) NULL,
  cidade VARCHAR(45) NULL,
  estado VARCHAR(45) NULL,
  PRIMARY KEY (idEnd))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table estacionamento
-- -----------------------------------------------------

CREATE TABLE estacionamento (
  idEstac INT NOT NULL AUTO_INCREMENT,
  nomEstac VARCHAR(45) NOT NULL,
  qtdVagas INT NOT NULL,
  valFixo DOUBLE NOT NULL,
  valAcresc DOUBLE NULL,
  idEmpresa INT NOT NULL,
  idEnd INT NOT NULL,
  PRIMARY KEY (idEstac),
  INDEX fk_estacionamento_empresa_idx (idEmpresa ASC) VISIBLE,
  INDEX fk_estacionamento_endereco1_idx (idEnd ASC) VISIBLE,
  CONSTRAINT fk_estacionamento_empresa
    FOREIGN KEY (idEmpresa)
    REFERENCES empresa (idEmpresa)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_estacionamento_endereco1
    FOREIGN KEY (idEnd)
    REFERENCES endereco (idEnd)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table vaga
-- -----------------------------------------------------

CREATE TABLE vaga (
  idVaga INT NOT NULL AUTO_INCREMENT,
  condVaga TINYINT,
  idEstac INT NOT NULL,
  PRIMARY KEY (idVaga),
  INDEX fk_vaga_estacionamento1_idx (idEstac ASC) VISIBLE,
  CONSTRAINT fk_vaga_estacionamento1
    FOREIGN KEY (idEstac)
    REFERENCES estacionamento (idEstac)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table aloca
-- -----------------------------------------------------

CREATE TABLE aloca (
  idPessoa INT NOT NULL,
  idVaga INT NOT NULL,
  idAloca INT NOT NULL AUTO_INCREMENT,
  INDEX fk_pessoa_has_vaga_vaga1_idx (idVaga ASC) VISIBLE,
  INDEX fk_pessoa_has_vaga_pessoa1_idx (idPessoa ASC) VISIBLE,
  PRIMARY KEY (idAloca),
  CONSTRAINT fk_pessoa_has_vaga_pessoa1
    FOREIGN KEY (idPessoa)
    REFERENCES pessoa (idPessoa)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_pessoa_has_vaga_vaga1
    FOREIGN KEY (idVaga)
    REFERENCES vaga (idVaga)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Data for table pessoa
-- -----------------------------------------------------

INSERT INTO pessoa (idPessoa, nomPessoa, datNasc, sexPessoa, cpfPessoa) VALUES (1, 'João Abreu', '1974-12-31', 'M', '908.443.740-32'),
(2, 'Juriscreide', '1983-10-24', 'F', '103.421.541-56');


-- -----------------------------------------------------
-- Data for table empresa
-- -----------------------------------------------------

INSERT INTO empresa (idEmpresa, nomEmpresa, dscCpfCnpj, email, senha) VALUES (1, 'Empresa de Teste', '12345678966', 'teste@empresa.com', '$2y$10$VJVFrXnbIt1SyD2Ht8UY1O1Evywx4Sp/cJ/9stJV6ntqYjQio9yaC');


-- -----------------------------------------------------
-- Data for table endereco
-- -----------------------------------------------------

INSERT INTO endereco (idEnd, dscLogradouro, numero, cep, bairro, cidade, estado) VALUES (1, 'Rua Alceu Valença', 63, '29174938', 'São Vincente', 'Serra', 'ES');


-- -----------------------------------------------------
-- Data for table estacionamento
-- -----------------------------------------------------

INSERT INTO estacionamento (idEstac, nomEstac, qtdVagas, valFixo, valAcresc, idEmpresa, idEnd) VALUES (1, 'Teste', 30, 5, 2.5, 1, 1);


-- -----------------------------------------------------
-- Data for table vaga
-- -----------------------------------------------------

INSERT INTO vaga (idVaga, condVaga, idEstac) VALUES (1, 0, 1);
INSERT INTO vaga (idVaga, condVaga, idEstac) VALUES (2, 0, 1);
INSERT INTO vaga (idVaga, condVaga, idEstac) VALUES (3, 0, 1);


-- -----------------------------------------------------
-- Data for table aloca
-- -----------------------------------------------------

INSERT INTO aloca (idPessoa, idVaga, idAloca) VALUES (1, 1, 1);
