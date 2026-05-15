-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Maio-2026 às 01:01
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd-projeto-integrador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `logradouro` varchar(150) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `telefone`, `data_nascimento`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`) VALUES
(1, 'Ricardo Rigoni', 'ric@teste.com', '(19) 1 9319-4919', '1996-04-26', '13405-408', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Eliza Moura da Silva', '555'),
(2, 'Michael Jackson', 'mj@gmail.com', '(19) 9 8595-9999', '2026-01-01', '13408-400', 'SP', 'Piracicaba', 'Vila Sônia', 'Rua Antônio Vagner Pimpinato', '789'),
(3, 'Luísa Fonseca', 'luisa@fonseca.com', '(19) 9 9686-9689', '1990-10-10', '13400-420', 'SP', 'Piracicaba', 'Centro', 'Travessa Francisco Cecílio Elias Raya', '444'),
(4, 'Alexandre', 'ale@xandre.com', '(19) 9 8696-6899', '1995-10-10', '13400-420', 'SP', 'Piracicaba', 'Centro', 'Travessa Francisco Cecílio Elias Raya', '825'),
(5, 'Graciela Barbosa', 'gra@barbosa.com', '(19) 9 9897-7899', '1990-10-10', '13405-413', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Sebastião Rodrigues Pinto', '555'),
(6, 'Marcelo', 'marcelo@teste.com', '(19) 9 9686-9689', '1990-10-10', '13405-405', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Nossa Senhora de Lourdes', '555'),
(9, 'Maria José', 'maze@teste.com', '(19) 9 7977-9799', '1980-10-10', '13405-420', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Emílio Bertozzi', '888'),
(10, 'Joana', 'joana@gmail.com', '(19) 9 7877-9799', '1990-10-10', '13405-405', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Nossa Senhora de Lourdes', '222'),
(11, 'Roberta Maria', 'robertaa@gmail.com', '(19) 9 8696-6999', '1990-10-10', '13405-420', 'SP', 'Piracicaba', 'Jardim Algodoal', 'Rua Emílio Bertozzi', '333');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pedido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pedido`)),
  `total` float NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `pedido`, `total`, `data_criacao`) VALUES
(1, 1, '[{\"descricao\":\"Camiseta Adidas\",\"valor\":\"100.00\"},{\"descricao\":\"T\\u00eanis Adidas\",\"valor\":\"350.00\"}]', 450, '2026-05-15 17:46:41'),
(2, 2, '[{\"descricao\":\"Camiseta Gucci\",\"valor\":\"100.00\"},{\"descricao\":\"Cal\\u00e7a Jeans Preta\",\"valor\":\"400.00\"}]', 500, '2026-05-15 17:50:31'),
(3, 1, '[{\"descricao\":\"1 Cal\\u00e7a Jeans\",\"valor\":\"100.00\"}]', 100, '2026-05-15 17:51:50'),
(4, 6, '[{\"descricao\":\"Cal\\u00e7a Jeans\",\"valor\":\"100.00\"},{\"descricao\":\"Camiseta Adidas\",\"valor\":\"100.00\"}]', 200, '2026-05-15 18:23:11'),
(5, 10, '[{\"descricao\":\"T\\u00eanis Adidas\",\"valor\":\"250.00\"},{\"descricao\":\"Cal\\u00e7a Jeans\",\"valor\":\"300.00\"}]', 550, '2026-05-15 19:50:03'),
(6, 11, '[{\"descricao\":\"T\\u00eanis Nike\",\"valor\":\"250.00\"},{\"descricao\":\"Cal\\u00e7a Jeans\",\"valor\":\"300.00\"}]', 550, '2026-05-15 19:53:24');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
