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
  <p><a href="/arquivos/tabela_dados_sistema.pdf">Tabela de dados</a></p>

### 5.PMC
  <p><img src="/arquivos/PMC-v.1.0.png" alt="Project Model Canvas"></p>

### 6.MODELO CONCEITUAL
  <p><img src="/arquivos/modelo_conceitual.png" alt="Modelo conceitual"></p>

### 7.MODELO LÓGICO
  <p><img src="/arquivos/modelo_logico.png" alt="Modelo lógico"></p>

### 8.MODELO FÍSICO
  <p>
  
      DROP TABLE IF EXISTS Empresa;
      CREATE TABLE Empresa (
          idEmpresa int PRIMARY KEY,
          dscCpfCnpj varchar(45),
          Email varchar(45),
          Senha varchar(45)
      );

      DROP TABLE IF EXISTS Estacionamento;
      CREATE TABLE Estacionamento (
          idEstacionamento int PRIMARY KEY,
          NomeEstacionamento varchar(45),
          qtdVagas smallint,
          CEP varchar(45),
          Rua varchar(45),
          numRua int,
          fk_Vagas_idVaga int,
          fk_Empresa_idEmpresa int,
          fk_Bairro_idBairro int
      );

      DROP TABLE IF EXISTS Vagas;
      CREATE TABLE Vagas (
          idVaga int PRIMARY KEY,
          condVaga bit,
          PlacaCarro varchar(45),
          hrEntrada timestamp,
          qtdHrs time,
          HRSaidaPrevista timestamp
      );

      DROP TABLE IF EXISTS Bairro;
      CREATE TABLE Bairro (
          idBairro int PRIMARY KEY,
          dscBairro varchar(45)
      );

      DROP TABLE IF EXISTS historico_estacionamento;
      CREATE TABLE historico_estacionamento (
          idHistorico int PRIMARY KEY,
          dscPlacaCarro varchar(45),
          hrEntrada timestamp,
          hrSaidaPrevista timestamp,
          hrSaida timestamp
      );

      DROP TABLE IF EXISTS vagasHistorico;
      CREATE TABLE vagasHistorico (
          idHistorico int PRIMARY KEY,    
          idVaga int NOT NULL
      );

      ALTER TABLE Estacionamento ADD CONSTRAINT FK_Estacionamento_2
          FOREIGN KEY (fk_Vagas_idVaga)
          REFERENCES Vagas (idVaga)
          ON DELETE RESTRICT;

      ALTER TABLE Estacionamento ADD CONSTRAINT FK_Estacionamento_3
          FOREIGN KEY (fk_Empresa_idEmpresa)
          REFERENCES Empresa (idEmpresa)
          ON DELETE RESTRICT;

      ALTER TABLE Estacionamento ADD CONSTRAINT FK_Estacionamento_4
          FOREIGN KEY (fk_Bairro_idBairro)
          REFERENCES Bairro (idBairro)
          ON DELETE RESTRICT;
  </p>

