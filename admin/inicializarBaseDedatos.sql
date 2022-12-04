
-- Servidor: localhost


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Base de datos: `ce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVentas`
--

CREATE TABLE `lineOrder` (
  `idLineOrder` int(11) NOT NULL,
  `idProduct` int(5) NOT NULL,
  `idOrder` int(5) NOT NULL,
  `units` int(5) NOT NULL,
  `price` double NOT NULL,
  `subTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `category` (
                            `idCategory` int(11) NOT NULL,
                            `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `product` (
  `idProduct` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `available` int(5) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--



CREATE TABLE `file` (
                         `idFile` int NOT NULL AUTO_INCREMENT,
                         `filename` varchar(250) default '' NOT NULL,
                         `filesize` int NOT NULL default 0,
                         `webPath` varchar(250) default '' NOT NULL,
                         `systemPath` varchar(250) default '' NOT NULL,
                         `test` boolean default false,
                         PRIMARY KEY (`idFile`)
) AUTO_INCREMENT=1;


CREATE TABLE `productFile` (
                             `idProduct` int NOT NULL,
                             `idFile` int NOT NULL
);





-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `idClient` int(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Indices de la tabla `detalleVentas`
--
ALTER TABLE `lineOrder`
  ADD PRIMARY KEY (`idLineOrder`),
  ADD KEY `fkIdProduct` (`idProduct`),
  ADD KEY `fkIdOrder` (`idOrder`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`);

ALTER TABLE `category`
    ADD PRIMARY KEY (`idCategory`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `fkIdClient` (`idClient`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT;

  --
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleVentas`
--
ALTER TABLE `lineOrder`
  MODIFY `idLineOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `category`
    MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleVentas`
--
ALTER TABLE `lineOrder`
  ADD CONSTRAINT `idOrder` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `order`
  ADD CONSTRAINT `idClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--mtn12345
--uoc12345
INSERT INTO `user` (`idUser`, `email`, `pass`, `name`) VALUES
(1, 'mjcuadrado@uoc.edu', '12def5a0bcd81e257954fee4c1d10f53', 'Martin Moreno'),
(2, 'test@uoc.edu', 'e7eb549513fc377e9f75d16790364ec5', 'test uoc');

--mtn12345
--uoc12345
INSERT INTO `client` (`idClient`, `email`, `pass`, `name`, `address`) VALUES
(1, 'mjcuadrado@uoc.edu', '12def5a0bcd81e257954fee4c1d10f53', 'Martin Moreno', 'Calle Pepito Grillo 21, 23100 Mancha Real (Jaen)'),
(2, 'test@uoc.edu', 'e7eb549513fc377e9f75d16790364ec5', 'test uoc', 'Calle Pepito Grillo 22, Barcelona');


insert into `product` (`idproduct`, name, price, available, idCategory) VALUES
(1,'Botella 5L Virgen Extra en caja de carton', 2, 100, 3),
(2,'Botella Virgen Extra 500ml cristal', 3, 100, 1),
(3,'Frasca de 2L Virgen Extra', 3, 100, 1),
(4,'Minitaturas para regalo', 3, 100, 2),
(5,'Monodosis virgen exta', 3, 100, 5),
(6,'Pack de botellas Virgen Extra', 3, 100, 2),
(7,'Garrafa Pet 2L', 3, 100, 4),
(8,'Garrafa Pet 5L', 3, 100, 4),
(9,'Recien hecho 500ml', 3, 100, 1),
(10,'Recien hecho 1000ml', 3, 100, 1);

insert into file (idFIle, filename, webPath, systemPath, test) VALUES
(1,'bag-in-box-5l.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false), 
(2,'envase-cristal-500-ml-nuevo_300x300.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(3,'frasca-grifo-2litros.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(4,'miniaturas--nuevas.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(5,'monodosis-nuevas.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(6,'pack-n1.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(7,'pet-2litros-aceite-oliva-virgen-extra.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(8,'pet-5litros-aceite-oliva-virgen-extra.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(9,'recien-hecho-500ml-nueva.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false),
(10,'recien-hecho-1000ml-nueva.jpg','admin\images\product', 'C:\xampp\htdocs\ce\admin\images\product', false);

insert into productFile (idProduct, idFile) VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10);

Insert into category(`idCategory`, name) VALUES
(1,'botella'),
(2, 'pack regalo'),
(3,'caja'),
(4,'garrafa'),
(5,'monodosis');


Rollback;