-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Ago-2021 às 04:54
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_remessa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_acesso`
--

CREATE TABLE `tb_acesso` (
  `acesso_id` int(11) NOT NULL,
  `acesso_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ativo`
--

CREATE TABLE `tb_ativo` (
  `id` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `eam` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `chassi` varchar(70) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cfop`
--

CREATE TABLE `tb_cfop` (
  `id` int(11) NOT NULL,
  `cfop` varchar(20) NOT NULL,
  `descricao` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cfop`
--

INSERT INTO `tb_cfop` (`id`, `cfop`, `descricao`) VALUES
(1, '1908', 'Entrada de bem por conta de contrato de comodato'),
(2, '1909', 'Retorno de bem remetido por conta de contrato de comodato'),
(3, '2909', 'Retorno de bem remetido por conta de contrato de comodato'),
(6, '2908', 'Entrada de bem por conta de contrato de comodato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `id` int(11) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `estado_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`id`, `cidade`, `estado_id`) VALUES
(49, 'BARREIRAS', 257),
(50, 'LUIS EDUARDO MAGALHAES', 257);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(200) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `ie` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  `cep` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`id`, `razao_social`, `nome_fantasia`, `cnpj`, `ie`, `endereco`, `cidade_id`, `cep`) VALUES
(932, 'SLC AGRÍCOLA AAA', 'FAZENDA PANORAMA', '89096457002280', '13213213213', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 49, '47850000'),
(934, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213213213', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, '47850000'),
(935, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213213213', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 49, '47850000'),
(936, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213213213', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, '47850000'),
(937, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(938, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(939, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(940, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(941, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(942, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(943, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(944, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(945, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(946, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(947, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(948, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(949, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(950, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(951, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(952, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(953, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(954, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(955, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(956, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(957, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(958, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(959, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(960, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(961, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(962, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(963, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(964, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(965, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(966, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(967, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(968, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(969, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(970, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(971, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(972, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(973, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(974, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(975, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(976, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(977, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(978, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(979, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(980, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(981, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(982, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(983, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(984, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(985, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(986, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(987, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(988, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(989, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(990, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(991, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(992, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(993, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(994, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(995, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(996, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(997, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(998, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(999, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1000, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1001, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1002, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1003, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1004, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1005, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1006, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1007, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1008, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1009, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1010, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1011, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1012, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1013, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1014, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1015, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1016, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1017, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1018, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1019, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1020, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1021, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1022, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1023, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1024, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1025, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1026, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1027, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1028, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1029, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1030, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1031, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1032, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1033, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1034, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1035, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1036, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1037, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1038, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1039, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1040, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1041, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1042, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1043, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1044, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1045, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1046, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1047, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1048, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1049, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1050, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1051, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1052, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1053, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1054, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1055, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1056, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1057, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1058, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1059, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1060, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1061, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL),
(1062, 'SLC AGRÍCOLA', 'FAZENDA PANORAMA', '89096457002280', '13213132131', 'Fazenda Panorama Slc Agricola S.a. Br 020 Km 67 Zona Rural Correntina BA 47650-000', 50, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estado`
--

CREATE TABLE `tb_estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `sigla` char(14) NOT NULL,
  `pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_estado`
--

INSERT INTO `tb_estado` (`id`, `estado`, `sigla`, `pais_id`) VALUES
(257, 'BAHIA', 'BA', 162),
(260, 'SERGIPE', 'SE', 162),
(261, 'SERGIPE', 'BA', 162),
(262, 'BAHIAa', 'BA', 162),
(263, 'BAHIA', 'BA', 405);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pais`
--

CREATE TABLE `tb_pais` (
  `id` int(11) NOT NULL,
  `pais` varchar(200) NOT NULL,
  `sigla` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_pais`
--

INSERT INTO `tb_pais` (`id`, `pais`, `sigla`) VALUES
(162, 'BRASIL', 'BRA'),
(405, 'ESTADOS UNIDOS DA AMERICA DO NORTE', 'USA'),
(407, 'ESTADOS UNIDOS DA AMERICA DO NORTE', 'USA'),
(408, 'ESTADOS UNIDOS DA AMERICA DO NORTE', 'USA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'Ativo'),
(2, 'Inativo'),
(7, 'Em andamento'),
(8, 'Concluído'),
(9, 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_acesso`
--
ALTER TABLE `tb_acesso`
  ADD PRIMARY KEY (`acesso_id`);

--
-- Índices para tabela `tb_ativo`
--
ALTER TABLE `tb_ativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empresa_id` (`empresa_id`);

--
-- Índices para tabela `tb_cfop`
--
ALTER TABLE `tb_cfop`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado` (`estado_id`);

--
-- Índices para tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cidade` (`cidade_id`);

--
-- Índices para tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pais` (`pais_id`) USING BTREE;

--
-- Índices para tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Índices para tabela `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_acesso`
--
ALTER TABLE `tb_acesso`
  MODIFY `acesso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_ativo`
--
ALTER TABLE `tb_ativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT de tabela `tb_cfop`
--
ALTER TABLE `tb_cfop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1063;

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT de tabela `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_ativo`
--
ALTER TABLE `tb_ativo`
  ADD CONSTRAINT `fk_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `tb_empresa` (`id`);

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado_id`) REFERENCES `tb_estado` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD CONSTRAINT `fk_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `tb_cidade` (`id`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`pais_id`) REFERENCES `tb_pais` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pais_id` FOREIGN KEY (`pais_id`) REFERENCES `tb_pais` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
