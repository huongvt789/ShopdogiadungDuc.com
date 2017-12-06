SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(11)  NOT NULL AUTO_INCREMENT ,
    `code` varchar(255)  NULL  ,
    `name` varchar(255)  NULL  ,
    `username` varchar(255)  NOT NULL  ,
    `image` varchar(300)  NULL  ,
    `overview` varchar(2000)  NULL  ,
    `content` text  NULL  ,
    `auth_key` varchar(32)  NOT NULL  ,
    `password_hash` varchar(255)  NOT NULL  ,
    `password_reset_token` varchar(255)  NULL  ,
    `birth_date` date  NULL  ,
    `birth_place` varchar(255)  NULL  ,
    `gender` varchar(100)  NULL  ,
    `identity_card` varchar(255)  NULL  ,
    `email` varchar(255)  NOT NULL  ,
    `phone` varchar(255)  NULL  ,
    `skype` varchar(255)  NULL  ,
    `address` varchar(2000)  NULL  ,
    `country` varchar(100)  NULL  ,
    `state` varchar(100)  NULL  ,
    `city` varchar(100)  NULL  ,
    `post_code` varchar(255)  NULL  ,
    `organization` varchar(100)  NULL  ,
    `department` varchar(100)  NULL  ,
    `position` varchar(100)  NULL  ,
    `start_date` date  NULL  ,
    `end_date` date  NULL  ,
    `lat` int(11)  NULL  ,
    `long` int(11)  NULL  ,
    `rate` float  NULL  ,
    `rate_count` int(11)  NULL  ,
    `card_number` varchar(255)  NULL  ,
    `card_name` varchar(255)  NULL  ,
    `card_exp` varchar(255)  NULL  ,
    `card_cvv` varchar(255)  NULL  ,
    `balance` decimal(10,0)  NULL  ,
    `point` int(11)  NULL  ,
    `role` int(2)  NULL   COMMENT data:10:USER,20:MODERATOR,30:ADMIN,
    `type` varchar(100)  NULL  ,
    `status` smallint(6) DEFAULT 10 NOT NULL   COMMENT data:DISABLED=0,ACTIVE=10,
    `is_online` tinyint(1)  NULL  ,
    `last_login` datetime  NULL  ,
    `last_logout` datetime  NULL  ,
    `created_at` int(11)  NOT NULL  ,
    `updated_at` int(11)  NOT NULL  ,
    `application_id` varchar(100)  NULL  ,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


