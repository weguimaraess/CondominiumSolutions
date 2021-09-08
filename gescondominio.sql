-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jan-2020 às 21:17
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gescondominio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `cod_gestor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`cod_gestor`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `condomino`
--

CREATE TABLE `condomino` (
  `cod_condomino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `condomino`
--

INSERT INTO `condomino` (`cod_condomino`) VALUES
(3),
(4),
(8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `condomino_reuniao`
--

CREATE TABLE `condomino_reuniao` (
  `cod_condomino` int(15) NOT NULL,
  `cod_reuniao` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `edificio`
--

CREATE TABLE `edificio` (
  `cod_edificio` int(15) NOT NULL,
  `numero` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `morada` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cod_gestor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `edificio`
--

INSERT INTO `edificio` (`cod_edificio`, `numero`, `morada`, `cod_gestor`) VALUES
(1, '75', 'Rua feliz - Porto', 1),
(2, '1122', 'Rua da esquina - Gaia', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fracao`
--

CREATE TABLE `fracao` (
  `cod_fracao` int(15) NOT NULL,
  `preco_f` double NOT NULL,
  `andar` int(10) NOT NULL,
  `designacao` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `tipologia` int(11) NOT NULL DEFAULT '1',
  `cod_edificio` int(15) NOT NULL,
  `cod_condomino` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `fracao`
--

INSERT INTO `fracao` (`cod_fracao`, `preco_f`, `andar`, `designacao`, `tipologia`, `cod_edificio`, `cod_condomino`) VALUES
(9, 30, 1, 'Esquerdo', 1, 1, 3),
(11, 40, 2, 'Esquerdo', 1, 1, NULL),
(12, 40, 2, 'Direito', 1, 1, 4),
(13, 25, 1, 'Esquerdo', 1, 2, NULL),
(14, 25, 1, 'Direito', 1, 2, NULL),
(15, 25, 2, 'Esquerdo', 1, 2, NULL),
(16, 25, 2, 'Direito', 1, 2, NULL),
(17, 30, 3, 'Esquerdo', 1, 1, NULL),
(20, 30, 1, 'Direito', 1, 1, 8),
(23, 30, 3, 'Direito', 1, 1, NULL),
(24, 30, 4, 'Esquerdo', 2, 1, NULL),
(26, 40, 4, 'Direito', 3, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod_funcionario` int(15) NOT NULL,
  `nome` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `funcao` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `contacto` varchar(9) COLLATE latin1_general_ci NOT NULL,
  `cod_gestor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cod_funcionario`, `nome`, `funcao`, `contacto`, `cod_gestor`) VALUES
(1, 'José Pascal', 'Encanador', '145474514', 1),
(2, 'Julio', 'Tecnico de Elevador', '456789654', 1),
(3, 'Nuno', 'Zelador', '789874151', 2),
(4, 'Joaquim', 'Tecnico de Elevador', '987789741', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_manutencao`
--

CREATE TABLE `funcionario_manutencao` (
  `cod_funcionario` int(15) NOT NULL,
  `cod_manutencao` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `funcionario_manutencao`
--

INSERT INTO `funcionario_manutencao` (`cod_funcionario`, `cod_manutencao`) VALUES
(1, 1),
(1, 10),
(2, 3),
(2, 7),
(3, 9),
(4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencao`
--

CREATE TABLE `manutencao` (
  `cod_manutencao` int(15) NOT NULL,
  `descricao` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `data_m` date NOT NULL,
  `hora_m` time DEFAULT NULL,
  `cod_edificio` int(15) NOT NULL,
  `estado_manutencao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `manutencao`
--

INSERT INTO `manutencao` (`cod_manutencao`, `descricao`, `data_m`, `hora_m`, `cod_edificio`, `estado_manutencao`) VALUES
(1, 'aaaa', '2020-01-31', '12:04:00', 1, 1),
(2, 'Revisar Elevador', '2020-01-29', '12:00:00', 2, 0),
(3, 'Limpar arrumos', '2020-02-12', '13:45:00', 1, 0),
(7, 'Consertar Elevador', '2020-02-11', '12:00:00', 1, 0),
(9, 'Limpar Arrumos do Prédio', '2020-01-15', '13:00:00', 2, 0),
(10, 'eeeee', '2020-02-20', '11:01:00', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `cod_pagamento` int(15) NOT NULL,
  `preco_tot` double NOT NULL,
  `descricao` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `cod_fracao` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`cod_pagamento`, `preco_tot`, `descricao`, `cod_fracao`) VALUES
(1, 40, 'Taxa do Condominio - Dezembro\r\nTaxa do elevador', 9),
(2, 40, 'Condomínio', 12),
(3, 40, 'Taxa do Condominio - Janeiro\r\nTaxa do elevador', 9),
(6, 55, 'Janeiro - Taxa do Condomínio', 20),
(7, 40, 'zxzxzxzxzx', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recibo`
--

CREATE TABLE `recibo` (
  `cod_recibo` int(15) NOT NULL,
  `data_pag` date NOT NULL,
  `hora_pag` time NOT NULL,
  `pagador` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cod_pagamento` int(15) NOT NULL,
  `cod_gestor` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `recibo`
--

INSERT INTO `recibo` (`cod_recibo`, `data_pag`, `hora_pag`, `pagador`, `cod_pagamento`, `cod_gestor`) VALUES
(1, '2019-12-12', '16:13:07', 'Luís Souza', 1, 1),
(3, '2019-12-29', '15:31:00', 'Jorge Costa', 2, 1),
(5, '2020-01-02', '02:02:00', 'da', 6, 1),
(6, '1111-11-11', '11:11:00', 'dsfds', 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reuniao`
--

CREATE TABLE `reuniao` (
  `cod_reuniao` int(15) NOT NULL,
  `data_r` date NOT NULL,
  `pauta` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `cod_gestor` int(15) NOT NULL,
  `cod_edificio` int(15) NOT NULL,
  `estado_reuniao` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `reuniao`
--

INSERT INTO `reuniao` (`cod_reuniao`, `data_r`, `pauta`, `cod_gestor`, `cod_edificio`, `estado_reuniao`) VALUES
(2, '2020-01-07', 'Troca do porteiro', 2, 2, 0),
(11, '2020-01-02', 'Troca de elevadores', 2, 2, 0),
(13, '2019-12-23', 'Entrega de Água', 1, 1, 1),
(14, '2019-12-25', 'Entrega de prendas', 1, 1, 0),
(18, '2018-03-12', 'teste', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `cod_utilizador` int(11) NOT NULL,
  `nome` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `contacto` varchar(9) COLLATE latin1_general_ci NOT NULL,
  `login` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `passe` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `nivel_acesso` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`cod_utilizador`, `nome`, `contacto`, `login`, `passe`, `nivel_acesso`) VALUES
(1, 'Wendel', '123456789', 'wendel', '12345678', 1),
(2, 'Rui', '987654321', 'rui', '87654321', 1),
(3, 'Joao', '444555666', 'joao456', '456joao', 0),
(4, 'Manoel', '865478999', 'manoel', '123manoel', 0),
(8, 'Juca', '123456321', 'juca123', '123juca', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`cod_gestor`);

--
-- Indexes for table `condomino`
--
ALTER TABLE `condomino`
  ADD PRIMARY KEY (`cod_condomino`);

--
-- Indexes for table `condomino_reuniao`
--
ALTER TABLE `condomino_reuniao`
  ADD KEY `cod_condomino` (`cod_condomino`),
  ADD KEY `cod_reuniao` (`cod_reuniao`);

--
-- Indexes for table `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`cod_edificio`),
  ADD KEY `cod_gestor` (`cod_gestor`) USING BTREE;

--
-- Indexes for table `fracao`
--
ALTER TABLE `fracao`
  ADD PRIMARY KEY (`cod_fracao`),
  ADD KEY `cod_edificio` (`cod_edificio`),
  ADD KEY `cod_condomino` (`cod_condomino`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cod_funcionario`),
  ADD KEY `cod_gestor` (`cod_gestor`) USING BTREE;

--
-- Indexes for table `funcionario_manutencao`
--
ALTER TABLE `funcionario_manutencao`
  ADD PRIMARY KEY (`cod_funcionario`,`cod_manutencao`),
  ADD KEY `cod_manutencao` (`cod_manutencao`);

--
-- Indexes for table `manutencao`
--
ALTER TABLE `manutencao`
  ADD PRIMARY KEY (`cod_manutencao`),
  ADD KEY `cod_edificio` (`cod_edificio`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`cod_pagamento`),
  ADD UNIQUE KEY `UK_DescUnique` (`descricao`),
  ADD KEY `cod_fracao` (`cod_fracao`);

--
-- Indexes for table `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`cod_recibo`),
  ADD KEY `cod_gestor` (`cod_gestor`),
  ADD KEY `cod_pagamento` (`cod_pagamento`);

--
-- Indexes for table `reuniao`
--
ALTER TABLE `reuniao`
  ADD PRIMARY KEY (`cod_reuniao`),
  ADD KEY `cod_gestor` (`cod_gestor`),
  ADD KEY `cod_edificio` (`cod_edificio`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`cod_utilizador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edificio`
--
ALTER TABLE `edificio`
  MODIFY `cod_edificio` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fracao`
--
ALTER TABLE `fracao`
  MODIFY `cod_fracao` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cod_funcionario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manutencao`
--
ALTER TABLE `manutencao`
  MODIFY `cod_manutencao` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `cod_pagamento` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recibo`
--
ALTER TABLE `recibo`
  MODIFY `cod_recibo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reuniao`
--
ALTER TABLE `reuniao`
  MODIFY `cod_reuniao` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `cod_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`cod_gestor`) REFERENCES `utilizador` (`cod_utilizador`),
  ADD CONSTRAINT `administrador_ibfk_2` FOREIGN KEY (`cod_gestor`) REFERENCES `utilizador` (`cod_utilizador`),
  ADD CONSTRAINT `administrador_ibfk_3` FOREIGN KEY (`cod_gestor`) REFERENCES `utilizador` (`cod_utilizador`);

--
-- Limitadores para a tabela `condomino`
--
ALTER TABLE `condomino`
  ADD CONSTRAINT `condomino_ibfk_1` FOREIGN KEY (`cod_condomino`) REFERENCES `utilizador` (`cod_utilizador`),
  ADD CONSTRAINT `condomino_ibfk_2` FOREIGN KEY (`cod_condomino`) REFERENCES `utilizador` (`cod_utilizador`);

--
-- Limitadores para a tabela `condomino_reuniao`
--
ALTER TABLE `condomino_reuniao`
  ADD CONSTRAINT `condomino_reuniao_ibfk_1` FOREIGN KEY (`cod_condomino`) REFERENCES `condomino` (`cod_condomino`),
  ADD CONSTRAINT `condomino_reuniao_ibfk_2` FOREIGN KEY (`cod_reuniao`) REFERENCES `reuniao` (`cod_reuniao`);

--
-- Limitadores para a tabela `edificio`
--
ALTER TABLE `edificio`
  ADD CONSTRAINT `edificio_ibfk_1` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`),
  ADD CONSTRAINT `edificio_ibfk_2` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`);

--
-- Limitadores para a tabela `fracao`
--
ALTER TABLE `fracao`
  ADD CONSTRAINT `fracao_ibfk_1` FOREIGN KEY (`cod_edificio`) REFERENCES `edificio` (`cod_edificio`),
  ADD CONSTRAINT `fracao_ibfk_2` FOREIGN KEY (`cod_condomino`) REFERENCES `condomino` (`cod_condomino`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`),
  ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`);

--
-- Limitadores para a tabela `funcionario_manutencao`
--
ALTER TABLE `funcionario_manutencao`
  ADD CONSTRAINT `funcionario_manutencao_ibfk_1` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionario` (`cod_funcionario`),
  ADD CONSTRAINT `funcionario_manutencao_ibfk_2` FOREIGN KEY (`cod_manutencao`) REFERENCES `manutencao` (`cod_manutencao`);

--
-- Limitadores para a tabela `manutencao`
--
ALTER TABLE `manutencao`
  ADD CONSTRAINT `manutencao_ibfk_1` FOREIGN KEY (`cod_edificio`) REFERENCES `edificio` (`cod_edificio`);

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`cod_fracao`) REFERENCES `fracao` (`cod_fracao`);

--
-- Limitadores para a tabela `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `recibo_ibfk_2` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`),
  ADD CONSTRAINT `recibo_ibfk_3` FOREIGN KEY (`cod_pagamento`) REFERENCES `pagamento` (`cod_pagamento`);

--
-- Limitadores para a tabela `reuniao`
--
ALTER TABLE `reuniao`
  ADD CONSTRAINT `reuniao_ibfk_1` FOREIGN KEY (`cod_gestor`) REFERENCES `administrador` (`cod_gestor`),
  ADD CONSTRAINT `reuniao_ibfk_4` FOREIGN KEY (`cod_edificio`) REFERENCES `edificio` (`cod_edificio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
