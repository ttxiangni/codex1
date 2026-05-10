-- FeiFei CMS database schema
-- Clean ASCII version with prefixed fields and partition support

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Video category table
-- ----------------------------
DROP TABLE IF EXISTS `ff_vod_type`;
CREATE TABLE `ff_vod_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  `type_en` varchar(100) DEFAULT NULL,
  `type_pid` int(11) DEFAULT '0',
  `type_sort` int(11) DEFAULT '0',
  `type_status` tinyint(1) DEFAULT '1',
  `type_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `type_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`),
  KEY `idx_type_pid` (`type_pid`),
  KEY `idx_type_sort` (`type_sort`),
  KEY `idx_type_status` (`type_status`),
  KEY `idx_type_en` (`type_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Video table
-- ----------------------------
DROP TABLE IF EXISTS `ff_vod`;
CREATE TABLE `ff_vod` (
  `vod_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `vod_name` varchar(255) NOT NULL,
  `vod_en` varchar(255) DEFAULT NULL,
  `vod_pic` varchar(500) DEFAULT NULL,
  `vod_actor` varchar(500) DEFAULT NULL,
  `vod_director` varchar(255) DEFAULT NULL,
  `vod_writer` varchar(255) DEFAULT NULL,
  `vod_year` year(4) DEFAULT NULL,
  `vod_area` varchar(50) DEFAULT NULL,
  `vod_lang` varchar(50) DEFAULT NULL,
  `vod_content` text,
  `vod_score` decimal(3,1) DEFAULT '0.0',
  `vod_hits` int(11) DEFAULT '0',
  `vod_status` tinyint(1) DEFAULT '1',
  `vod_is_vip` tinyint(1) DEFAULT '0',
  `vod_play_url` text,
  `vod_download_url` text,
  `vod_keywords` varchar(255) DEFAULT NULL,
  `vod_letter` char(1) DEFAULT NULL,
  `vod_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `vod_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vod_id`),
  KEY `idx_type_id` (`type_id`),
  KEY `idx_vod_year` (`vod_year`),
  KEY `idx_vod_area` (`vod_area`),
  KEY `idx_vod_lang` (`vod_lang`),
  KEY `idx_vod_status` (`vod_status`),
  KEY `idx_vod_hits` (`vod_hits`),
  KEY `idx_vod_letter` (`vod_letter`),
  KEY `idx_vod_create_time` (`vod_create_time`),
  KEY `idx_vod_en` (`vod_en`),
  FULLTEXT KEY `idx_vod_fulltext` (`vod_name`,`vod_actor`,`vod_director`,`vod_content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Article category table
-- ----------------------------
DROP TABLE IF EXISTS `ff_article_category`;
CREATE TABLE `ff_article_category` (
  `article_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_category_name` varchar(100) NOT NULL,
  `article_category_en` varchar(100) DEFAULT NULL,
  `article_category_description` varchar(255) DEFAULT NULL,
  `article_category_sort` int(11) DEFAULT '0',
  `article_category_status` tinyint(1) DEFAULT '1',
  `article_category_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `article_category_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_category_id`),
  KEY `idx_article_category_sort` (`article_category_sort`),
  KEY `idx_article_category_status` (`article_category_status`),
  KEY `idx_article_category_en` (`article_category_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Article table
-- ----------------------------
DROP TABLE IF EXISTS `ff_article`;
CREATE TABLE `ff_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_category_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_en` varchar(255) DEFAULT NULL,
  `article_content` longtext,
  `article_author` varchar(100) DEFAULT NULL,
  `article_thumbnail` varchar(500) DEFAULT NULL,
  `article_description` varchar(500) DEFAULT NULL,
  `article_keywords` varchar(255) DEFAULT NULL,
  `article_views` int(11) DEFAULT '0',
  `article_status` tinyint(1) DEFAULT '1',
  `article_is_recommend` tinyint(1) DEFAULT '0',
  `article_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `article_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`),
  KEY `idx_article_category_id` (`article_category_id`),
  KEY `idx_article_status` (`article_status`),
  KEY `idx_article_views` (`article_views`),
  KEY `idx_article_create_time` (`article_create_time`),
  KEY `idx_article_is_recommend` (`article_is_recommend`),
  KEY `idx_article_en` (`article_en`),
  FULLTEXT KEY `idx_article_fulltext` (`article_title`,`article_content`,`article_description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Actor table
-- ----------------------------
DROP TABLE IF EXISTS `ff_actor`;
CREATE TABLE `ff_actor` (
  `actor_id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_name` varchar(100) NOT NULL,
  `actor_en` varchar(100) DEFAULT NULL,
  `actor_english_name` varchar(100) DEFAULT NULL,
  `actor_avatar` varchar(500) DEFAULT NULL,
  `actor_gender` enum('男','女') DEFAULT NULL,
  `actor_birthday` date DEFAULT NULL,
  `actor_height` int(11) DEFAULT NULL,
  `actor_weight` int(11) DEFAULT NULL,
  `actor_constellation` varchar(20) DEFAULT NULL,
  `actor_blood_type` enum('A','B','AB','O') DEFAULT NULL,
  `actor_region` varchar(50) DEFAULT NULL,
  `actor_biography` text,
  `actor_views` int(11) DEFAULT '0',
  `actor_video_count` int(11) DEFAULT '0',
  `actor_status` tinyint(1) DEFAULT '1',
  `actor_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `actor_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`actor_id`),
  KEY `idx_actor_gender` (`actor_gender`),
  KEY `idx_actor_region` (`actor_region`),
  KEY `idx_actor_views` (`actor_views`),
  KEY `idx_actor_status` (`actor_status`),
  KEY `idx_actor_create_time` (`actor_create_time`),
  KEY `idx_actor_en` (`actor_en`),
  FULLTEXT KEY `idx_actor_fulltext` (`actor_name`,`actor_english_name`,`actor_biography`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Actor role table
-- ----------------------------
DROP TABLE IF EXISTS `ff_actor_role`;
CREATE TABLE `ff_actor_role` (
  `actor_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_role_actor_id` int(11) NOT NULL,
  `actor_role_vod_id` int(11) NOT NULL,
  `actor_role_name` varchar(100) DEFAULT NULL,
  `actor_role_en` varchar(100) DEFAULT NULL,
  `actor_role_description` text,
  `actor_role_sort` int(11) DEFAULT '0',
  `actor_role_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`actor_role_id`),
  UNIQUE KEY `idx_actor_role_actor_vod` (`actor_role_actor_id`,`actor_role_vod_id`),
  KEY `idx_actor_role_vod_id` (`actor_role_vod_id`),
  KEY `idx_actor_role_sort` (`actor_role_sort`),
  KEY `idx_actor_role_en` (`actor_role_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Episode table
-- ----------------------------
DROP TABLE IF EXISTS `ff_episode`;
CREATE TABLE `ff_episode` (
  `episode_id` int(11) NOT NULL AUTO_INCREMENT,
  `episode_vod_id` int(11) NOT NULL,
  `episode_title` varchar(255) NOT NULL,
  `episode_en` varchar(255) DEFAULT NULL,
  `episode_number` int(11) NOT NULL,
  `episode_plot` text,
  `episode_director` varchar(255) DEFAULT NULL,
  `episode_writer` varchar(255) DEFAULT NULL,
  `episode_actors` varchar(500) DEFAULT NULL,
  `episode_duration` varchar(50) DEFAULT NULL,
  `episode_air_date` date DEFAULT NULL,
  `episode_play_url` text,
  `episode_views` int(11) DEFAULT '0',
  `episode_status` tinyint(1) DEFAULT '1',
  `episode_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `episode_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`episode_id`),
  KEY `idx_episode_vod_id` (`episode_vod_id`),
  KEY `idx_episode_number` (`episode_number`),
  KEY `idx_episode_status` (`episode_status`),
  KEY `idx_episode_views` (`episode_views`),
  KEY `idx_episode_air_date` (`episode_air_date`),
  KEY `idx_episode_create_time` (`episode_create_time`),
  KEY `idx_episode_en` (`episode_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- User table
-- ----------------------------
DROP TABLE IF EXISTS `ff_user`;
CREATE TABLE `ff_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_avatar` varchar(500) DEFAULT NULL,
  `user_nickname` varchar(50) DEFAULT NULL,
  `user_gender` enum('男','女','保密') DEFAULT '保密',
  `user_birthday` date DEFAULT NULL,
  `user_signature` varchar(255) DEFAULT NULL,
  `user_level` int(11) DEFAULT '1',
  `user_points` int(11) DEFAULT '0',
  `user_status` tinyint(1) DEFAULT '1',
  `user_last_login_time` datetime DEFAULT NULL,
  `user_last_login_ip` varchar(45) DEFAULT NULL,
  `user_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `idx_user_username` (`user_username`),
  UNIQUE KEY `idx_user_email` (`user_email`),
  KEY `idx_user_status` (`user_status`),
  KEY `idx_user_level` (`user_level`),
  KEY `idx_user_create_time` (`user_create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Comment table
-- ----------------------------
DROP TABLE IF EXISTS `ff_comment`;
CREATE TABLE `ff_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_id` int(11) NOT NULL,
  `comment_vod_id` int(11) DEFAULT NULL,
  `comment_article_id` int(11) DEFAULT NULL,
  `comment_content` text NOT NULL,
  `comment_parent_id` int(11) DEFAULT '0',
  `comment_likes` int(11) DEFAULT '0',
  `comment_status` tinyint(1) DEFAULT '1',
  `comment_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `comment_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `idx_comment_vod_id` (`comment_vod_id`),
  KEY `idx_comment_article_id` (`comment_article_id`),
  KEY `idx_comment_parent_id` (`comment_parent_id`),
  KEY `idx_comment_status` (`comment_status`),
  KEY `idx_comment_create_time` (`comment_create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Favorite table
-- ----------------------------
DROP TABLE IF EXISTS `ff_favorite`;
CREATE TABLE `ff_favorite` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `favorite_user_id` int(11) NOT NULL,
  `favorite_vod_id` int(11) DEFAULT NULL,
  `favorite_article_id` int(11) DEFAULT NULL,
  `favorite_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favorite_id`),
  UNIQUE KEY `idx_favorite_user_vod` (`favorite_user_id`,`favorite_vod_id`),
  UNIQUE KEY `idx_favorite_user_article` (`favorite_user_id`,`favorite_article_id`),
  KEY `idx_favorite_create_time` (`favorite_create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Watch history table
-- ----------------------------
DROP TABLE IF EXISTS `ff_watch_history`;
CREATE TABLE `ff_watch_history` (
  `watch_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `watch_history_user_id` int(11) NOT NULL,
  `watch_history_vod_id` int(11) NOT NULL,
  `watch_history_episode_id` int(11) DEFAULT NULL,
  `watch_history_progress` int(11) DEFAULT '0',
  `watch_history_duration` int(11) DEFAULT '0',
  `watch_history_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `watch_history_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`watch_history_id`),
  UNIQUE KEY `idx_watch_history_user_vod` (`watch_history_user_id`,`watch_history_vod_id`),
  KEY `idx_watch_history_vod_id` (`watch_history_vod_id`),
  KEY `idx_watch_history_update_time` (`watch_history_update_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Message table
-- ----------------------------
DROP TABLE IF EXISTS `ff_message`;
CREATE TABLE `ff_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_sender_id` int(11) DEFAULT NULL,
  `message_receiver_id` int(11) NOT NULL,
  `message_title` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `message_type` enum('system','comment','private') DEFAULT 'private',
  `message_is_read` tinyint(1) DEFAULT '0',
  `message_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `idx_message_receiver_id` (`message_receiver_id`),
  KEY `idx_message_sender_id` (`message_sender_id`),
  KEY `idx_message_is_read` (`message_is_read`),
  KEY `idx_message_create_time` (`message_create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Page table
-- ----------------------------
DROP TABLE IF EXISTS `ff_page`;
CREATE TABLE `ff_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(50) NOT NULL,
  `page_key` varchar(100) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` longtext,
  `page_template` varchar(100) DEFAULT NULL,
  `page_status` tinyint(1) DEFAULT '1',
  `page_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `page_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `idx_page_type_key` (`page_type`,`page_key`),
  KEY `idx_page_status` (`page_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Setting table
-- ----------------------------
DROP TABLE IF EXISTS `ff_setting`;
CREATE TABLE `ff_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  `setting_type` enum('string','int','float','bool','json') DEFAULT 'string',
  `setting_group` varchar(50) DEFAULT 'system',
  `setting_description` varchar(255) DEFAULT NULL,
  `setting_create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `setting_update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `idx_setting_key` (`setting_key`),
  KEY `idx_setting_group` (`setting_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Sample data
-- ----------------------------
INSERT INTO `ff_vod_type` (`type_name`, `type_en`, `type_sort`, `type_status`) VALUES
('电影', 'dianying', 1, 1),
('电视剧', 'dianshiju', 2, 1),
('综艺', 'zongyi', 3, 1),
('动漫', 'dongman', 4, 1),
('纪录片', 'jilupian', 5, 1),
('体育', 'tiyu', 6, 1),
('音乐', 'yinyue', 7, 1),
('游戏', 'youxi', 8, 1);

INSERT INTO `ff_article_category` (`article_category_name`, `article_category_en`, `article_category_sort`, `article_category_status`) VALUES
('新闻资讯', 'xinwen', 1, 1),
('影评', 'yingping', 2, 1),
('娱乐八卦', 'yule', 3, 1),
('技术分享', 'jishu', 4, 1);

-- ----------------------------
-- Partition procedure
-- ----------------------------
DELIMITER ;;
CREATE PROCEDURE `create_vod_partition`(IN partition_year YEAR)
BEGIN
    DECLARE table_name VARCHAR(255);
    DECLARE sql_text TEXT;
    
    SET table_name = CONCAT('ff_vod_', partition_year);
    SET @sql = CONCAT('CREATE TABLE IF NOT EXISTS `', table_name, '` LIKE `ff_vod`;');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;;
DELIMITER ;

SET FOREIGN_KEY_CHECKS = 1;
