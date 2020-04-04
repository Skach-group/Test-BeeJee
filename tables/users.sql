
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(0, 'admin', '$2y$10$mveZpNkK5sFW0GZi8WG7w.yhyYu/urVZTQ3L2ArFrUU2GiDtrdBCu');
