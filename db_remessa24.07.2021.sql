-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jul-2021 às 05:33
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
-- Estrutura da tabela `tb_ativos`
--

CREATE TABLE `tb_ativos` (
  `id` int(11) NOT NULL,
  `Item_ri` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `eam` int(11) NOT NULL,
  `chassi` varchar(200) NOT NULL,
  `numero` int(11) NOT NULL,
  `placa` varchar(100) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(46, 'ACRE', 'AC', 162),
(47, 'ALAGOAS', 'AL', 162),
(48, 'AMAPÁ', 'AP', 162),
(49, 'AMAZONAS', 'AM', 162),
(50, 'BAHIA', 'BA', 162),
(51, 'CEARÁ', 'CE', 162),
(52, 'ESPÍRITO SANTO', 'ES', 162),
(53, 'GOIÁS', 'GO', 162),
(54, 'MARANHÃO', 'MA', 162),
(55, 'MATO GROSSO', 'MT', 162),
(56, 'MATO GROSSO DO SUL', 'MS', 162),
(57, 'PARÁ', 'PA', 162),
(58, 'PARAÍBA', 'PB', 162),
(59, 'PARANÁ', 'PR', 162),
(60, 'PERNAMBUCO', 'PE', 162),
(61, 'PIAUÍ', 'PI', 162),
(62, 'RIO DE JANEIRO', 'RJ', 162),
(63, 'RIO GRANDE DO NORTE', 'RN', 162),
(64, 'RIO GRANDE DO SUL', 'RS', 162),
(65, 'RONDÔNIA', 'RO', 162),
(66, 'RORAIMA', 'RR', 162),
(67, 'SANTA CATARINA', 'SC', 162),
(68, 'SÃO PAULO', 'SP', 162),
(69, 'SERGIPE', 'SE', 162),
(70, 'TOCANTINS', 'TO', 162),
(71, 'DISTRITO FEDERAL', 'DF', 162),
(73, 'MINAS GERAIS', 'MG', 162),
(74, 'ACRE', 'AC', 162),
(75, 'ALAGOAS', 'AL', 162),
(76, 'AMAPÁ', 'AP', 162),
(77, 'AMAZONAS', 'AM', 162),
(78, 'BAHIA', 'BA', 162),
(79, 'CEARÁ', 'CE', 162),
(80, 'ESPÍRITO SANTO', 'ES', 162),
(81, 'GOIÁS', 'GO', 162),
(82, 'MARANHÃO', 'MA', 162),
(83, 'MATO GROSSO', 'MT', 162),
(84, 'MATO GROSSO DO SUL', 'MS', 162),
(85, 'PARÁ', 'PA', 162),
(86, 'PARAÍBA', 'PB', 162),
(87, 'PARANÁ', 'PR', 162),
(88, 'PERNAMBUCO', 'PE', 162),
(89, 'PIAUÍ', 'PI', 162),
(90, 'RIO DE JANEIRO', 'RJ', 162),
(91, 'RIO GRANDE DO NORTE', 'RN', 162),
(92, 'RIO GRANDE DO SUL', 'RS', 162),
(93, 'RONDÔNIA', 'RO', 162),
(94, 'RORAIMA', 'RR', 162),
(95, 'SANTA CATARINA', 'SC', 162),
(96, 'SÃO PAULO', 'SP', 162),
(97, 'SERGIPE', 'SE', 162),
(98, 'TOCANTINS', 'TO', 162),
(99, 'DISTRITO FEDERAL', 'DF', 162),
(100, 'MINAS GERAIS', 'MG', 162),
(101, 'ACRE', 'AC', 162),
(102, 'ALAGOAS', 'AL', 162),
(103, 'AMAPÁ', 'AP', 162),
(104, 'AMAZONAS', 'AM', 162),
(105, 'BAHIA', 'BA', 162),
(106, 'CEARÁ', 'CE', 162),
(107, 'ESPÍRITO SANTO', 'ES', 162),
(108, 'GOIÁS', 'GO', 162),
(109, 'MARANHÃO', 'MA', 162),
(110, 'MATO GROSSO', 'MT', 162),
(111, 'MATO GROSSO DO SUL', 'MS', 162),
(112, 'PARÁ', 'PA', 162),
(113, 'PARAÍBA', 'PB', 162),
(114, 'PARANÁ', 'PR', 162),
(115, 'PERNAMBUCO', 'PE', 162),
(116, 'PIAUÍ', 'PI', 162),
(117, 'RIO DE JANEIRO', 'RJ', 162),
(118, 'RIO GRANDE DO NORTE', 'RN', 162),
(119, 'RIO GRANDE DO SUL', 'RS', 162),
(120, 'RONDÔNIA', 'RO', 162),
(121, 'RORAIMA', 'RR', 162),
(122, 'SANTA CATARINA', 'SC', 162),
(123, 'SÃO PAULO', 'SP', 162),
(124, 'SERGIPE', 'SE', 162),
(125, 'TOCANTINS', 'TO', 162),
(126, 'DISTRITO FEDERAL', 'DF', 162),
(127, 'MINAS GERAIS', 'MG', 162),
(128, 'ACRE', 'AC', 162),
(129, 'ALAGOAS', 'AL', 162),
(130, 'AMAPÁ', 'AP', 162),
(131, 'AMAZONAS', 'AM', 162),
(132, 'BAHIA', 'BA', 162),
(133, 'CEARÁ', 'CE', 162),
(134, 'ESPÍRITO SANTO', 'ES', 162),
(135, 'GOIÁS', 'GO', 162),
(136, 'MARANHÃO', 'MA', 162),
(137, 'MATO GROSSO', 'MT', 162),
(138, 'MATO GROSSO DO SUL', 'MS', 162),
(139, 'PARÁ', 'PA', 162),
(140, 'PARAÍBA', 'PB', 162),
(141, 'PARANÁ', 'PR', 162),
(142, 'PERNAMBUCO', 'PE', 162),
(143, 'PIAUÍ', 'PI', 162),
(144, 'RIO DE JANEIRO', 'RJ', 162),
(145, 'RIO GRANDE DO NORTE', 'RN', 162),
(146, 'RIO GRANDE DO SUL', 'RS', 162),
(147, 'RONDÔNIA', 'RO', 162),
(148, 'RORAIMA', 'RR', 162),
(149, 'SANTA CATARINA', 'SC', 162),
(150, 'SÃO PAULO', 'SP', 162),
(151, 'SERGIPE', 'SE', 162),
(152, 'TOCANTINS', 'TO', 162),
(153, 'DISTRITO FEDERAL', 'DF', 162),
(154, 'MINAS GERAIS', 'MG', 162),
(155, 'ACRE', 'AC', 162),
(156, 'ALAGOAS', 'AL', 162),
(157, 'AMAPÁ', 'AP', 162),
(158, 'AMAZONAS', 'AM', 162),
(159, 'BAHIA', 'BA', 162),
(160, 'CEARÁ', 'CE', 162),
(161, 'ESPÍRITO SANTO', 'ES', 162),
(162, 'GOIÁS', 'GO', 162),
(163, 'MARANHÃO', 'MA', 162),
(164, 'MATO GROSSO', 'MT', 162),
(165, 'MATO GROSSO DO SUL', 'MS', 162),
(166, 'PARÁ', 'PA', 162),
(167, 'PARAÍBA', 'PB', 162),
(168, 'PARANÁ', 'PR', 162),
(169, 'PERNAMBUCO', 'PE', 162),
(170, 'PIAUÍ', 'PI', 162),
(171, 'RIO DE JANEIRO', 'RJ', 162),
(172, 'RIO GRANDE DO NORTE', 'RN', 162),
(173, 'RIO GRANDE DO SUL', 'RS', 162),
(174, 'RONDÔNIA', 'RO', 162),
(175, 'RORAIMA', 'RR', 162),
(176, 'SANTA CATARINA', 'SC', 162),
(177, 'SÃO PAULO', 'SP', 162),
(178, 'SERGIPE', 'SE', 162),
(179, 'TOCANTINS', 'TO', 162),
(180, 'DISTRITO FEDERAL', 'DF', 162),
(181, 'MINAS GERAIS', 'MG', 162);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pais`
--

CREATE TABLE `tb_pais` (
  `pais_id` int(11) NOT NULL,
  `pais_nome` varchar(200) NOT NULL,
  `pais_sigla` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_pais`
--

INSERT INTO `tb_pais` (`pais_id`, `pais_nome`, `pais_sigla`) VALUES
(162, 'BRASIL', 'BRA'),
(183, 'ESTADOS UNIDOS DA AMERICA', 'USA');

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
-- Índices para tabela `tb_ativos`
--
ALTER TABLE `tb_ativos`
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
  ADD KEY `fk_cidade` (`cidade_id`),
  ADD KEY `fk_status_id` (`status_id`);

--
-- Índices para tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pais` (`pais_id`);

--
-- Índices para tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  ADD PRIMARY KEY (`pais_id`),
  ADD UNIQUE KEY `pais_id` (`pais_id`);

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
-- AUTO_INCREMENT de tabela `tb_ativos`
--
ALTER TABLE `tb_ativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_cfop`
--
ALTER TABLE `tb_cfop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de tabela `tb_pais`
--
ALTER TABLE `tb_pais`
  MODIFY `pais_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

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
-- Limitadores para a tabela `tb_ativos`
--
ALTER TABLE `tb_ativos`
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
  ADD CONSTRAINT `fk_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `tb_cidade` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `status_id` FOREIGN KEY (`id`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`pais_id`) REFERENCES `tb_pais` (`pais_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
