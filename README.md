# TRABALHO DE PI: Sistema de Controle de Estacionamento Rotativo
O Projeto Integrador consiste em um Sistema de Controle de Estacionamento Rotativo desenvolvido por alunos do IFES na disciplina de Banco de Dados.

# Sumário
### 1.COMPONENTES
  <p>Integrantes do Grupo:<br>
  Guilherme Silveira Mendes: guilhermesilveira.2015@hotmail.com<br>
  Lara Aguilar de Amorim: lara.aguilar2003@gmail.com</p>

### 2.MINIMUNDO
<p>O sistema proposto para o "Sistema de Controle de Estacionamento" conterá todas as informações aqui detalhadas. Das Empresas  serão armazenados o id, CPF ou CNPJ, e-mail e senha. Dos Estacionamentos serão armazenados o id, nome, quantidade de vagas, CEP, nome da rua, número da rua, id do bairro e o id empresa. Dos Bairros serão armazenados o id e o nome do bairro. Os dados relativos às Vagas que serão armazenadas são: id da vaga, id do estacionamento, a condição da vaga, placa do carro, hora de entrada, quantidade de horas definidas e a hora prevista. Dado que a condição da vaga pode ser 0 (desocupada) ou 1 (ocupada) e a hora prevista é dada com base na quantidade de horas definidas e na hora de entrada.</p>

### 3.RASCUNHOS BÁSICOS DA INTERFACE (MOCKUPS)
  <p><a href="/arquivos/mockup-web.pdf">Mockup Web</a></p>
  
  #### 3.1.QUAIS PERGUNTAS PODEM SER RESPONDIDAS COM O SISTEMA PROPOSTO?

  > O Sistema de Estacionamento precisa inicialmente dos seguintes relatórios:<br>
    * Relatório com a quantidade de veículos que utilizaram o estacionamento por dia.<br>
    * Relatório com a quantidade média de horas que os carros costumam definir.<br>
    * Relatório com os horários de maior e menor fluxo de veículos de cada estacionamento, incluindo as seguintes informações: id da empresa, nome do estacionamento, horário de menor fluxo, horário de maior fluxo.<br>
    * Relatório que informe a quantidade de estacionamentos por bairro, com as seguintes informações: nome do bairro e a quantidade de estacionamentos.<br>
    * Relatório de Empresas e Estacionamentos, incluindo as seguintes informações: id da Empresa, id do Estacionamento.<br>

### 4.TABELA DE DADOS DO SISTEMA
  <p><a href="/DB/tabela_dados_sistema.pdf">Tabela de dados</a></p>

### 5.PMC
  <p><img src="/arquivos/imagens/PMC-v2.0.png" alt="Project Model Canvas"></p>

### 6.MODELO CONCEITUAL
  <p><img src="/DB/modelo_conceitual.png" alt="Modelo conceitual"></p>

### 7.MODELO LÓGICO
  <p><img src="/DB/modelo-logico.png" alt="Modelo lógico"></p>

### 8.MODELO FÍSICO
  [Código BD](DB/BD_code.sql)

  '''
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



    
    '''

### 9.INSERT APLICADO NAS TABELAS DO BANCO DE DADOS
  
  '''
  INSERT INTO imagem (nome, dataImg, idEmpresa) VALUES ('00beb17e71130576fc17486ae1981b8a', '2022-01-20 13:22:46', 1);


    -- -----------------------------------------------------
    -- Data for table empresa
    -- -----------------------------------------------------
    INSERT INTO empresa (nomEmpresa, dscCpfCnpj, email, telefone, senha) VALUES ('Empresa de Teste', '12345678966', 'teste@empresa.com', '2793658329', '$2y$10$VJVFrXnbIt1SyD2Ht8UY1O1Evywx4Sp/cJ/9stJV6ntqYjQio9yaC');




    -- -----------------------------------------------------
    -- Data for table endereco
    -- -----------------------------------------------------
    INSERT INTO endereco (idEnd, dscLogradouro, numero, cep, bairro, cidade, estado, idEstac) VALUES (1, 'Rua Alceu Valença', '63', '29174938', 'São Vincente', 'Serra', 'ES', 1)



    -- -----------------------------------------------------
    -- Data for table estacionamento
    -- -----------------------------------------------------
    INSERT INTO estacionamento (idEstac, nomEstac, qtdVagas, valFixo, valAcresc, idEmpresa) VALUES (1, 'Teste', 30, 5, 2.5, 1);



    -- -----------------------------------------------------
    -- Data for table vaga
    -- -----------------------------------------------------

    INSERT INTO vaga (idVaga, condVaga, idEstac) VALUES (1, 1, 1), (2, 1, 1), (3, 0, 1), (4, 0, 1);


    -- -----------------------------------------------------
    -- Data for table aloca
    -- -----------------------------------------------------
    INSERT INTO aloca (idPessoa, idVaga, idAloca, nomCliente, cpfCliente, hrEntrada, hrSaida, valTotal, dscPlaca) VALUES (1, 1, 1, 'Josefina Chaves', '123.456.789-44', '2022-01-19 16:51:57', NULL, NULL, 'dfj4839'),
    (2, 2, 2, 'Augusto Gonçalo', '743.753.347-42', '2022-01-19 16:51:57', NULL, NULL, 'abc1234');
  '''


