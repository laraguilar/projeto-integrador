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

  > O Sistema de Estacionamento precisa inicialmente dos seguintes relatórios:
    *Relatório com a quantidade de veículos que utilizaram o estacionamento por dia.
    *Relatório com a quantidade média de horas que os carros costumam definir.
    *Relatório com os horários de maior e menor fluxo de veículos de cada estacionamento, incluindo as seguintes informações: id da empresa, nome do estacionamento, horário de menor fluxo, horário de maior fluxo.
    *Relatório que informe a quantidade de estacionamentos por bairro, com as seguintes informações: nome do bairro e a quantidade de estacionamentos.
    *Relatório de Empresas e Estacionamentos, incluindo as seguintes informações: id da Empresa, id do Estacionamento.

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
  
      CREATE TABLE Empresa (
          idEmpresa int PRIMARY KEY,
          dscCpfCnpj varchar(45) not null,
          Email varchar(45) not null,
          Senha varchar(45) not null
        );

      CREATE TABLE Estacionamento (
          idEstacionamento int PRIMARY KEY,
          NomeEstacionamento varchar(45) not null,
          qtdVagas smallint not null,
          CEP varchar(45),
          Rua varchar(45),
          numRua int,
          fk_Empresa_idEmpresa int,
          fk_Bairro_idBairro int
        );

      CREATE TABLE Vagas (
          idVaga int PRIMARY KEY,
          condVaga bit not null,
          PlacaCarro varchar(45),
          hrEntrada timestamp,
          qtdHrs time,
          HRSaidaPrevista timestamp
        );

      CREATE TABLE Bairro (
          idBairro int PRIMARY KEY,
          dscBairro varchar(45) not null
        );

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

</p>

### 10.TABELAS E PRINCIPAIS CONSULTAS
  #### 10.1 CONSULTAS DAS TABELAS COM TODOS OS DADOS INSERIDOS
      SELECT * FROM empresa
      
      SELECT * FROM estacionamento

      SELECT * FROM bairro
      
      SELECT * FROM vagas 

      SELECT * FROM historico_estacionamento;

      SELECT * FROM vagasHistorico;

  #### 10.2 PRINCIPAIS CONSULTAS DO SISTEMA

### 11.Gráficos, relatórios, integração com Linguagem de programação e outras solicitações
  <p></p>

### 12.Slides e Apresentação em vídeo.
  <p></p>

### OBSERVAÇÕES IMPORTANTES
  
