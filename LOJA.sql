-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Abr-2021 às 08:00
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LOJA`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `CARRINHOS`
--

CREATE TABLE `CARRINHOS` (
  `CAR_SESSAO` varchar(32) NOT NULL,
  `PRO_ID` int(11) UNSIGNED NOT NULL,
  `CAR_QUANTIDADE` int(10) UNSIGNED NOT NULL,
  `CAR_VALOR_ITEM` decimal(10,2) NOT NULL,
  `CAR_TOTAL` decimal(10,2) NOT NULL,
  `CAR_DATA` date NOT NULL,
  `CAR_FRETE` decimal(10,2) NOT NULL DEFAULT '0.00',
  `CAR_TIPOFRETE` varchar(10) NOT NULL DEFAULT 'PAC',
  `CAR_AVISADO` set('S','N') NOT NULL DEFAULT 'N',
  `CAR_CEP` varchar(9) NOT NULL DEFAULT '00000-000',
  `FOP_ID` int(11) UNSIGNED NOT NULL DEFAULT '2',
  `COP_ID` int(11) UNSIGNED NOT NULL DEFAULT '50'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `CARRINHOS`
--

INSERT INTO `CARRINHOS` (`CAR_SESSAO`, `PRO_ID`, `CAR_QUANTIDADE`, `CAR_VALOR_ITEM`, `CAR_TOTAL`, `CAR_DATA`, `CAR_FRETE`, `CAR_TIPOFRETE`, `CAR_AVISADO`, `CAR_CEP`, `FOP_ID`, `COP_ID`) VALUES
('df85daf6cb282d536bbde0d4325cb5cf', 4, 1, '1600.00', '1600.00', '2021-04-20', '0.00', 'PAC', 'N', '00000-000', 2, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `CATEGORIA`
--

CREATE TABLE `CATEGORIA` (
  `CAT_ID` int(11) UNSIGNED NOT NULL,
  `CAT_NOME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `CATEGORIA`
--

