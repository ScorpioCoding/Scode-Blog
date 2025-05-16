CREATE DATABASE IF NOT EXISTS scorpioblog;

USE scorpioblog;

--
-- TABLE user
--

CREATE TABLE IF NOT EXISTS `user` ( 
  `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,   
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `validate` enum('true','false') NOT NULL DEFAULT 'false',
  `archive` enum('true','false') NOT NULL DEFAULT 'false',
  `realm` enum('super','admin','editor','user') NOT NULL DEFAULT 'user',
  `pswhash` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) UNIQUE,
  `created_at` TIMESTAMP DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

--
-- TABLE post
--

CREATE TABLE IF NOT EXISTS `post` ( 
  `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) UNIQUE,   
  `slug` VARCHAR(255) UNIQUE,
  `userId` BIGINT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `status` enum('draft','publish','archive') NOT NULL DEFAULT 'draft',
  `image` LONGBLOB NULL,
  `about` VARCHAR(255) NULL,
  `body` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT NOW(),
  CONSTRAINT `rel_post_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

--
-- TABLE tags
--

CREATE TABLE IF NOT EXISTS `tags` ( 
  `postId` BIGINT NOT NULL,
  `tag` VARCHAR(255),   
  PRIMARY KEY (`postId`,`tag`),
  CONSTRAINT `rel_tag_post` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

