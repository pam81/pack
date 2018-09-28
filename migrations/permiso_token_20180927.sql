INSERT INTO `permisos` (`id`, `name`, `macro`, `parentid`, `reporte`) VALUES (NULL, 'generar token', 'SETEO_TOKEN', NULL, '0');
INSERT INTO `permisos` (`id`, `name`, `macro`, `parentid`, `reporte`) VALUES (NULL, 'login sin token', 'LOGIN_SIN_TOKEN', NULL, '0');


CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
