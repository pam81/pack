ALTER TABLE `viajes` ADD `km` DOUBLE NULL DEFAULT '0' COMMENT 'importe kilometros' AFTER `iva`, 
ADD `cant_km` DOUBLE NULL DEFAULT '0' COMMENT 'cantidad de kilometros' AFTER `km`;