### 9.INSERT APLICADO NAS TABELAS DO BANCO DE DADOS
  <p>
  
  
      INSERT INTO Bairro
      VALUES (1, 'Jardim da Penha'),
              (2, 'SÃ£o Pedro'),
              (3, 'Ilha das Caieiras'),
              (4, 'Jardim Camburi'),
              (5, 'Praia do Canto');

      INSERT INTO Empresa
      VALUES (1, '04.236.475/0001-32', 'vixpark@gmail.com', 'esYSXMdYyzQH'),
              (2, '34.353.384/0001-48', 'instaEmpresa@gmail.com', 'YkKjfxThEwDf'),
              (3, '229.802.280-10', 'parky.estacionamentos@hotmail.com', 'kqfcvGATSESk'),
              (4, '586.685.070-28', 'neyestacionamentos@outlook.com', 'rYbCNgNBUfvd');




      insert into Estacionamento (idestacionamento, nomeestacionamento, qtdvagas, cep, rua, numrua, fk_bairro_idbairro, fk_empresa_idempresa)
      Values(1, 'Vixpark Estacionamento', 4, '29047-035', 'Rua Orácio Cândido dos Santos', '540', 1, 1),
          (2, 'Instapark', 4, '29030-065', 'Travessa Canindé', '345', 2, 2),
          (3, 'Parky Estacionamento', 5, '29032-106', 'Rua Vista Linda', '781', 3, 3),
          (4, 'Estacioney', 5, '29027-160', 'Rua Lucidato Vieira Falcão', '201', 4, 4),
          (5, 'RotaPark', 4, '29050-227', 'Travessa do Tabual', '321', 5, 4);


      insert into Vagas (idvaga, condvaga, placacarro, hrentrada, qtdhrs, hrsaidaprevista)
      values (1, '0',  null, '09-07-2021 09:51:01', '08:00:00', '09/07/2021 17:51:01'),
      (2, '1', 'MHU9745' ,'10/07/2021 09:51:01',	'11:00:00'	,'10/07/2021 20:51:01'),
      (3,	'0',	null,	'11/07/2021 09:51:01',	'04:00:00',	'11/07/2021 13:51:01'), 
      (4,	'1',	'JPK8L12',	'12/07/2021 09:51:01',	'01:00:00',	'12/07/2021 10:51:01'),
      (5,	'0',	null,	null,	null,	null),
      (6,	'0',	null,	null,	null,	null),
      (7,	'1',	'KDJ3268',	'10/07/2021 09:51:01',	'11:00:00',	'10/07/2021 20:51:01'),
      (8,	'1',	'JTT2569',	'10/07/2021 09:51:01',	'11:00:00',	'10/07/2021 20:51:01'),
      (9,	'0',	null,	null,	null,	null),
      (10, '0',	null,	null,	null,	null),
      (11, '1',	'DNS7891',	'10/07/2021 09:51:01',	'11:00:00',	'10/07/2021 20:51:01'),
      (12, '0',	null,	null,	null,	null),
      (13, '0',	null,	null,	null,	null),
      (14, '1',	'NCO7561',	'10/07/2021 09:51:01',	'12:00:00',	'10/07/2021 21:51:01'),
      (15, '1',	'SHA1546',	'10/07/2021 09:51:01',	'12:00:00',	'10/07/2021 21:51:01'),
      (16,	'1',	'CNA4523',	'10/07/2021 09:51:01',	'13:00:00', '10/07/2021 22:51:01'),
      (17, '1',	'RPW4925',	'10/07/2021 09:51:01',	'14:00:00',	'10/07/2021 23:51:01'),
      (18, '1',	'CAP3614',	'10/07/2021 09:51:01',	'15:00:00',	'11/07/2021 00:51:01'),
      (19, '0',	null,	null,	null,	null),
      (20, '0',	null,	null,	null,	null),
      (21, '1',	'FJP1643',	'10/07/2021 09:51:01',	'11:00:00',	'10/07/2021 20:51:01'),
      (22, '0',	null,	null,	null,	null);
      
      INSERT INTO historico_estacionamento 
      VALUES (1,	'HSF0850',	'2021-07-09 12:02:09',	'2021-07-09 15:02:09',	'2021-07-09 15:02:09'),
      (2,	'NFB8592',	'2021-07-09 10:26:37',	'2021-07-09 11:26:37',	'2021-07-09 11:26:37'),
      (3,	'JQN7059',	'2021-07-09 06:12:22',	'2021-07-09 10:12:22',	'2021-07-09 10:12:22'),
      (4,	'MUR6823',	'2021-07-08 09:02:00',	'2021-07-08 11:02:00',	'2021-07-08 11:02:00'),
      (5,	'NFA2145',	'2021-07-08 13:02:00',	'2021-07-09 14:02:00',	'2021-07-09 14:02:00'),
      (6,	'MXO9426',	'2021-06-18 08:25:28',	'2021-06-18 10:25:28',	'2021-06-18 10:25:28'),
      (7,	'NET6883',	'2021-06-21 12:07:11',	'2021-06-21 14:00:00',	'2021-06-21 14:00:00'),
      (8,	'NET6883',	'2021-01-12 11:25:38',	'2021-01-12 14:25:38',	'2021-01-12 14:25:38'),
      (9,	'KBX2087',	'2021-07-22 10:55:36',	'2021-07-22 11:55:36',	'2021-07-22 11:55:36'),
      (10,	'MUO6663',	'2020-12-28 10:11:18',	'2020-12-28 11:11:18',	'2020-12-28 11:11:18'),
      (11,	'MWV1941',	'2021-07-15 08:58:46',	'2021-07-15 13:58:46',	'2021-07-15 13:58:46'),
      (12,	'KPQ7466',	'2021-09-01 11:49:13',	'2021-09-01 14:49:13',	'2021-09-01 14:49:13'),
      (13,	'HWA3740',	'2021-06-10 12:47:39',	'2021-06-10 15:47:00',	'2021-06-10 15:47:00'),
      (14,	'MFV9264',	'2021-01-06 08:17:24',	'2021-01-06 18:17:00',	'2021-01-06 18:17:00'),
      (15,	'LWL3427',	'2021-04-13 12:51:12',	'2021-04-13 13:51:12',	'2021-04-13 13:51:12'),
      (16,	'MXC5240',	'2021-05-26 11:46:08',	'2021-05-26 13:46:08',	'2021-05-27 13:46:08'),
      (17,	'MNB3961',	'2021-07-07 10:46:45',	'2021-07-07 18:46:45',	'2021-07-08 17:46:45'),
      (18,	'KBW6061',	'2020-09-15 07:40:00',	'2020-09-15 08:40:00',	'2020-09-15 08:40:00'),
      (19,	'MUD8981',	'2020-09-29 11:24:53',	'2020-09-29 15:24:53',	'2020-09-29 15:24:53'),
      (20,	'HTV5237',	'2021-07-08 07:00:09',	'2021-07-08 09:00:09',	'2021-07-08 09:00:09'),
      (21,	'MWW1974',	'2021-08-20 12:35:47',	'2021-08-20 15:35:47',	'2021-08-21 15:35:47'),
      (22,	'HZQ1381',	'2021-01-20 09:09:09',	'2021-01-20 10:09:09',	'2021-01-20 10:09:09'),
      (23,	'NEO5813',	'2020-11-05 10:05:28',	'2020-11-05 11:05:28',	'2020-11-06 11:05:28'),
      (24,	'MXM9004',	'2021-04-06 12:52:04',	'2021-04-06 15:52:04',	'2021-04-06 15:52:04'),
      (25,	'NEB0273',	'2021-01-14 10:08:51',	'2021-01-14 15:10:00',	'2021-01-14 15:10:00'),
      (26,	'HRJ7052',	'2021-07-15 11:09:52',	'2021-07-15 13:09:52',	'2021-07-15 13:09:52'),
      (27,	'MRJ0845',	'2020-12-27 11:11:37',	'2020-12-27 16:11:37',	'2020-12-27 16:11:37'),
      (28,	'NBW8056',	'2020-08-23 11:38:03',	'2020-08-23 16:38:03',	'2020-08-23 16:38:03'),
      (29,	'HWT2078',	'2020-09-24 08:18:31',	'2020-09-24 10:18:31',	'2020-09-25 10:18:31'),
      (30,	'KLQ2773',	'2021-01-23 10:46:06',	'2021-01-23 15:46:06',	'2021-01-24 15:46:06');

      INSERT INTO vagasHistorico 
      VALUES (1,	1),
      (2,	6),
      (3,	1),
      (4,	2),
      (5,	7),
      (6,	3),
      (7,	3),
      (8,	5),
      (9,	20),
      (10,	6),
      (11,	11),
      (12,	12),
      (13,	13),
      (14,	14),
      (15,	15),
      (16,	16),
      (17,	17),
      (18,	18),
      (19,	19),
      (20,	2),
      (21,	10),
      (22, 7),
      (23,	5),
      (24,	10),
      (25,	9),
      (26, 6),
      (27, 22),
      (28,	21),
      (29,	9),
      (30,	8);
  
      UPDATE estacionamento SET fk_bairro_idbairro = 1 WHERE idestacionamento = 5;
      UPDATE estacionamento SET cep = '29047-291', rua = 'Rua José Elias dos Reis Fraga' WHERE idEstacionamento = 5;
      
