ALTER TABLE `clientes` ADD `diferido` TINYINT NOT NULL DEFAULT '0' COMMENT 'cliente con reporte diferido de los viajes' AFTER `deudor`;