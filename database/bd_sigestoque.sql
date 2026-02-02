-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jan-2026 às 23:30
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_sigestoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbladmin`
--

CREATE TABLE `tbladmin` (
  `admin_id` varchar(200) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `tbladmin`
--

INSERT INTO `tbladmin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
('d29f793973741ab730a68926b4e194261455af9d', 'Administrador', 'admin@mail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblcliente`
--

CREATE TABLE `tblcliente` (
  `idCli` int(11) NOT NULL,
  `numerocli` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `numTel` varchar(18) NOT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tblcliente`
--

INSERT INTO `tblcliente` (`idCli`, `numerocli`, `nome`, `bairro`, `numTel`, `created_at`) VALUES
(17, '1d154a68fc0a', 'Cliente 01', 'Popular', '222-222-222', '2024-04-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblfornecedor`
--

CREATE TABLE `tblfornecedor` (
  `idFor` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tblfornecedor`
--

INSERT INTO `tblfornecedor` (`idFor`, `nome`, `endereco`, `telefone`, `email`) VALUES
(1, 'Fornecedor 01', 'Rua A, Dunga', '123123123', 'fornecedor01@mail.com'),
(5, 'tfornecedor este', 'uige UE', '123-456-789', 'teste@email.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblpagamento`
--

CREATE TABLE `tblpagamento` (
  `idPag` int(11) NOT NULL,
  `numeroPag` varchar(30) NOT NULL,
  `numero1` varchar(30) NOT NULL,
  `numero2` varchar(100) NOT NULL,
  `montant` varchar(30) NOT NULL,
  `metodo` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tblpagamento`
--

INSERT INTO `tblpagamento` (`idPag`, `numeroPag`, `numero1`, `numero2`, `montant`, `metodo`, `created_at`) VALUES
(85, 'LIES3H7J2T', 'Comando Zap', 'UGQX-3268', '2000', 'Dinheiro', '2024-04-06 05:08:48'),
(86, 'MZRSHOX15I', 'Comando Zap', 'JMZF-8317', '2000', 'Dinheiro', '2024-04-06 05:19:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblproduto`
--

CREATE TABLE `tblproduto` (
  `idPro` int(11) NOT NULL,
  `numeropr` varchar(30) NOT NULL,
  `nomePro` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `preco` varchar(30) NOT NULL,
  `qtdd` varchar(30) NOT NULL,
  `idFor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tblproduto`
--

INSERT INTO `tblproduto` (`idPro`, `numeropr`, `nomePro`, `img`, `descricao`, `preco`, `qtdd`, `idFor`) VALUES
(11, 'JRSH-9378', 'Comando Zap', '1088496549.jpg', 'Comando da Zap', '1000', '16', 1),
(12, 'ZPWX-8497', 'LNB', 'pngwing.com (1).png', 'LNB Para Antena Parabólica', '2500', '20', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblvenda`
--

CREATE TABLE `tblvenda` (
  `idVen` int(11) NOT NULL,
  `nomeprod` varchar(50) NOT NULL,
  `numerov` varchar(30) NOT NULL,
  `preco` varchar(30) NOT NULL,
  `qtddv` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `idCli` int(11) NOT NULL,
  `idPro` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tblvenda`
--

INSERT INTO `tblvenda` (`idVen`, `nomeprod`, `numerov`, `preco`, `qtddv`, `estado`, `idCli`, `idPro`, `created_at`) VALUES
(58, ' Comando Zap', 'UGQX-3268', ' 1000', '2', 'Pago', 17, 11, '2024-04-06 05:05:42'),
(59, ' Comando Zap', 'JMZF-8317', ' 1000', '2', 'Pago', 17, 11, '2024-04-06 05:18:54');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices para tabela `tblcliente`
--
ALTER TABLE `tblcliente`
  ADD PRIMARY KEY (`idCli`);

--
-- Índices para tabela `tblfornecedor`
--
ALTER TABLE `tblfornecedor`
  ADD PRIMARY KEY (`idFor`);

--
-- Índices para tabela `tblpagamento`
--
ALTER TABLE `tblpagamento`
  ADD PRIMARY KEY (`idPag`);

--
-- Índices para tabela `tblproduto`
--
ALTER TABLE `tblproduto`
  ADD PRIMARY KEY (`idPro`),
  ADD KEY `idFor` (`idFor`);

--
-- Índices para tabela `tblvenda`
--
ALTER TABLE `tblvenda`
  ADD PRIMARY KEY (`idVen`),
  ADD KEY `idCli` (`idCli`),
  ADD KEY `idPro` (`idPro`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tblcliente`
--
ALTER TABLE `tblcliente`
  MODIFY `idCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tblfornecedor`
--
ALTER TABLE `tblfornecedor`
  MODIFY `idFor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tblpagamento`
--
ALTER TABLE `tblpagamento`
  MODIFY `idPag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `tblproduto`
--
ALTER TABLE `tblproduto`
  MODIFY `idPro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tblvenda`
--
ALTER TABLE `tblvenda`
  MODIFY `idVen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tblproduto`
--
ALTER TABLE `tblproduto`
  ADD CONSTRAINT `tblproduto_ibfk_1` FOREIGN KEY (`idFor`) REFERENCES `tblfornecedor` (`idFor`);

--
-- Limitadores para a tabela `tblvenda`
--
ALTER TABLE `tblvenda`
  ADD CONSTRAINT `tblvenda_ibfk_1` FOREIGN KEY (`idCli`) REFERENCES `tblcliente` (`idCli`),
  ADD CONSTRAINT `tblvenda_ibfk_2` FOREIGN KEY (`idPro`) REFERENCES `tblproduto` (`idPro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
