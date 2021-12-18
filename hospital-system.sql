-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Dez-2021 às 13:34
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hospital-system`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'ADM', 'adm@email.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name_doctor` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(32) NOT NULL,
  `crm` int(11) NOT NULL,
  `cpf` varchar(150) NOT NULL,
  `cellphone` varchar(150) NOT NULL,
  `born_register` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `cep` varchar(150) NOT NULL,
  `citty` varchar(50) NOT NULL,
  `street` varchar(150) NOT NULL,
  `number` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

CREATE TABLE `exames` (
  `id` int(11) NOT NULL,
  `id_exame` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `hour` varchar(125) NOT NULL,
  `released` int(1) NOT NULL DEFAULT 0,
  `id_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exame_type`
--

CREATE TABLE `exame_type` (
  `id` int(11) NOT NULL,
  `name_exame` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `exame_type`
--

INSERT INTO `exame_type` (`id`, `name_exame`) VALUES
(1, 'Hemograma'),
(2, 'Urina'),
(3, 'Raio X');

-- --------------------------------------------------------

--
-- Estrutura da tabela `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `name_lead` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(32) NOT NULL,
  `cellphone` varchar(32) NOT NULL,
  `born_register` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `cep` varchar(32) NOT NULL,
  `citty` varchar(32) NOT NULL,
  `street` varchar(32) NOT NULL,
  `number` varchar(11) NOT NULL,
  `district` varchar(32) NOT NULL,
  `id_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name_patient` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(32) NOT NULL,
  `cpf` varchar(150) NOT NULL,
  `cellphone` varchar(150) NOT NULL,
  `born_register` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `cep` varchar(150) NOT NULL,
  `citty` varchar(50) NOT NULL,
  `street` varchar(150) NOT NULL,
  `number` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  `id_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plains`
--

CREATE TABLE `plains` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plains`
--

INSERT INTO `plains` (`id`, `name`, `price`) VALUES
(1, 'Plano Pessoal I', '9.99'),
(2, 'Plano Pessoal II', '9.99'),
(3, 'Plano Pessoal III', '9.99');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plain_descriptions`
--

CREATE TABLE `plain_descriptions` (
  `id` int(11) NOT NULL,
  `id_plain` int(11) NOT NULL,
  `description` char(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `plain_descriptions`
--

INSERT INTO `plain_descriptions` (`id`, `id_plain`, `description`) VALUES
(1, 1, 'loren ipsun'),
(2, 1, 'loren ipsun'),
(3, 1, 'loren ipsun'),
(4, 2, 'loren ipsun'),
(5, 2, 'loren ipsun'),
(6, 2, 'loren ipsun'),
(7, 3, 'loren ipsun'),
(8, 3, 'loren ipsun'),
(9, 3, 'loren ipsun');

-- --------------------------------------------------------

--
-- Estrutura da tabela `urgencies`
--

CREATE TABLE `urgencies` (
  `id` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `symptoms` varchar(150) NOT NULL,
  `priority` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `id_doctor` int(11) DEFAULT NULL,
  `diagnosis` varchar(150) DEFAULT NULL,
  `prescription` varchar(150) DEFAULT NULL,
  `observation` varchar(200) DEFAULT NULL,
  `released` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `plains`
--
ALTER TABLE `plains`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `plain_descriptions`
--
ALTER TABLE `plain_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `urgencies`
--
ALTER TABLE `urgencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `exames`
--
ALTER TABLE `exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `plains`
--
ALTER TABLE `plains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `plain_descriptions`
--
ALTER TABLE `plain_descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `urgencies`
--
ALTER TABLE `urgencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
