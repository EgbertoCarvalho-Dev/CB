-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jun-2023 às 19:20
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlebalanca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cars`
--

INSERT INTO `cars` (`id`, `name`, `placa`, `created_at`, `updated_at`) VALUES
(4, 'HB20', 'OKB7G43', '2023-06-13 05:32:17', '2023-06-13 05:35:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `car` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `startpost` datetime DEFAULT NULL,
  `endpost` datetime DEFAULT NULL,
  `item` varchar(200) NOT NULL,
  `total` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  `responsible` int(11) NOT NULL,
  `observation` text NOT NULL,
  `type` enum('M','K') NOT NULL,
  `attribute` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `entries`
--

INSERT INTO `entries` (`id`, `car`, `supplier`, `startpost`, `endpost`, `item`, `total`, `manager`, `responsible`, `observation`, `type`, `attribute`, `created_at`, `updated_at`) VALUES
(3, 4, 5, '2023-06-13 21:40:00', '2023-06-16 21:40:00', 'Plastico', 13500, 1, 1, 'LOREM IPSUM', 'K', '{\"start\":\"150\",\"end\":\"1500\",\"value\":\"10\"}', '2023-06-14 02:42:25', '2023-06-14 02:42:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cpfcnpj` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `cpfcnpj`, `created_at`, `updated_at`) VALUES
(5, 'HP Fornecedor', '', '2023-06-13 05:18:29', '2023-06-13 05:18:29'),
(7, 'FORNECEDOR 1', '', '2023-06-14 19:13:32', '2023-06-14 19:13:32'),
(8, 'TESTE', '123456', '2023-06-14 19:17:26', '2023-06-14 19:17:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `level` enum('adm','user') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Egberto Carvalho23', 'adm@adm.com.br', '78925fb55aaaff0a70cca78e5181890e', 'adm', '2023-06-13 02:16:51', '2023-06-13 23:49:13'),
(5, 'teste', 'teste@gmail.com', '7716ba510629078572d6d35be2d7b167', 'user', '2023-06-14 17:02:25', '2023-06-14 17:02:25');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
