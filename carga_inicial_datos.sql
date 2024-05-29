SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `DATMANTOOLS`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADCATPRO`
--
CREATE TABLE `ADCATPRO` (
  `Cpo_Id`      int           NOT NULL,
  `Cpo_NomCome` varchar(250)  NOT NULL,
  `Cpo_RFC`     varchar(13)   NOT NULL,
  `Cpo_RazSoci` varchar(250)  NOT NULL,
  `Cpo_RegFisc` int           NOT NULL,
  `Cpo_Telefon` varchar(13)   NOT NULL,
  `Cpo_LimCred` float         NOT NULL,
  `Cpo_FecAlta` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cpo_FecModi` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cpo_Estatus` int           NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADCATPRO`
--
ALTER TABLE `ADCATPRO`
  ADD PRIMARY KEY (`Cpo_Id`),
  ADD UNIQUE KEY `Cpo_RFC_Unique` (`Cpo_RFC`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ADCATPRO`
--
ALTER TABLE `ADCATPRO`
  MODIFY `Cpo_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

--
-- Volcado de datos para la tabla `ADCATPRO`
--
INSERT INTO `ADCATPRO` (`Cpo_Id`, `Cpo_NomCome`, `Cpo_RFC`, `Cpo_RazSoci`, `Cpo_RegFisc`, `Cpo_Telefon`, `Cpo_LimCred`, `Cpo_FecAlta`, `Cpo_FecModi`, `Cpo_Estatus`) VALUES
(1,'HOME DEPOT','HDM001017AS1','HOME DEPOT MEXICO',601,'9981933700',0,now(),now(),1),
(2,'BOXITO','GBO1310311S2','GRUPO BOXITO',601,'9616582009',0,now(),now(),1),
(3,'CUPRUM','TUC101221G61','TIENDAS CUPRUM S.A. DE C.V',601,'9988404300',0,now(),now(),1),
(4,'SEICON','BAMM601006GK4','MARCOS BRUNO BAUTISTA MERCADO',612,'9981094425',0,now(),now(),1),
(5,'VIMAR','AVM200110C21','ACEROS VIMAR MEXICO',601,'9984135462',0,now(),now(),1),
(6,'FANOSA','FAN870311EE6','FANOSA, S.A. DE C.V.',601,'9981010898',0,now(),now(),1),
(7,'OBREK','CCM9801279T1','CENTRO CONSTRUCTOR MYP',601,'9988451227',0,now(),now(),1),
(8,'IXCAN','AIX990531AU8','ACABADOS IXCAN',601,'9981689656',0,now(),now(),1),
(9,'INTERCERAMIC','DCC950404DD7','DISTRIBUIDORA DE CERAMICA CANCUN',601,'9988841214',0,now(),now(),1),
(10,'GRUAS ALCANO','ACA150511CI8','ALCANO CANCUN',601,'9982536536',0,now(),now(),1),
(11,'COLORLAND','CDI1609295X0','COLORLAND DISTRIBUCION',601,'9987057075',0,now(),now(),1),
(12,'DESECHABLES CANCUN','CAMJ891024SPA','JUAN CARLOS CAPETILLO MEDINA',612,'9983553679',0,now(),now(),1),
(13,'VILLA HERMOSA','MMV790725KS','MADERAS Y MATERIALES VILLAHERMOSA',601,'9983012759',0,now(),now(),1),
(14,'PINTURAS MARTINEZ','PMS191111R73','PINTURAS MAR DEL SURESTE',601,'9985224206',0,now(),now(),1),
(15,'MARANATA','NACW7210098X5','WILBERT NARANJO CORDOVA',612,'9982220918',0,now(),now(),1),
(16,'DMT-TODO TORNILLO','GTT1507077D5','GRUPO TORNILLOS PARA TODOS',601,'9888868428',0,now(),now(),1),
(17,'VITROMATIC','AUFA870208PQ6','ALEJANDRO AZUARA FLORES',612,'9981077880',0,now(),now(),1),
(18,'LIMPIA FACIL','CLF150504115','COMERCIALIZADORA LIMPIA FACIL DE CANCUN',626,'998252 2248',0,now(),now(),1),
(19,'HOLCIM','CAP821208LQ3','HOLCIM MEXICO OPERACIONES',601,'9981020399',0,now(),now(),1),
(20,'COP','PAC061023ID8','PINTURAS Y ACABADOS COP DEL CARIBE',601,'9982822014',0,now(),now(),1),
(21,'ALUMIJAL','APJ170522NC4','ALUMINIO Y PERFILES DE JALISCO',626,'3331095285',0,now(),now(),1),
(22,'LAMINADOS DE BARRO','LBA6804198Y1','LAMINADOS DE BARRO',601,'9981474588',0,now(),now(),1),
(23,'JOSE EDIEL MAGAÑA RICARDEZ','MARE7703196L8','JOSE EDIEL MAGAÑA RICARDEZ',612,'0',0,now(),now(),1),
(24,'TOTAL CONCRETE','CPE100625K37','CONSTRURENT DE LA PENINSULA',601,'998898855',0,now(),now(),1),
(25,'FERRETERIA TAVITO','CAGJ830322NQ5','JESUS OCTAVIO CAUICH GONZALEZ',612,'0',0,now(),now(),1),
(26,'FIX FERRETERIAS','SME051013BQ2','TIENDAS FIX',601,'0',0,now(),now(),1),
(27,'CHAGO','ARC201103R93','ADHESIVOS Y RECUBRIMIENTOS CHAGO',601,'9982352479',0,now(),now(),1),
(28,'SIMASUR','SIF200128CY4','SERVICIO INDUSTRIAL FERRETERO SIMASUR',601,'9984845263',0,now(),now(),1),
(29,'COMPACSAL','COM151119645','COMPACSAL',601,'9982025430',0,now(),now(),1),
(30,'JBN CANCUN','BRB980203247','BRB',626,'0',0,now(),now(),1),
(31,'FAEBSA FABRICACIONES','FEB200909IW2','FABRICACIONES ELECTRICAS DEL BAJIO',626,'0',0,now(),now(),1),
(32,'MOSECA','MSC0609283I2','MORTEROS SECOS DEL CARIBE',601,'9982157474',0,now(),now(),1);



--
-- Estructura de tabla para la tabla `ALCATART`
--
CREATE TABLE `ALCATART` (
  `Cri_Id`      int           NOT NULL,
  `Cri_CodBarr` bigint        NOT NULL,
  `Cri_Descrip` varchar(250)  NOT NULL,
  `Cri_Unidad`  varchar(3)    NOT NULL,
  `Cri_FecAlta` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cri_FecModi` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cri_Estatus` int           NOT NULL,
  `Cri_Familia` int           NOT NULL,
  `Cri_Proveed` json          NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ALCATART`
--
ALTER TABLE `ALCATART`
  ADD PRIMARY KEY (`Cri_Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ALCATART`
--
ALTER TABLE `ALCATART`
  MODIFY `Cri_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;


--
-- Estructura de tabla para la tabla `ADCATUNI`
--
CREATE TABLE `ADCATUNI` (
  `Cun_Id`      int           NOT NULL,
  `Cun_Clave`   varchar(6)    NOT NULL,
  `Cun_NomClav` varchar(100)  NOT NULL,
  `Cun_Tipo`    varchar(100)  NOT NULL,
  `Cun_FecAlta` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cun_FecModi` timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cun_Estatus` int           NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADCATUNI`
--
ALTER TABLE `ADCATUNI`
  ADD PRIMARY KEY (`Cun_Id`),
  ADD UNIQUE KEY `Cun_Clave_Unique` (`Cun_Clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ADCATUNI`
--
ALTER TABLE `ADCATUNI`
  MODIFY `Cun_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

--
-- Volcado de datos para la tabla `ADCATUNI`
--
INSERT INTO `ADCATUNI` (`Cun_Clave`, `Cun_NomClav`, `Cun_Tipo`, `Cun_FecAlta`, `Cun_FecModi`, `Cun_Estatus`) VALUES
('H87','Pieza','Múltiplos / Fracciones / Decimales',now(),now(),1),
('EA','Elemento','Unidades de venta',now(),now(),1),
('E48','Unidad de Servicio','Unidades específicas de la industria (varias)',now(),now(),1),
('ACT','Actividad','Unidades de venta',now(),now(),1),
('KGM','Kilogramo','Mecánica',now(),now(),1),
('E51','Trabajo','Unidades específicas de la industria (varias)',now(),now(),1),
('A9','Tarifa','Diversos',now(),now(),1),
('MTR','Metro','Tiempo y Espacio',now(),now(),1),
('AB','Paquete a granel','Diversos',now(),now(),1),
('BB','Caja base','Unidades específicas de la industria (varias)',now(),now(),1),
('KT','Kit','Unidades de venta',now(),now(),1),
('SET','Conjunto','Unidades de venta',now(),now(),1),
('LTR','Litro','Tiempo y Espacio',now(),now(),1),
('XBX','Caja','Unidades de empaque',now(),now(),1),
('MON','Mes','Tiempo y Espacio',now(),now(),1),
('HUR','Hora','Tiempo y Espacio',now(),now(),1),
('MTK','Metro cuadrado','Tiempo y Espacio',now(),now(),1),
('11','Equipos','Diversos',now(),now(),1),
('MGM','Miligramo','Mecánica',now(),now(),1),
('XPK','Paquete','Unidades de empaque',now(),now(),1),
('XKI','Kit','Unidades de empaque',now(),now(),1),
('AS','Variedad','Diversos',now(),now(),1),
('GRM','Gramo','Mecánica',now(),now(),1),
('PR','Par','Números enteros / Números / Ratios',now(),now(),1),
('DPC','Docenas de piezas','Unidades de venta',now(),now(),1),
('xun','Unidad','Unidades de empaque',now(),now(),1),
('DAY','Día','Tiempo y Espacio',now(),now(),1),
('XLT','Lote','Unidades de empaque',now(),now(),1),
('10','Grupos','Diversos',now(),now(),1),
('MLT','Mililitro','Tiempo y Espacio',now(),now(),1),
('E54','Viaje','Unidades específicas de la industria (varias)',now(),now(),1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Estructura de tabla para la tabla `ALENTART`
--

CREATE TABLE `ALENTART` (
  `Ent_Id`      int NOT NULL,
  `Ent_Requic`  varchar(150) NOT NULL,
  `Ent_Provee`  int NOT NULL,
  `Ent_Recibe`  int NOT NULL,
  `Ent_Produc`  int NOT NULL,
  `Ent_Cantid`  int NOT NULL,
  `Ent_PU`      float NOT NULL,
  `Ent_Total`   float NOT NULL,
  `Ent_FecAlt`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ent_FecMod`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ent_Estatu`  int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indices de la tabla `ALENTART`
--
ALTER TABLE `ALENTART`
  ADD PRIMARY KEY (`Ent_Id`);

--
-- AUTO_INCREMENT de la tabla `ALENTART`
--
ALTER TABLE `ALENTART`
  MODIFY `Ent_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;


--
-- Estructura de tabla para la tabla `ALSALART`
--

CREATE TABLE `ALSALART` (
  `Sal_Id` int NOT NULL,
  `Sal_Solici` varchar(50) NOT NULL,
  `Sal_SolPer` varchar(200) NOT NULL,
  `Sal_Autori` varchar(200) NOT NULL,
  `Sal_Entreg` varchar(200) NOT NULL,
  `Sal_Destin` json NOT NULL,
  `Sal_Produc` int NOT NULL,
  `Sal_Cantid` int NOT NULL,
  `Sal_Coment` varchar(250) NOT NULL,
  `Sal_FecAlt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Sal_FecMod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Sal_Estatu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indices de la tabla `ALSALART`
--
ALTER TABLE `ALSALART`
  ADD PRIMARY KEY (`Sal_Id`);

--
-- AUTO_INCREMENT de la tabla `ALSALART`
--
ALTER TABLE `ALSALART`
  MODIFY `Sal_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;