### 10.TABELAS E PRINCIPAIS CONSULTAS (desatualizado)
  #### 10.1 CONSULTAS DAS TABELAS COM TODOS OS DADOS INSERIDOS
      SELECT * FROM empresa;
<p><img src="/arquivos/imagens/selects/empresa.PNG" alt="Select empresa"></p>

      SELECT * FROM estacionamento;
<p><img src="/arquivos/imagens/selects/estacionamento.PNG" alt="Select estacionamento"></p>

      SELECT * FROM bairro;
 <p><img src="/arquivos/imagens/selects/bairro.PNG" alt="Select bairro"></p>     
 
      SELECT * FROM vaga;
<p><img src="/arquivos/imagens/selects/vagas.PNG" alt="Select vagas"></p>

      SELECT * FROM endereco;
<p><img src="/arquivos/imagens/selects/endereco.png" alt="Select endereco"></p>

      SELECT * FROM aloca
<p><img src="/arquivos/imagens/selects/aloca.png" alt="Select vagasHistórico"></p>      

  #### 10.2 PRINCIPAIS CONSULTAS DO SISTEMA
  ##### 1) Relatório com a quantidade de horas que os veículos estacionaram em um dia específico.<br>
      SELECT dscplaca, extract(hour from hr_saidaEfetiva - hr_entrada) as "TempoEstacionado" FROM aloca WHERE date(hr_Entrada) = '2021-07-09';
      
<p><img src="/arquivos/imagens/consultas/1.PNG" alt="Relatório 1"></p>
      
 ##### 2) Relatorio com o nome do estacionamento e quantidade de vagas.<br>
 

      SELECT nomestac, qtdvagas FROM estacionamento;



      
<p><img src="/arquivos/imagens/consultas/2.PNG" alt="Relatório 2"></p>
      
 ##### 3) Relatório com as vagas ocupadas no mês 7;<br>
 

      SELECT dscplaca, extract(hour from hr_saidaefetiva - hr_entrada) as "Tempo" FROM aloca WHERE EXTRACT(MONTH FROM hr_entrada) = 7 order by "Tempo";


<p><img src="/arquivos/imagens/consultas/3.PNG" alt="Relatório 3"></p>
     
##### 4) Relatório que informe a quantidade de estacionamentos por bair.<br>

      SELECT brr.nomBairro, COUNT(*) as "Qtd estacionamento / bairro" FROM Endereco ende INNER JOIN Bairro brr on (ende.idbairro = brr.idbairro) GROUP BY brr.nomBairro;
<p><img src="/arquivos/imagens/consultas/4.PNG" alt="Relatório 4"></p>
    
##### 5) Relatório de Empresas e Estacionamentos, incluindo as seguintes informações: nome do estacionamento, id da empresa.<br>

        SELECT emp.nomempresa, count(*) as "qtdEstacionamento" FROM estacionamento est inner join empresa emp on (est.idempresa = emp.idempresa) group by emp.idempresa;
<p><img src="/arquivos/imagens/consultas/5.PNG" alt="Relatório 5"></p>  
      
### 11.Gráficos, relatórios, integração com Linguagem de programação e outras solicitações (desatualizados)
#### 11.1 Integração com Linguagem de Programação;
<p><img src="/arquivos/conexao_postgres.PNG" alt="Conexão com o postgres"></p>

#### 11.2 Desenvolvimento de gráficos/relatórios pertinentes, juntamente com demais;
<p><img src="/arquivos/imagens/graficos_relatorios/relatorio1.PNG" alt="Relatório 1"></p>
<p><img src="/arquivos/imagens/graficos_relatorios/relatorio2.PNG" alt="Relatório 2"></p>
<p><img src="/arquivos/imagens/graficos_relatorios/relatorio3.PNG" alt="Relatório 3"></p>
<p><img src="/arquivos/imagens/graficos_relatorios/relatorio4.PNG" alt="Relatório 4"></p>
<p><img src="/arquivos/imagens/graficos_relatorios/relatorio5.PNG" alt="Relatório 5"></p>

### 12.Slides e Apresentação em vídeo.
#### 12.1 Slides;
https://docs.google.com/presentation/d/1b_0QjegHWRP4IcaemKGxc9DQ9KeSATGLhsF4ZXBTasA/edit?usp=sharing 

#### 12.2 Apresentação em vídeo;
https://youtu.be/W0MX4GAFrdY
