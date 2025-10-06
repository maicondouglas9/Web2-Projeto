

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `comida_japonesa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `comida_japonesa`;


CREATE TABLE `itens_pedido` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `nome_prato` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `itens_pedido` (`id_item`, `id_pedido`, `nome_prato`, `quantidade`, `preco`) VALUES
(1, 3, 'ramen', 1, 121.12),
(2, 3, 'nigiri', 1, 30.40),
(3, 3, 'sushi', 1, 45.45),
(4, 6, 'nigiri', 1, 30.40),
(5, 6, 'ramen', 1, 121.12),
(6, 6, 'sushi', 1, 45.45),
(7, 7, 'nigiri', 2, 30.40),
(8, 7, 'ramen', 3, 121.12),
(9, 7, 'uramaki', 2, 78.99),
(10, 7, 'temaki', 2, 59.78),
(11, 8, 'nigiri', 1, 30.40),
(12, 8, 'sushi', 1, 45.45),
(13, 8, 'uramaki', 1, 78.99);


CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `entrega` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Em andamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `pedidos` (`id_pedido`, `nome`, `telefone`, `endereco`, `cep`, `pagamento`, `entrega`, `total`, `data_pedido`, `status`) VALUES
(3, 'Maicon', '51998962921', 'rua nove de julho 412 ap503 bloco 8, são luiz', '949494941', 'dinheiro', 'retirada', 196.97, '2025-10-01 01:10:14', 'Em andamento'),
(5, 'Maicon', '51998962921', 'rua nove de julho 412 ap503 bloco 8, são luiz', '949494941', 'dinheiro', 'retirada', 0.00, '2025-10-01 01:11:39', 'Em andamento'),
(6, 'jonas', '51998962921', 'rua nove de julho 412 ap503 bloco 8, são luiz', '949494941', 'pix', 'delivery', 196.97, '2025-10-01 01:11:59', 'Em andamento'),
(7, 'Maicon', '51998962921', 'rua nove de julho 412 ap503 bloco 8, são luiz', '949494941', 'pix', 'delivery', 701.70, '2025-10-01 01:22:58', 'Em andamento'),
(8, 'josias', '61123451234', 'ajuda', '9876987', 'pix', 'delivery', 154.84, '2025-10-06 19:37:33', 'Cancelado');


CREATE TABLE `tb_prato` (
  `id_prato` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tb_prato` (`id_prato`, `nome`, `preco`, `descricao`, `foto`) VALUES
(1, 'sushi', 45.45, 'peixe cru com alga', 'img_pratos/1758708225_image.webp'),
(2, 'temaki', 59.78, 'peixe cru ', 'img_pratos/1758708263_246.jpg'),
(4, 'ramen', 121.12, 'alguma coisa passou pelo fogo finalmente', 'img_pratos/1758708321_images (1).jpg');

CREATE TABLE `tb_reserva` (
  `id_reserva` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `data_reserva` date DEFAULT NULL,
  `horario` time(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tb_reserva` (`id_reserva`, `nome`, `telefone`, `data_reserva`, `horario`) VALUES
(3, 'Takamassa Nomuro', '51998962921', '2025-12-12', '12:21:00.00000');


ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_pedido` (`id_pedido`);


ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);


ALTER TABLE `tb_prato`
  ADD PRIMARY KEY (`id_prato`);

ALTER TABLE `tb_reserva`
  ADD PRIMARY KEY (`id_reserva`);


ALTER TABLE `itens_pedido`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;


ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `tb_prato`
  MODIFY `id_prato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `tb_reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE;
COMMIT;


