-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_biblioteca
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adm_users`
--

DROP TABLE IF EXISTS `adm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_users` (
  `id_adm` int NOT NULL AUTO_INCREMENT,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `sobrenome` varchar(20) DEFAULT NULL,
  `sexo` char(3) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `ddd` int DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_users`
--

LOCK TABLES `adm_users` WRITE;
/*!40000 ALTER TABLE `adm_users` DISABLE KEYS */;
INSERT INTO `adm_users` VALUES (1,1,'Andre','Reis','Mas','2000-09-06','Sertaozinho','adminMaster','admin@0906','andretritolareis@gmail.com',16,982115894),(2,1,'Bethanny','Santiago','Fem','2000-01-07','Sertãozinho','adminBeth','beth@2000','bethmail@gmail.com',16,961727214),(3,0,'Teste','Testador','N.E','2020-07-09','Testadora','admTeste','adm@0906','testes@hotmail.com',16,999999999),(6,0,'Maria','Ferreira','Fem','1989-01-01','Ribeirao Preto','adminMaria','admin@mf559','mf_ribs@gmail.com',16,34456781);
/*!40000 ALTER TABLE `adm_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alunos` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `ativo` bit(1) DEFAULT NULL,
  `cod_aluno` int DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `sobrenome` varchar(30) DEFAULT NULL,
  `sexo` varchar(5) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `curso` varchar(40) DEFAULT NULL,
  `serie` int DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `ddd` int DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `total_livros` int DEFAULT NULL,
  `total_atrasos` int DEFAULT NULL,
  `total_multa` double DEFAULT NULL,
  `multa_passiva` float DEFAULT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES (1,_binary '',1234567,'Kleber','Silva','N.E','1998-02-25','Ribeirão Preto','Gastronomia',2,'klebersantos@gmail.com',16,982567715,'123456789',0,0,7.5,7.5),(2,_binary '',1887960,'André','Reis','Mas','2000-09-06','Sertãozinho','Ciências da Computação',1,'andretritolareis@gmail.com',16,982115894,'andre12345',1,1,12.5,0),(3,_binary '',1113450,'Marcela','Santos','Fem','2001-04-17','Ribeirão Preto','Biologia',1,'marcelas@gmail.com',16,985568722,'marcelinha',0,0,0,0),(4,_binary '',1111111,'Edgar','Junior','Mas','2000-01-11','Serrana','Gastronomia',1,'Edgarj@hotmail.com',16,988765432,'123456789',3,1,15,0),(5,_binary '',743524,'Cleide','Reis','Fem','1963-09-03','Sertaozinho','Administracao',1,'leop@terra.com.br',16,981179196,'123456789',0,0,0,0),(7,_binary '',9876543,'Jessica','Campbell','Fem','2000-07-09','Sertaozinho','Medicina',1,'jessica_med2020@gmail.com',16,997653421,'123456789',0,0,0,0),(8,_binary '\0',9992222,'Jainna','Cecilia','N.E','2000-09-06','Sertaozinho','Gastronomia',2,'testeteste@gmail.com',16,999999999,'987654321',0,0,0,0),(10,_binary '',5567822,'Lucas','Santiago','Mas','1990-07-07','Campinas','Gastronomia',3,'santiago12@gmail.com',16,954231111,'123456789',0,0,0,0),(12,_binary '',2222211,'Yancha','Nagai','N.E','1998-06-21','Cravinhos','Biomedicina',1,'y_n@hotmail.com',16,34456767,'123456789',0,0,0,NULL);
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens` (
  `id_item` int NOT NULL AUTO_INCREMENT,
  `ativo` tinyint(1) DEFAULT NULL,
  `id_livro` int DEFAULT NULL,
  `_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
INSERT INTO `itens` VALUES (3,1,5,_binary '\0'),(4,1,1,_binary '\0'),(5,1,1,_binary ''),(7,1,8,_binary '\0'),(8,1,8,_binary '\0'),(9,0,8,_binary '');
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id_livro` int NOT NULL AUTO_INCREMENT,
  `ativo` bit(1) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `editora` varchar(50) DEFAULT NULL,
  `ano_edicao` int DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_livro`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,_binary '','Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017','James Stewart','Cengage Learning',2018,999,'Matematica'),(5,_binary '','A Origem Das Espécies - Edição Ilustrada','Charles Darwin','Martin Claret',2014,574,'Biologia'),(8,_binary '','A Segunda Guerra Mundial - Os 2.174 Dias Que Mudaram o Mundo','Martin Gilbert','Casa Da Palavra',2014,976,'História');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saidas`
--

DROP TABLE IF EXISTS `saidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saidas` (
  `id_saida` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `sobrenome` varchar(20) DEFAULT NULL,
  `id_item` int DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `_status` bit(1) DEFAULT NULL,
  `data_saida` date DEFAULT NULL,
  `data_limite` date DEFAULT NULL,
  `data_retorno` date DEFAULT NULL,
  `dias_atraso` int DEFAULT NULL,
  PRIMARY KEY (`id_saida`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saidas`
--

LOCK TABLES `saidas` WRITE;
/*!40000 ALTER TABLE `saidas` DISABLE KEYS */;
INSERT INTO `saidas` VALUES (7,2,'André','Reis',1,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-17','2020-07-15','2020-07-17',10),(9,1,'Kleber','Silva',1,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-17','2020-07-31','2020-07-17',6),(10,1,'Kleber','Silva',1,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-17','2020-07-31','2020-07-17',6),(11,2,'André','Reis',1,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-17','2020-07-31','2020-07-17',10),(12,1,'Kleber','Silva',1,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-18','2020-08-01','2020-07-18',6),(15,3,'Marcela','Santos',4,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-18','2020-08-01','2020-07-18',0),(16,1,'Kleber','Silva',4,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-18','2020-08-01','2020-07-18',6),(17,1,'Kleber','Silva',4,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-18','2020-08-01','2020-07-18',6),(18,1,'Kleber','Silva',4,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '','2020-07-18','2020-08-01','2020-07-18',6),(19,2,'André','Reis',4,'Cálculo - Vol. 1 - Tradução da 8ª Edição Norte-Americana 2017',_binary '\0','2020-07-19','2020-07-10',NULL,10),(20,4,'Edgar','Junior',3,'A Origem Das Espécies - Edição Ilustrada',_binary '','2020-07-20','2020-08-03','2020-07-20',0),(22,4,'Edgar','Junior',3,'A Origem Das Espécies - Edição Ilustrada',_binary '','2020-07-20','2020-08-03','2020-07-20',0),(23,4,'Edgar','Junior',3,'A Origem Das Espécies - Edição Ilustrada',_binary '\0','2020-07-20','2020-08-03',NULL,0),(24,4,'Edgar','Junior',7,'A Segunda Guerra Mundial - Os 2.174 Dias Que Mudaram o Mundo',_binary '\0','2020-07-20','2020-07-08',NULL,12),(25,4,'Edgar','Junior',8,'A Segunda Guerra Mundial - Os 2.174 Dias Que Mudaram o Mundo',_binary '\0','2020-07-20','2020-08-03',NULL,0);
/*!40000 ALTER TABLE `saidas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-20 16:32:57
