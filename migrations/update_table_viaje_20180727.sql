ALTER TABLE `viajes` ADD `fecha_comisionar` VARCHAR(20) NULL ;
UPDATE `viajes` SET fecha_comisionar = fecha_despacho;