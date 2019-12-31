ALTER TABLE `viajes` ADD `pendiente` TINYINT NOT NULL DEFAULT '0' AFTER `fecha_comisionar`, ADD `fecha_pago` VARCHAR(20) NULL AFTER `pendiente`, ADD `descripcion_pago` TEXT NULL AFTER `fecha_pago`;
