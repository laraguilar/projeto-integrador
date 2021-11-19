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
  <p><img src="/arquivos/imagens/PMC-v1.1.png" alt="Project Model Canvas"></p>

### 6.MODELO CONCEITUAL
  <p><img src="/arquivos/imagens/modelos/modelo_conceitual.png" alt="Modelo conceitual"></p>

### 7.MODELO LÓGICO
  <p><img src="/arquivos/imagens/modelos/modelo_logico.png" alt="Modelo lógico"></p>

### 8.MODELO FÍSICO
  <p>
  
      DROP TABLE IF EXISTS Aloca;
      CREATE TABLE Aloca (
          idAloca int PRIMARY KEY,
          dscPlaca varchar(12),
          hr_entrada TIMESTAMP,
          hr_saidaPrevista TIMESTAMP,
          hr_saidaEfetiva TIMESTAMP,
          idEmpresa int,
          codVaga int
      );

      DROP TABLE IF EXISTS VAGA;
      CREATE TABLE VAGA (
          codVaga int PRIMARY KEY,
          condVaga bool,
          idEstac int
      );

      DROP TABLE IF EXISTS ENDERECO;
      CREATE TABLE ENDERECO (
          idEnd int PRIMARY KEY,
          dscLogradouro varchar(45),
          numero int,
          cep varchar(20),
          idEstac int,
          idBairro int
      );
      DROP TABLE IF EXISTS BAIRRO;
      CREATE TABLE BAIRRO (
          idBairro int PRIMARY KEY,
          nomBairro varchar(45)
      );

      DROP TABLE IF EXISTS ESTACIONAMENTO;
      CREATE TABLE ESTACIONAMENTO (
          idEstac int PRIMARY KEY,
          nomEstac varchar(45),
          qtdVagas int,
          idEmpresa int
      );


      DROP TABLE IF EXISTS EMPRESA;
      CREATE TABLE EMPRESA (
          idEmpresa int PRIMARY KEY,
          nomEmpresa varchar(45),
          dscCpfCnpj varchar(45),
          Email varchar(45),
          Senha varchar(45)
      );


      ALTER TABLE ESTACIONAMENTO ADD CONSTRAINT FK_ESTACIONAMENTO_2
          FOREIGN KEY (idEmpresa)
          REFERENCES EMPRESA (idEmpresa)
          ON DELETE RESTRICT;

      ALTER TABLE ENDERECO ADD CONSTRAINT FK_ENDERECO_2
          FOREIGN KEY (idEstac)
          REFERENCES ESTACIONAMENTO (idEstac)
          ON DELETE RESTRICT;

      ALTER TABLE ENDERECO ADD CONSTRAINT FK_ENDERECO_3
          FOREIGN KEY (idBairro)
          REFERENCES BAIRRO (idBairro)
          ON DELETE RESTRICT;

      ALTER TABLE VAGA ADD CONSTRAINT FK_VAGA_2
          FOREIGN KEY (idEstac)
          REFERENCES ESTACIONAMENTO (idEstac)
          ON DELETE RESTRICT;

      ALTER TABLE Aloca ADD CONSTRAINT FK_Aloca_2
          FOREIGN KEY (idEmpresa)
          REFERENCES EMPRESA (idEmpresa)
          ON DELETE SET NULL;

      ALTER TABLE Aloca ADD CONSTRAINT FK_Aloca_3
          FOREIGN KEY (codVaga)
          REFERENCES VAGA (codVaga)
          ON DELETE SET NULL;
  </p>

