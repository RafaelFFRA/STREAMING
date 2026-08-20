-- Active: 1773265493505@@127.0.0.1@3306@mysql
-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para streaming
CREATE DATABASE IF NOT EXISTS `streaming` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `streaming`;


-- Copiando estrutura para tabela streaming.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Senha do usuário',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'E-mail do usuário',
  `aniversario` DATE CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Data de Nascimento do Usuário',
  `tipo_usuario` enum('Administrador','Distribuidor','Cliente') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tipo de usuário: Administrador; Distribuidor e Cliente',
  `id_usuario` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador de usuário',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.usuario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela streaming.administrador
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_administrador` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador do administrador',
  `nome_admin` varchar(100) NOT NULL COMMENT 'Nome do administrador',
  `FK_administrador_id_usuario` int NOT NULL COMMENT 'ID identificador do usuário',
  PRIMARY KEY (`id_administrador`),
  UNIQUE KEY `id_usuario` (`FK_administrador_id_usuario`) USING BTREE,
  CONSTRAINT `` FOREIGN KEY (`FK_administrador_id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.administrador: ~0 rows (aproximadamente)

- Copiando estrutura para tabela streaming.cliente

CREATE TABLE IF NOT EXISTS `cliente` (
  `nome_cliente` varchar(100) NOT NULL COMMENT 'Nome do cliente',
  `cpf_cliente` varchar(14) NOT NULL COMMENT 'CPF do cliente',
  `status_conta_cliente` enum('Ativo','Inativo','Suspenso') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Status da conta do Cliente: Ativo; Inativo; Suspenso',
  `FK_cliente_id_cliente` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador do cliente',
  `FK_cliente_id_usuario` int NOT NULL COMMENT 'ID identificador do usuário',
  PRIMARY KEY (`FK_cliente_id_cliente`) USING BTREE,
  UNIQUE KEY `cpf_cliente` (`cpf_cliente`),
  UNIQUE KEY `id_usuario` (`FK_cliente_id_usuario`) USING BTREE,
  CONSTRAINT `FK_cliente_usuario` FOREIGN KEY (`FK_cliente_id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.cliente: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela streaming.assinatura
CREATE TABLE IF NOT EXISTS `assinatura` (
  `id_assinatura` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador da assinatura',
  `tipo_plano_assinatura` enum('Anual','Mensal') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tipo do plano de assinatura',
  `data_inicio_assinatura` date NOT NULL COMMENT 'Data de início da assinatura',
  `data_fim_assinatura` date NOT NULL COMMENT 'Data de fim da assinatura',
  `status_assinatura` enum('Ativa','Inativa') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Status da Assinatura: Ativa; Inativa',
  `forma_pagamento_assinatura` enum('Cartão','Boleto','Pix') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Forma de pagamento da Assinatura: Cartão; Boleto; Pix',
  `FK_assinatura_id_cliente` int NOT NULL COMMENT 'ID identificador do cliente',
  PRIMARY KEY (`id_assinatura`),
  KEY `FK_assinatura_cliente` (`FK_assinatura_id_cliente`) USING BTREE,
  CONSTRAINT `FK_assinatura_cliente` FOREIGN KEY (`FK_assinatura_id_cliente`) REFERENCES `cliente` (`FK_cliente_id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.assinatura: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela streaming.avaliacao


-- Copiando dados para a tabela streaming.avaliacao: ~0 rows (aproximadamente)

CREATE TABLE IF NOT EXISTS `distribuidor` (
  `id_distribuidor` int NOT NULL AUTO_INCREMENT,
  `empresa_distribuidor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cnpj_empresa_distribuidor` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thumb_conteudo` varchar(255) NOT NULL COMMENT 'Caminho da thumbnail',
  `video_conteudo` varchar(255) NOT NULL COMMENT 'Caminho do arquivo de vídeo',
  `FK_distribuidor_id_usuario` int NOT NULL,
  PRIMARY KEY (`id_distribuidor`),
  UNIQUE KEY `cnpj_empresa_distribuidor` (`cnpj_empresa_distribuidor`),
  UNIQUE KEY `id_usuario` (`FK_distribuidor_id_usuario`) USING BTREE,
  CONSTRAINT `FK_distribuidor_usuario` FOREIGN KEY (`FK_distribuidor_id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.distribuidor: ~0 rows (aproximadamente)


-

-- Copiando estrutura para tabela streaming.conteudo
CREATE TABLE IF NOT EXISTS `conteudo` (
  `id_conteudo` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador do conteúdo',
  `titulo_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Título do conteúdo',
  `sinopse_conteudo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Sinopse do conteúdo',
  `elenco_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Elenco do conteúdo',
  `diretores_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Diretores do conteúdo',
  `genero_conteudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Genêro do conteúdo',
  `classe_etaria_conteudo` int NOT NULL COMMENT 'Classe etária do conteúdo:',
  `janela_exib_inicio_conteudo` date NOT NULL COMMENT 'Janela de exibição do conteúdo: Início',
  `janela_exib_fim_conteudo` date NOT NULL COMMENT 'Janela de exibição do conteúdo: Fim',
  `FK_conteudo_id_distribuidor` int NOT NULL COMMENT 'ID identificador do distribuidor',
  PRIMARY KEY (`id_conteudo`),
  KEY `FK_conteudo_distribuidor` (`FK_conteudo_id_distribuidor`) USING BTREE,
  CONSTRAINT `FK_conteudo_distribuidor` FOREIGN KEY (`FK_conteudo_id_distribuidor`) REFERENCES `distribuidor` (`id_distribuidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_avaliacao` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador da avaliação ',
  `comentario_avaliacao` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Comentário da avaliação feita pelo cliente',
  `relevante_avaliacao` tinyint NOT NULL DEFAULT (0) COMMENT 'Relevância da avaliação, 0: Irrelevante / 1: Relevante',
  `FK_avaliacao_id_cliente` int NOT NULL COMMENT 'ID identificador do cliente',
  `FK_avaliacao_id_conteudo` int NOT NULL COMMENT 'ID identificador do conteudo',
  PRIMARY KEY (`id_avaliacao`),
  KEY `FK_avaliacao_cliente` (`FK_avaliacao_id_cliente`) USING BTREE,
  KEY `FK_avaliacao_conteudo` (`FK_avaliacao_id_conteudo`) USING BTREE,
  CONSTRAINT `FK_avaliacao_cliente` FOREIGN KEY (`FK_avaliacao_id_cliente`) REFERENCES `cliente` (`FK_cliente_id_cliente`),
  CONSTRAINT `FK_avaliacao_conteudo` FOREIGN KEY (`FK_avaliacao_id_conteudo`) REFERENCES `conteudo` (`id_conteudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela streaming.conteudo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela streaming.distribuidor

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
