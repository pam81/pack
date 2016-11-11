
CREATE TABLE `dias` (
  `id` int(11) NOT NULL,
  `dia` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `dias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;