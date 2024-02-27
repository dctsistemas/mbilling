DROP TABLE IF EXISTS `pkg_checkout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pkg_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(14) DEFAULT NULL,
  `doc` varchar(20) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `referente` varchar(1000) DEFAULT NULL,
  `vencimento` text CHARACTER SET latin1 DEFAULT NULL,
  `valor` varchar(1000) DEFAULT NULL,
  `linha` text CHARACTER SET latin1 DEFAULT NULL,
  `qrcode` text CHARACTER SET latin1 DEFAULT NULL,
  `codigo_transacao` varchar(1000) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pendente',
  `hora` varchar(20) DEFAULT NULL,
  `minuto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


INSERT INTO pkg_checkout(type, doc, email, descricao, referente, vencimento, valor ) VALUES(    'CPF',    '04622603306',     'danielct59@gmail.com',     'Descricção do produto',     'Referente ao que esta cobrando',     '02-05-2024',     '0.18'    );


