CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `tipo`, `codigo`, `expire`, `descripcion`) VALUES
(1, 'cliente_inhabilitar', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-07-17 10:38:00', 'Inhabilitar cliente'),
(2, 'modificar_docu', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-07-16 10:38:00', 'Modificar Documentación'),
(3, 'asignar_viaje', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-07-17 10:39:00', 'Asignar Viaje');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

CREATE TABLE `referidos` (
  `id` int(11) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `tipo` enum('email','web','referido','otro') NOT NULL DEFAULT 'otro',
  `texto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `referidos`
  ADD PRIMARY KEY (`id`);