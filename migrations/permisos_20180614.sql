INSERT INTO `permisos` (`id`, `name`, `macro`, `parentid`, `reporte`) VALUES (NULL, 'inhabilitar cliente', 'INHABILITAR_CLIENTE', NULL, '0');
INSERT INTO `permisos` (`id`, `name`, `macro`, `parentid`, `reporte`) VALUES (NULL, 'seteo contraseñas', 'SETEO_PASSWORD', NULL, '0');

CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `cliente_inhabilitar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
INSERT INTO `passwords` (`id`, `cliente_inhabilitar`) VALUES (NULL, SHA1('1234'));
