
DROP TABLE IF EXISTS
	aloca,
	vaga,
	endereco,
  	imagem,
	estacionamento,
	empresa;
    
-- -----------------------------------------------------
-- Table imagem
-- -----------------------------------------------------
CREATE table imagem (
  idImg INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NULL,
  dataImg DATETIME NULL,
  idEmpresa INT NOT NULL,
  PRIMARY KEY (idImg),
  INDEX fk_imagem_empresa1_idx (idEmpresa ASC) VISIBLE,
  CONSTRAINT fk_imagem_empresa1
    FOREIGN KEY (idEmpresa)
    REFERENCES empresa (idEmpresa)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table empresa
-- -----------------------------------------------------

CREATE TABLE empresa (
  idEmpresa INT NOT NULL AUTO_INCREMENT,
  nomEmpresa VARCHAR(45) NOT NULL,
  dscCpfCnpj VARCHAR(45) NULL,
  email VARCHAR(45) NULL,
  telefone VARCHAR(25) NULL,
  senha VARCHAR(255) NOT NULL,
  PRIMARY KEY (idEmpresa))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table endereco
-- -----------------------------------------------------

CREATE TABLE endereco (
  idEnd INT NOT NULL AUTO_INCREMENT,
  dscLogradouro VARCHAR(45) NULL,
  numero INT NULL,
  cep VARCHAR(45) NOT NULL,
  bairro VARCHAR(45) NULL,
  cidade VARCHAR(45) NULL,
  estado VARCHAR(45) NULL,
  idEstac INT NOT NULL,
  PRIMARY KEY (idEnd),
  INDEX fk_endereco_estacionamento1_idx (idEstac ASC) VISIBLE,
  CONSTRAINT fk_endereco_estacionamento1
    FOREIGN KEY (idEstac)
    REFERENCES estacionamento (idEstac)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
  PRIMARY KEY (idEstac),
  INDEX fk_estacionamento_empresa_idx (idEmpresa ASC) VISIBLE,
  CONSTRAINT fk_estacionamento_empresa
    FOREIGN KEY (idEmpresa)
    REFERENCES empresa (idEmpresa)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table vaga
-- -----------------------------------------------------

CREATE TABLE vaga (
  idVaga INT NOT NULL AUTO_INCREMENT,
  condVaga TINYINT NULL,
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
  idAloca INT NOT NULL AUTO_INCREMENT,
  idVaga INT NOT NULL,
  nomCliente VARCHAR(45) NULL,
  cpfCliente VARCHAR(45) NULL,
  hrEntrada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  hrSaida TIMESTAMP NULL,
  valTotal DOUBLE NULL,
  dscPlaca VARCHAR(25) NULL,
  INDEX fk_pessoa_has_vaga_vaga1_idx (idVaga ASC) VISIBLE,
  PRIMARY KEY (idAloca),
  CONSTRAINT fk_pessoa_has_vaga_vaga1
    FOREIGN KEY (idVaga)
    REFERENCES vaga (idVaga)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



INSERT INTO imagem (nome, dataImg, idEmpresa) VALUES ('00beb17e71130576fc17486ae1981b8a', '2022-01-20 13:22:46', 1);


-- -----------------------------------------------------
-- Data for table `mydb`.`empresa`
-- -----------------------------------------------------
INSERT INTO empresa (nomEmpresa, dscCpfCnpj, email, telefone, senha) VALUES ('Empresa de Teste', '12345678966', 'teste@empresa.com', '2793658329', '$2y$10$VJVFrXnbIt1SyD2Ht8UY1O1Evywx4Sp/cJ/9stJV6ntqYjQio9yaC');




-- -----------------------------------------------------
-- Data for table `mydb`.`endereco`
-- -----------------------------------------------------
INSERT INTO endereco (idEnd, dscLogradouro, numero, cep, bairro, cidade, estado, idEstac) VALUES (1, 'Rua Alceu Valença', '63', '29174938', 'São Vincente', 'Serra', 'ES', 1)



-- -----------------------------------------------------
-- Data for table `mydb`.`estacionamento`
-- -----------------------------------------------------
INSERT INTO estacionamento (idEstac, nomEstac, qtdVagas, valFixo, valAcresc, idEmpresa) VALUES (1, 'Teste', 30, 5, 2.5, 1);



-- -----------------------------------------------------
-- Data for table `mydb`.`vaga`
-- -----------------------------------------------------

INSERT INTO vaga (idVaga, condVaga, idEstac) VALUES (1, 1, 1), (2, 1, 1), (3, 0, 1), (4, 0, 1);


-- -----------------------------------------------------
-- Data for table `mydb`.`aloca`
-- -----------------------------------------------------
INSERT INTO aloca (idPessoa, idVaga, idAloca, nomCliente, cpfCliente, hrEntrada, hrSaida, valTotal, dscPlaca) VALUES (1, 1, 1, 'Josefina Chaves', '123.456.789-44', '2022-01-19 16:51:57', NULL, NULL, 'dfj4839'),
(2, 2, 2, 'Augusto Gonçalo', '743.753.347-42', '2022-01-19 16:51:57', NULL, NULL, 'abc1234');

