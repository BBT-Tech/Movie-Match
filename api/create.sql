CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` char(42) CHARACTER SET utf8mb4 NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `age` tinyint(4) NOT NULL,
  `grade` tinyint(4) NOT NULL,
  `college` tinyint(4) NOT NULL,
  `school` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `tel` char(11) CHARACTER SET utf8mb4 NOT NULL,
  `wechat` char(30) CHARACTER SET utf8mb4 NOT NULL,
  `tagender` tinyint(4) NOT NULL,
  `movie` tinyint(4) NOT NULL,
  `t_top` double NOT NULL,
  `t_bottom` double NOT NULL,
  `h_end_top` double NOT NULL,
  `p_top` point NOT NULL,
  `p_right` point NOT NULL,
  `match_status` tinyint(4) NOT NULL,
  `psw` char(6) CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `match_first` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `self` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `a_1` FOREIGN KEY (`self`) REFERENCES `users` (`id`),
  CONSTRAINT `b_1` FOREIGN KEY (`ta`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `match_second` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `self` int(11) NOT NULL,
  `ta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `a_2` FOREIGN KEY (`self`) REFERENCES `users` (`id`),
  CONSTRAINT `b_2` FOREIGN KEY (`ta`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;