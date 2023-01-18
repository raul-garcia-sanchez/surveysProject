DROP DATABASE surveys_database;

CREATE DATABASE surveys_database;

USE surveys_database;

CREATE TABLE `invitations` (
  `id_student` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `questions` (`id`, `id_survey`, `title`, `active`, `type`) VALUES
(4, 1, 'Quants anys té?', 1, 'text'),
(5, 1, 'Està fent DUAL?', 1, 'number'),
(6, 1, 'Farà grau en enginyeria informàtica?', 1, 'text');



CREATE TABLE `response` (
  `id_survey` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_option` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `open_text` varchar(1024) NOT NULL,
  `number_option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'raul@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd', 'admin'),
(2, 'test@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd', 'teacher'),
(3, 'testing@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd', 'admin'),
(4, 'unai@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd', 'teacher');

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` int(11),
  `title` varchar(256) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `finishDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `surveys` (`id`, `creator`, `title`, `startDate`, `finishDate`) VALUES
(1, 1,'Enquesta sobre Raúl', '2023-01-16 18:12:20', 1676564543),
(2, 1,'Enquesta sobre Unai', '2023-01-16 18:15:25', 1676564543),
(3, 1,'Enquesta de prova', '2023-01-16 18:16:15', 1676564543),
(4, 1,'Enquesta sobre Iker', '2023-01-16 18:16:15', 1676564543);


CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `teachers_surveys` (
  `id_user` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id_student`,`id_survey`);

ALTER TABLE `teachers_surveys`
  ADD PRIMARY KEY (`id_user`,`id_student`);

ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`);

ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_survey` (`id_survey`);

ALTER TABLE `response`
  ADD PRIMARY KEY (`id_survey`,`id_student`,`id_question`,`id_option`,`id_user`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`);

ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`);

ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`);