### 9.INSERT APLICADO NAS TABELAS DO BANCO DE DADOS
  <p>
  
    INSERT INTO Empresa
    VALUES (1, 'Vix Park', '04.236.475/0001-32', 'vixpark@gmail.com', 'esYSXMdYyzQH'),
            (2, 'InstaPark','34.353.384/0001-48', 'instaEmpresa@gmail.com', 'YkKjfxThEwDf'),
            (3, 'Parky Estacionamentos','229.802.280-10', 'parky.estacionamentos@hotmail.com', 'kqfcvGATSESk'),
            (4, 'Estacioney','586.685.070-28', 'neyestacionamentos@outlook.com', 'rYbCNgNBUfvd');

    INSERT INTO Estacionamento
    VALUES (1, 'Vixpark Estacionamento', 4, 1),
          (2, 'Instapark', 4, 2),
          (3, 'Parky Estacionamento', 5, 3),
          (4, 'Estacioney', 5, 4),
          (5, 'RotaPark', 4, 4);

    INSERT INTO VAGA
    VALUES (1,	'0',	1),
    (2,	'1',	1),
    (3,	'0',	1),
    (4,	'1',	1),
    (5,	'0',	2),
    (6,	'0',	2),
    (7,	'1',	2),
    (8,	'1',	2),
    (9,	'0',	3),
    (10,	'0',	3),
    (11, '1',	3),
    (12,	'0',	3),
    (13,	'0',	3),
    (14,	'1', 4),
    (15,	'1',	4),
    (16,	'1',	4),
    (17,	'1',	4),
    (18,	'1',	4),
    (19,	'0',	5),
    (20,	'0',	5),
    (21,	'1',	5),
    (22,	'0',	5);

    INSERT INTO ALOCA
    VALUES (1,	'HSF0850',	'2021-07-09 12:02:09',	'2021-07-09 15:02:09',	'2021-07-09 15:02:09',	1,	1),
    (2,	'NFB8592',	'2021-07-09 10:26:37',	'2021-07-09 11:26:37',	'2021-07-09 11:26:37',	1,	2),
    (3,	'JQN7059',	'2021-07-09 06:12:22',	'2021-07-09 10:12:22',	'2021-07-09 10:12:22',	1,	3),
    (4,	'MUR6823',	'2021-07-08 09:02:00',	'2021-07-08 11:02:00',	'2021-07-08 11:02:00',	1,	4),
    (5,	'NFA2145',	'2021-07-08 13:02:00',	'2021-07-09 14:02:00',	'2021-07-09 14:02:00',	2,	8),
    (6,	'MXO9426',	'2021-06-18 08:25:28',	'2021-06-18 10:25:28',	'2021-06-18 10:25:28',	2,	5),
    (7,	'NET6883',	'2021-06-21 12:07:11',	'2021-06-21 14:00:00',	'2021-06-21 14:00:00',	2,	7),
    (8,	'NET6883',	'2021-01-12 11:25:38',	'2021-01-12 14:25:38',	'2021-01-12 14:25:38',	2,	6),
    (9,	'KBX2087',	'2021-07-22 10:55:36',	'2021-07-22 11:55:36',	'2021-07-22 11:55:36',	3,	13),
    (10, 'MUO6663',	'2020-12-28 10:11:18',	'2020-12-28 11:11:18',	'2020-12-28 11:11:18',	3,	10),
    (11, 'MWV1941',	'2021-07-15 08:58:46',	'2021-07-15 13:58:46',	'2021-07-15 13:58:46',	3,	11),
    (12, 'KPQ7466',	'2021-09-01 11:49:13',	'2021-09-01 14:49:13',	'2021-09-01 14:49:13',	3,	12),
    (13, 'HWA3740',	'2021-06-10 12:47:39',	'2021-06-10 15:47:00',	'2021-06-10 15:47:00',	3,	9),
    (14, 'MFV9264',	'2021-01-06 08:17:24',	'2021-01-06 18:17:00',	'2021-01-06 18:17:00',	4,	22),
    (15, 'LWL3427',	'2021-04-13 12:51:12',	'2021-04-13 13:51:12',	'2021-04-13 13:51:12',	4,	18),
    (16, 'MXC5240',	'2021-05-26 11:46:08',	'2021-05-26 13:46:08',	'2021-05-27 13:46:08',	4,	17),
    (17, 'MNB3961',	'2021-07-07 10:46:45',	'2021-07-07 18:46:45',	'2021-07-08 17:46:45',	4,	15),
    (18, 'KBW6061',	'2020-09-15 07:40:00',	'2020-09-15 08:40:00',	'2020-09-15 08:40:00',	4,	14),
    (19, 'MUD8981',	'2020-09-29 11:24:53',	'2020-09-29 15:24:53',	'2020-09-29 15:24:53',	4,	21),
    (20, 'HTV5237',	'2021-07-08 07:00:09',	'2021-07-08 09:00:09',	'2021-07-08 09:00:09',	4,	19),
    (21, 'MWW1974',	'2021-08-20 12:35:47',	'2021-08-20 15:35:47',	'2021-08-21 15:35:47',	4,	20),
    (22, 'HZQ1381',	'2021-01-20 09:09:09',	'2021-01-20 10:09:09',	'2021-01-20 10:09:09',	4,	16),
    (23, 'NEO5813',	'2020-11-05 10:05:28',	'2020-11-05 11:05:28',	'2020-11-06 11:05:28',	1,	3),
    (24, 'MXM9004',	'2021-04-06 12:52:04',	'2021-04-06 15:52:04',	'2021-04-06 15:52:04',	2,	5),
    (25, 'NEB0273',	'2021-01-14 10:08:51',	'2021-01-14 15:10:00',	'2021-01-14 15:10:00',	2,	7),
    (26, 'HRJ7052',	'2021-07-15 11:09:52',	'2021-07-15 13:09:52',	'2021-07-15 13:09:52',	3,	10),
    (27, 'MRJ0845',	'2020-12-27 11:11:37',	'2020-12-27 16:11:37',	'2020-12-27 16:11:37',	3,	13),
    (28, 'NBW8056',	'2020-08-23 11:38:03',	'2020-08-23 16:38:03',	'2020-08-23 16:38:03',	2,	8),
    (29, 'HWT2078',	'2020-09-24 08:18:31',	'2020-09-24 10:18:31',	'2020-09-25 10:18:31',	1,	2),
    (30, 'KLQ2773',	'2021-01-23 10:46:06',	'2021-01-23 15:46:06',	'2021-01-24 15:46:06',	2,	5);

    INSERT INTO Bairro
    VALUES (1, 'Jardim da Penha'),
            (2, 'São Pedro'),
            (3, 'Ilha das Caieiras'),
            (4, 'Jardim Camburi'),
            (5, 'Praia do Canto');

    INSERT INTO ENDERECO
    VALUES (1,	'Rua Orácio Cândido dos Santos',	540,	'29047-035',	1,	1),
    (2,	'Travessa Canindé',	345,	'29030-065',	2,	2),
    (3,	'Rua Vista Linda',	781,	'29032-106',	3,	3),
    (4,	'Rua Lucidato Vieira Falcão',	201,	'29027-160',	4,	4),
    (5,	'Travessa do Tabual',	321,	'29050-227',	5,	5);
    
    UPDATE endereco SET idbairro = 1 WHERE idestac = 5;
</p>

### 10.TABELAS E PRINCIPAIS CONSULTAS
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
      
### 11.Gráficos, relatórios, integração com Linguagem de programação e outras solicitações
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
