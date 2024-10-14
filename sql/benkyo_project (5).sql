-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 14-Out-2024 às 11:27
-- Versão do servidor: 5.7.25
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benkyo_project`
--
CREATE DATABASE IF NOT EXISTS `benkyo_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `benkyo_project`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE `atividade` (
  `idAtividade` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `descricaoAtividade` varchar(255) NOT NULL,
  `tipoAtividade` enum('Comemorativa','Esportes','Estudos','Outros') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`idAtividade`, `idUsuario`, `descricaoAtividade`, `tipoAtividade`) VALUES
(6, 25, 'festa de aniversario', 'Comemorativa'),
(7, 25, 'Atletismo', 'Esportes'),
(8, 25, 'Matematica', 'Estudos'),
(9, 25, 'Volei', 'Esportes'),
(10, 25, 'Preparação', 'Estudos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idAtividade` int(11) NOT NULL,
  `dataEvento` date NOT NULL,
  `horaEvento` time NOT NULL,
  `localEvento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `evento`
--

INSERT INTO `evento` (`idEvento`, `idUsuario`, `idAtividade`, `dataEvento`, `horaEvento`, `localEvento`) VALUES
(3, 25, 9, '2024-09-25', '18:45:00', 'Minha Casa'),
(4, 25, 9, '2024-09-17', '20:00:00', 'São Paulo'),
(5, 25, 7, '2024-09-09', '05:54:00', 'escola'),
(6, 25, 10, '2024-10-04', '13:20:00', 'IF'),
(7, 25, 10, '2024-10-04', '13:20:00', 'IF'),
(8, 25, 10, '2024-10-04', '13:20:00', 'IF'),
(9, 25, 6, '2024-09-16', '23:34:00', 'Minha Casa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `rb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `rb`) VALUES
(25, 'GAMERBR', 'victor@gmail.com', '123', ''),
(26, 'kawachi', 'kawachi@gmail.com', '123', ''),
(27, 'teste', 'limasT@gmail.com', '$2y$10$H1QoxvRbIMHkxxaRDhjpoeuw7nJfcYhTdOQDQSlD0zI1bnnyQgZIK', 'issao123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`idAtividade`),
  ADD KEY `fk_atividade_usuario` (`idUsuario`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_evento_usuario` (`idUsuario`),
  ADD KEY `fk_evento_atividade` (`idAtividade`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `idAtividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `fk_atividade_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_atividade` FOREIGN KEY (`idAtividade`) REFERENCES `atividade` (`idAtividade`),
  ADD CONSTRAINT `fk_evento_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