INSERT INTO `CATEGORIA` (`CAT_ID`, `CAT_NOME`) VALUES
(1, 'Eletrodomésticos'),
(2, 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `CATEGORIA_MODULO`
--

CREATE TABLE `CATEGORIA_MODULO` (
  `CAM_ID` int(11) UNSIGNED NOT NULL,
  `CAM_NOME` varchar(50) NOT NULL,
  `CAM_ORDEM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `CATEGORIA_MODULO`
--

INSERT INTO `CATEGORIA_MODULO` (`CAM_ID`, `CAM_NOME`, `CAM_ORDEM`) VALUES
(1, 'Configurações', 10),
(2, 'Início', 1),
(3, 'E-Commerce', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `CUPONS`
--

CREATE TABLE `CUPONS` (
  `CUP_ID` int(11) UNSIGNED NOT NULL,
  `CUP_CODIGO` varchar(10) NOT NULL,
  `CUP_TIPO` set('V','P') NOT NULL DEFAULT 'P',
  `CUP_VALOR` decimal(10,2) NOT NULL DEFAULT '0.00',
  `MAR_ID` int(11) UNSIGNED DEFAULT NULL,
  `CAT_ID` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `CUPONS`
--

INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES
(1, 'Cupom10', 'P', '10.00', 1, 1),
(2, 'Cupom11', 'V', '11.00', NULL, NULL),
(3, 'Cupom13', 'P', '13.00', 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `MARCA`
--

CREATE TABLE `MARCA` (
  `MAR_ID` int(11) UNSIGNED NOT NULL,
  `MAR_NOME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `MARCA`
--

INSERT INTO `MARCA` (`MAR_ID`, `MAR_NOME`) VALUES
(1, 'Asus'),
(2, 'Ficher');

-- --------------------------------------------------------

--
-- Estrutura da tabela `MODULOS`
--

CREATE TABLE `MODULOS` (
  `MOD_ID` int(11) UNSIGNED NOT NULL,
  `MOD_NOME` varchar(64) NOT NULL DEFAULT '',
  `MOD_LINK` varchar(64) NOT NULL DEFAULT '',
  `MOD_ICONE` varchar(20) NOT NULL,
  `CAM_ID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `MODULOS`
--

INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES
(1, 'Módulos', 'modulos', 'list', 1),
(2, 'Permissões', 'permissoes', 'playlist_add_check', 1),
(3, 'Usuários', 'usuarios', 'person', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'list', 1),
(5, 'Início', 'index', 'dashboard', 2),
(6, 'Marca', 'marca', 'add_to_photos', 3),
(7, 'Categoria', 'categoria', 'add_to_photos', 3),
(8, 'Produtos', 'produtos', 'add_to_photos', 3),
(9, 'Cupons', 'cupons', 'add_to_photos', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `MODULOS_FAVORITOS`
--

CREATE TABLE `MODULOS_FAVORITOS` (
  `MOD_ID` int(11) UNSIGNED NOT NULL,
  `USU_ID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `MODULOS_PERMISSOES`
--

CREATE TABLE `MODULOS_PERMISSOES` (
  `MOD_ID` int(11) UNSIGNED NOT NULL,
  `PER_ID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `MODULOS_PERMISSOES`
--

INSERT INTO `MODULOS_PERMISSOES` (`MOD_ID`, `PER_ID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `PERMISSOES`
--

CREATE TABLE `PERMISSOES` (
  `PER_ID` int(11) UNSIGNED NOT NULL,
  `PER_NOME` varchar(48) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `PERMISSOES`
--

INSERT INTO `PERMISSOES` (`PER_ID`, `PER_NOME`) VALUES
(1, 'Master'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `PRODUTOS`
--

CREATE TABLE `PRODUTOS` (
  `PRO_ID` int(11) UNSIGNED NOT NULL,
  `PRO_NOME` varchar(250) NOT NULL,
  `MAR_ID` int(11) UNSIGNED DEFAULT '0',
  `CAT_ID` int(11) UNSIGNED DEFAULT '0',
  `PRO_PRECO` decimal(10,2) NOT NULL DEFAULT '0.00',
  `PRO_DESCRICAO` text,
  `PRO_ATIVO` set('S','N') NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `PRODUTOS`
--

INSERT INTO `PRODUTOS` (`PRO_ID`, `PRO_NOME`, `MAR_ID`, `CAT_ID`, `PRO_PRECO`, `PRO_DESCRICAO`, `PRO_ATIVO`) VALUES
(1, 'Notebook', 1, 2, '2500.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in mi a arcu tincidunt cursus. Nunc ac consectetur eros, in bibendum arcu. In pharetra felis sit amet purus varius, sit amet eleifend leo molestie. Maecenas tristique venenatis est id elementum. Nullam tincidunt turpis ac massa ultrices, sed congue nunc aliquam. Nulla molestie arcu sit amet felis blandit condimentum. Suspendisse vel risus a ipsum sagittis aliquet. Mauris dictum quam quis libero tempus convallis.</p>\n\n<p>Phasellus dignissim lectus id orci facilisis, a fringilla odio finibus. Pellentesque tristique tortor in placerat viverra. Integer vitae justo nibh. Suspendisse potenti. In quis tincidunt magna. Vestibulum eleifend dui turpis, vitae suscipit augue vehicula eu. Nulla id augue nisi. Vestibulum feugiat tortor turpis, eu congue nunc fermentum nec. Nulla aliquam ante a turpis vulputate, vitae facilisis ante lacinia. Curabitur quis erat velit. Curabitur id aliquet sapien. Praesent efficitur leo sit amet pulvinar viverra. Maecenas nec gravida lectus, eget ultricies tellus.</p>\n', 'S'),
(2, 'Máquina de Lavar Roupas', 1, 1, '1600.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n', 'S'),
(3, 'Máquina de Lavar Roupas', 1, 1, '1600.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n', 'S'),
(4, 'Máquina de Lavar Roupas', 1, 1, '1600.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n', 'S'),
(5, 'Máquina de Lavar Roupas', 1, 1, '1600.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque urna cursus.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit. Praesent ultrices enim sed leo accumsan, nec porta purus consectetur.&nbsp;</p>\n', 'S'),
(6, 'Forno Microondas', 2, 1, '360.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n', 'S'),
(7, 'Forno Microondas', 2, 1, '360.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n', 'S'),
(8, 'Forno Microondas', 2, 1, '360.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n', 'S'),
(9, 'Forno Microondas', 2, 1, '360.00', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nisl odio. Nulla massa sapien, congue hendrerit posuere et, sagittis sed sem. Quisque ipsum orci, hendrerit et consequat et, finibus vitae augue. Integer sodales eros pellentesque.</p>\n\n<p>Sed ornare velit nec nibh scelerisque, vel hendrerit urna tempus. Donec et mauris tortor. Sed ut luctus purus. Curabitur lobortis massa risus, ut commodo nunc auctor vitae. Etiam imperdiet aliquam elit.&nbsp;</p>\n', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `USU_ID` int(11) UNSIGNED NOT NULL,
  `PER_ID` int(11) UNSIGNED NOT NULL,
  `USU_NOME` varchar(100) NOT NULL,
  `USU_EMAIL` varchar(200) NOT NULL DEFAULT '',
  `USU_LOGIN` varchar(50) NOT NULL,
  `USU_SENHA` varchar(32) NOT NULL,
  `USU_DATA_CADASTRO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `USUARIOS`
--

INSERT INTO `USUARIOS` (`USU_ID`, `PER_ID`, `USU_NOME`, `USU_EMAIL`, `USU_LOGIN`, `USU_SENHA`, `USU_DATA_CADASTRO`) VALUES
(1, 1, 'admin', 'admin@admin.com.br', 'admin', '314d8a8b0677eb982e2ac37507f7a664', '2021-04-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CARRINHOS`
--
ALTER TABLE `CARRINHOS`
  ADD PRIMARY KEY (`CAR_SESSAO`,`PRO_ID`),
  ADD KEY `fk_carrinhospro` (`PRO_ID`);

--
-- Indexes for table `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `CATEGORIA_MODULO`
--
ALTER TABLE `CATEGORIA_MODULO`
  ADD PRIMARY KEY (`CAM_ID`);

--
-- Indexes for table `CUPONS`
--
ALTER TABLE `CUPONS`
  ADD PRIMARY KEY (`CUP_ID`),
  ADD KEY `MAR_ID` (`MAR_ID`),
  ADD KEY `CAT_ID` (`CAT_ID`);

--
-- Indexes for table `MARCA`
--
ALTER TABLE `MARCA`
  ADD PRIMARY KEY (`MAR_ID`);

--
-- Indexes for table `MODULOS`
--
ALTER TABLE `MODULOS`
  ADD PRIMARY KEY (`MOD_ID`),
  ADD UNIQUE KEY `MOD_LINK` (`MOD_LINK`),
  ADD KEY `fk_moduloscam` (`CAM_ID`);

--
-- Indexes for table `MODULOS_FAVORITOS`
--
ALTER TABLE `MODULOS_FAVORITOS`
  ADD PRIMARY KEY (`MOD_ID`,`USU_ID`),
  ADD KEY `fk_modulofavoritosusu` (`USU_ID`);

--
-- Indexes for table `MODULOS_PERMISSOES`
--
ALTER TABLE `MODULOS_PERMISSOES`
  ADD PRIMARY KEY (`MOD_ID`,`PER_ID`),
  ADD KEY `fk_modulopermissaoper` (`PER_ID`);

--
-- Indexes for table `PERMISSOES`
--
ALTER TABLE `PERMISSOES`
  ADD PRIMARY KEY (`PER_ID`);

--
-- Indexes for table `PRODUTOS`
--
ALTER TABLE `PRODUTOS`
  ADD PRIMARY KEY (`PRO_ID`),
  ADD KEY `MAR_ID` (`MAR_ID`),
  ADD KEY `CAT_ID` (`CAT_ID`);

--
-- Indexes for table `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`USU_ID`),
  ADD UNIQUE KEY `USU_LOGIN` (`USU_LOGIN`),
  ADD KEY `fk_usuariosper` (`PER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATEGORIA`
--
ALTER TABLE `CATEGORIA`
  MODIFY `CAT_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `CATEGORIA_MODULO`
--
ALTER TABLE `CATEGORIA_MODULO`
  MODIFY `CAM_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `CUPONS`
--
ALTER TABLE `CUPONS`
  MODIFY `CUP_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `MARCA`
--
ALTER TABLE `MARCA`
  MODIFY `MAR_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `MODULOS`
--
ALTER TABLE `MODULOS`
  MODIFY `MOD_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `PERMISSOES`
--
ALTER TABLE `PERMISSOES`
  MODIFY `PER_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `PRODUTOS`
--
ALTER TABLE `PRODUTOS`
  MODIFY `PRO_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `USU_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `CARRINHOS`
--
ALTER TABLE `CARRINHOS`
  ADD CONSTRAINT `fk_carrinhospro` FOREIGN KEY (`PRO_ID`) REFERENCES `PRODUTOS` (`PRO_ID`);

--
-- Limitadores para a tabela `CUPONS`
--
ALTER TABLE `CUPONS`
  ADD CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`),
  ADD CONSTRAINT `CUPONS_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`);

--
-- Limitadores para a tabela `MODULOS`
--
ALTER TABLE `MODULOS`
  ADD CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`);

--
-- Limitadores para a tabela `MODULOS_FAVORITOS`
--
ALTER TABLE `MODULOS_FAVORITOS`
  ADD CONSTRAINT `fk_modulofavoritosmod` FOREIGN KEY (`MOD_ID`) REFERENCES `MODULOS` (`MOD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulofavoritosusu` FOREIGN KEY (`USU_ID`) REFERENCES `USUARIOS` (`USU_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `MODULOS_PERMISSOES`
--
ALTER TABLE `MODULOS_PERMISSOES`
  ADD CONSTRAINT `fk_modulopermissaomod` FOREIGN KEY (`MOD_ID`) REFERENCES `MODULOS` (`MOD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulopermissaoper` FOREIGN KEY (`PER_ID`) REFERENCES `PERMISSOES` (`PER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `PRODUTOS`
--
ALTER TABLE `PRODUTOS`
  ADD CONSTRAINT `PRODUTOS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`),
  ADD CONSTRAINT `PRODUTOS_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`);

--
-- Limitadores para a tabela `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD CONSTRAINT `fk_usuariosper` FOREIGN KEY (`PER_ID`) REFERENCES `PERMISSOES` (`PER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
