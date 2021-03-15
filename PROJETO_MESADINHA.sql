create database PROJETO_MESADINHA;
use PROJETO_MESADINHA;

CREATE TABLE USUARIO(
ID INT unsigned auto_increment NOT NULL primary key,
NOME VARCHAR(80) NOT NULL,
EMAIL VARCHAR(100) NOT NULL,
SENHA VARCHAR(150) NOT NULL,
ENDERECO VARCHAR(150),
TELEFONE VARCHAR(15)
)ENGINE=INNODB;

CREATE TABLE CATEGORIAS(
ID int unsigned auto_increment NOT NULL primary key,
NOME varchar(200) NOT NULL
)ENGINE=INNODB;


CREATE TABLE CONTAS(
ID int unsigned auto_increment NOT NULL primary key,
NOME VARCHAR(150) NOT NULL,
TIPO_CONTA VARCHAR(80) NOT NULL,
ID_CATEGORIAS int unsigned NOT NULL,
FOREIGN KEY(ID_CATEGORIAS) REFERENCES CATEGORIAS(ID)
)ENGINE=INNODB;

CREATE TABLE MOVIMENTACAO(
ID int unsigned auto_increment NOT NULL primary key,
VALOR_MOVI double(9,2) unsigned NOT NULL,
DATA DATE NOT NULL,
ID_CONTA int unsigned NOT NULL,
FOREIGN KEY(ID_CONTA) REFERENCES CONTAS(ID)
)ENGINE=INNODB;

-- update CONTAS set nome = 'Portoes', tipo_conta = 'Receitas', id_categorias = '6' where id = '1';

-- select * from USUARIO;
-- select * from movimentacao;

-- insert into MOVIMENTACAO(ID,VALOR_MOVI,DATA,ID_CONTA) values(null,'1234','2020/11/25','1');
-- select * from CATEGORIAS;

-- update CATEGORIAS set nome = 'Carro2' where id = '9';

-- select * from movimentacao;

-- select * from categorias;

-- CONTAS.ID, CONTAS.NOME, CONTAS.TIPO_CONTA, CATEGORIAS.NOME AS CATEGORIAS from CATEGORIAS join CONTAS on CATEGORIAS.ID = CONTAS.ID_CATEGORIAS;