</p>

### 10.TABELAS E PRINCIPAIS CONSULTAS
  #### 10.1 CONSULTAS DAS TABELAS COM TODOS OS DADOS INSERIDOS
      SELECT * FROM empresa
<p><img src="/arquivos/SELECTS/empresa.PNG" alt="Select empresa"></p>

      SELECT * FROM estacionamento
<p><img src="/arquivos/SELECTS/estacionamento.PNG" alt="Select estacionamento"></p>

      SELECT * FROM bairro
 <p><img src="/arquivos/SELECTS/bairro.PNG" alt="Select bairro"></p>     
 
      SELECT * FROM vagas 
<p><img src="/arquivos/SELECTS/vagas.PNG" alt="Select vagas"></p>

      SELECT * FROM historico_estacionamento;
<p><img src="/arquivos/SELECTS/historico_estacionamento.PNG" alt="Select historico_estacionamento"></p>

      SELECT * FROM vagasHistorico;
<p><img src="/arquivos/SELECTS/vagasHistorico.PNG" alt="Select vagasHistórico"></p>      

  #### 10.2 PRINCIPAIS CONSULTAS DO SISTEMA
  Relatório com a quantidade de horas que os veículos estacionaram em um dia específico.<br>
  
      SELECT dscplacacarro, extract(hour from hrsaida - hrentrada) as "TempoEstacionado" FROM historico_estacionamento WHERE date(hrEntrada) = '2021-07-09';
      
<p><img src="/arquivos/1.PNG" alt="Relatório 1"></p>
      
 Relatório com a quantidade média de horas que os carros estacionados definiram no dia.<br>
 
      SELECT avg(qtdHrs) AS "Media Qtd Horas" FROM vagas;
      
<p><img src="/arquivos/2.PNG" alt="Relatório 2"></p>
      
 Relatório com as vagas ocupadas no mês 7;<br>
 
      SELECT * FROM historico_estacionamento WHERE EXTRACT(MONTH FROM hrentrada) = 7;
<p><img src="/arquivos/3.PNG" alt="Relatório 3"></p>
     
Relatório que informe a quantidade de estacionamentos por bairro.<br>

      SELECT brr.dscBairro, COUNT(*) as "Qtd estacionamento / bairro" from estacionamento est inner join Bairro brr on (est.fk_bairro_idBairro = brr.idbairro) GROUP BY brr.dscBairro;
<p><img src="/arquivos/4.PNG" alt="Relatório 4"></p>
    
Relatório de Empresas e Estacionamentos, incluindo as seguintes informações: id da Empresa, id do Estacionamento.<br>

      SELECT idEstacionamento, fk_empresa_idEmpresa FROM estacionamento;
<p><img src="/arquivos/5.PNG" alt="Relatório 5"></p>  
      
### 11.Gráficos, relatórios, integração com Linguagem de programação e outras solicitações
  <p></p>

### 12.Slides e Apresentação em vídeo.
  <p></p>

### OBSERVAÇÕES IMPORTANTES
  
