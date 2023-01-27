DROP DATABASE surveys_database;

CREATE DATABASE surveys_database;

USE surveys_database;

CREATE TABLE `invitations` (
  `id_student` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option` varchar(256) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `questions_surveys` (
  `id_question` INT NOT NULL,
  `id_survey` INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator` int(11),
  `title` varchar(256) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `finishDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `teachers_surveys` (
  `id_user` int(11) NOT NULL,
  `id_survey` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id_student`,`id_survey`);

ALTER TABLE `teachers_surveys`
  ADD PRIMARY KEY (`id_user`,`id_survey`);

ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`);

ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

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
  
ALTER TABLE `teachers_surveys`
  ADD CONSTRAINT `teachers_surveys_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`),
  ADD CONSTRAINT `teachers_surveys_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

ALTER TABLE `questions_surveys`
  ADD CONSTRAINT `questions_surveys_ibfk_1` FOREIGN KEY (`id_survey`) REFERENCES `surveys` (`id`),
  ADD CONSTRAINT `questions_surveys_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`);

INSERT INTO `surveys` (`id`, `creator`, `title`, `startDate`, `finishDate`) VALUES
(1, 1,'Enquesta 1r ESO Matemàtiques', '2023-01-16 18:12:20', '2023-01-16 19:12:20'),
(2, 1,'Enquesta 2n ESO Matemàtiques', '2023-01-16 18:15:25', '2023-01-16 19:15:25'),
(3, 1,'Enquesta 3r ESO Matemàtiques', '2023-01-16 18:16:15', '2023-01-16 19:16:15'),
(4, 1,'Enquesta 4t ESO Matemàtiques', '2023-01-16 18:16:15', '2023-01-16 19:16:15');

INSERT INTO `questions` (`id`, `title`, `active`, `type`) VALUES
(1, 'Quants anys té?', 1, 'text'),
(2,'Està fent DUAL?', 1, 'number'),
(3, 'Farà grau en enginyeria informàtica?', 1, 'text');

INSERT INTO `questions_surveys` (`id_question`,`id_survey`) VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(2,4),
(3,4);

INSERT INTO `users` (`id`, `username`, `password`,`name`, `role`) VALUES
(1, 'raul@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd','Enric', 'admin'),
(2, 'test@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd','Leandro', 'teacher'),
(3, 'testing@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd','Xavi', 'admin'),
(4, 'unai@gmail.com', 'bbb0b5b15842af2a3f42072a418c908e8a63caab2120d15cfea68e433cfe68dd','Unai', 'teacher');

INSERT INTO `teachers_surveys` (`id_user`,`id_survey`) VALUES
(1,1),
(1,2),
(2,1),
(2,4),
(3,3),
(4,1),
(4,2),
(4,4);

INSERT INTO `students` (`username`, `name`) VALUES
("alum1@gmail.com",'Juan'),
("alum2@gmail.com",'Jose'),
("alum3@gmail.com",'Maria'),
("alum4@gmail.com",'Juana'),
("alum5@gmail.com",'Irene'),
("alum6@gmail.com",'Unai');

commit;
