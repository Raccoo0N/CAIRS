/*
 Navicat Premium Data Transfer

 Source Server         : LOCUST_CC
 Source Server Type    : MySQL
 Source Server Version : 80036 (8.0.36-0ubuntu0.20.04.1)
 Source Host           : localhost:3306
 Source Schema         : cairs

 Target Server Type    : MySQL
 Target Server Version : 80036 (8.0.36-0ubuntu0.20.04.1)
 File Encoding         : 65001

 Date: 12/07/2024 18:42:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for parameters
-- ----------------------------
DROP TABLE IF EXISTS `parameters`;
CREATE TABLE `parameters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `name` text,
  `tunnel_inner_diameter` decimal(10,2) DEFAULT '0.00',
  `tunnel_outer_diameter` decimal(10,2) DEFAULT '0.00',
  `tunnel_depth` decimal(10,2) DEFAULT '0.00',
  `donor_cut_1_diameter` decimal(10,2) DEFAULT '0.00',
  `donor_cut_1_depth` decimal(10,2) DEFAULT '0.00',
  `donor_cut_2_diameter` decimal(10,2) DEFAULT '0.00',
  `donor_cut_2_depth` decimal(10,2) DEFAULT '0.00',
  `segment_width` decimal(10,2) DEFAULT '0.00',
  `segment_depth` decimal(10,2) DEFAULT '0.00',
  `status` int DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of parameters
-- ----------------------------
BEGIN;
INSERT INTO `parameters` (`id`, `uid`, `name`, `tunnel_inner_diameter`, `tunnel_outer_diameter`, `tunnel_depth`, `donor_cut_1_diameter`, `donor_cut_1_depth`, `donor_cut_2_diameter`, `donor_cut_2_depth`, `segment_width`, `segment_depth`, `status`) VALUES (1, 21, 'test 1', 11.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, 2);
INSERT INTO `parameters` (`id`, `uid`, `name`, `tunnel_inner_diameter`, `tunnel_outer_diameter`, `tunnel_depth`, `donor_cut_1_diameter`, `donor_cut_1_depth`, `donor_cut_2_diameter`, `donor_cut_2_depth`, `segment_width`, `segment_depth`, `status`) VALUES (2, 21, 'test 2', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2);
COMMIT;

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `parameters_id` int DEFAULT '0',
  `name` text,
  `settings` text,
  `status` int DEFAULT '2',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of plan
-- ----------------------------
BEGIN;
INSERT INTO `plan` (`id`, `uid`, `parameters_id`, `name`, `settings`, `status`, `date`) VALUES (1, 21, 1, 'last plans', NULL, 2, '2024-06-29 16:54:53');
INSERT INTO `plan` (`id`, `uid`, `parameters_id`, `name`, `settings`, `status`, `date`) VALUES (2, 21, 2, 'some plans', NULL, 2, '2024-06-29 17:58:12');
COMMIT;

-- ----------------------------
-- Table structure for retrieve
-- ----------------------------
DROP TABLE IF EXISTS `retrieve`;
CREATE TABLE `retrieve` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text,
  `code` text,
  `status` int DEFAULT '2',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of retrieve
-- ----------------------------
BEGIN;
INSERT INTO `retrieve` (`id`, `email`, `code`, `status`, `date`) VALUES (1, 'g0nz0@ya.ru', '4d511abdf0380e2a4ccfca3b6ba8bc0c', 5, '2024-06-29 14:39:48');
INSERT INTO `retrieve` (`id`, `email`, `code`, `status`, `date`) VALUES (2, 'g0nz0@ya.ru', '29dd7244511c6d4bd7017bbc2a8d9f0d', 5, '2024-06-29 14:44:04');
INSERT INTO `retrieve` (`id`, `email`, `code`, `status`, `date`) VALUES (3, 'g0nz0@ya.ru', 'dd4fc421883ebcd2e0e901a320f57748', 5, '2024-06-29 15:43:33');
COMMIT;

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `info` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of statuses
-- ----------------------------
BEGIN;
INSERT INTO `statuses` (`id`, `name`, `info`) VALUES (1, 'WAITING', 'Moderation state');
INSERT INTO `statuses` (`id`, `name`, `info`) VALUES (2, 'ENABLED', 'Active state');
INSERT INTO `statuses` (`id`, `name`, `info`) VALUES (3, 'DISABLED', 'Disabled state');
INSERT INTO `statuses` (`id`, `name`, `info`) VALUES (4, 'BLOCKED', 'Blocked state');
INSERT INTO `statuses` (`id`, `name`, `info`) VALUES (5, 'DELETED', 'Deletetd');
COMMIT;

-- ----------------------------
-- Table structure for usermeta
-- ----------------------------
DROP TABLE IF EXISTS `usermeta`;
CREATE TABLE `usermeta` (
  `umeta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=479 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of usermeta
-- ----------------------------
BEGIN;
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (1, 1, 'nickname', 'Brendan');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (2, 1, 'first_name', 'Brendan');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (3, 1, 'last_name', 'Cronin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (4, 1, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (5, 1, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (6, 1, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (7, 1, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (8, 1, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (9, 1, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (10, 1, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (11, 1, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (12, 1, 'ecLA4_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (13, 1, 'ecLA4_user_level', '10');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (14, 1, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (15, 1, 'show_welcome_panel', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (16, 1, 'ecLA4_elementor_connect_common_data', 'a:6:{s:9:\"client_id\";s:32:\"MW6azmQUD3IYmJVbeZKauWjmqs1ygnuF\";s:11:\"auth_secret\";s:32:\"WxeeHYuyEUgWFxa1nTzHYJoykHQTfcO1\";s:12:\"access_token\";s:292:\"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU2NzM3MzEsImF1ZCI6Imh0dHBzOi8vd3d3LmNhaXJzcGxhbi5jb20vIiwiY2xpZW50X2lkIjoiTVc2YXptUVVEM0lZbUpWYmVaS2F1V2ptcXMxeWdudUYiLCJjb25uZWN0X3R5cGUiOiJsaWJyYXJ5IiwiaWF0IjoxNzAxNzc4MTM2LCJleHAiOjMxNzI0NjIyMDUzNn0.y-L7nbCAAApjvdcb04gsGgIR6qSBS2R6uN7Pl8d55uo\";s:19:\"access_token_secret\";s:32:\"xtlrxDj4jZa5KVRbwh6z3RtIAo6fkjng\";s:10:\"token_type\";s:6:\"bearer\";s:4:\"user\";O:8:\"stdClass\":1:{s:5:\"email\";s:18:\"bgcronin@gmail.com\";}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (17, 1, 'ec_proficiency', 'beginner');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (19, 1, 'MY_ELEMENTOR_EMAIL', 'bgcronin@gmail.com');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (20, 1, 'ecLA4_dashboard_quick_press_last_post_id', '624');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (21, 1, 'ecLA4_persisted_preferences', 'a:2:{s:14:\"core/edit-post\";a:2:{s:26:\"isComplementaryAreaVisible\";b:1;s:12:\"welcomeGuide\";b:0;}s:9:\"_modified\";s:24:\"2023-10-04T11:34:39.556Z\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (22, 1, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (23, 1, 'metaboxhidden_nav-menus', 'a:2:{i:0;s:28:\"add-post-type-e-landing-page\";i:1;s:12:\"add-post_tag\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (24, 1, 'nav_menu_recently_edited', '2');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (25, 1, 'elementor_introduction', 'a:1:{s:20:\"globals_introduction\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (26, 1, 'ecLA4_user-settings', 'libraryContent=browse&editor=tinymce&hidetb=1');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (27, 1, 'ecLA4_user-settings-time', '1696441602');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (42, 3, 'nickname', 'Gunny');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (43, 3, 'first_name', 'David');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (44, 3, 'last_name', 'Gunn');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (45, 3, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (46, 3, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (47, 3, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (48, 3, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (49, 3, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (50, 3, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (51, 3, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (52, 3, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (53, 3, 'ecLA4_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (54, 3, 'ecLA4_user_level', '10');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (55, 3, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (56, 3, 'default_password_nag', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (57, 3, 'session_tokens', 'a:1:{s:64:\"6fd43d5398fc5138580aabc84e0bd73a8e720f436532c380a37528b1ff06e472\";a:4:{s:10:\"expiration\";i:1697272823;s:2:\"ip\";s:12:\"10.104.18.25\";s:2:\"ua\";s:117:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36\";s:5:\"login\";i:1697100023;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (58, 3, 'ecLA4_dashboard_quick_press_last_post_id', '215');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (71, 1, 'elementor_admin_notices', 'a:1:{s:20:\"design_not_appearing\";a:2:{s:9:\"is_viewed\";b:1;s:4:\"meta\";a:1:{s:7:\"version\";s:6:\"3.20.3\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (111, 1, 'ecLA4_elementor_pro_enable_notes_notifications', '1');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (112, 6, 'nickname', 'support@elementor.com');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (113, 6, 'first_name', 'elementor');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (114, 6, 'last_name', 'helpdesk');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (115, 6, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (116, 6, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (117, 6, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (118, 6, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (119, 6, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (120, 6, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (121, 6, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (122, 6, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (123, 6, 'ecLA4_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (124, 6, 'ecLA4_user_level', '10');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (125, 6, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (126, 7, 'nickname', 'Mikhail');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (127, 7, 'first_name', 'Mikhail');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (128, 7, 'last_name', 'Balaev');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (129, 7, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (130, 7, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (131, 7, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (132, 7, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (133, 7, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (134, 7, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (135, 7, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (136, 7, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (137, 7, 'ecLA4_capabilities', 'a:1:{s:13:\"administrator\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (138, 7, 'ecLA4_user_level', '10');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (139, 7, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (140, 7, 'default_password_nag', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (141, 7, 'ec_proficiency', 'unknown');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (143, 7, 'MY_ELEMENTOR_EMAIL', 'mikhailbalaev@gmail.com');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (144, 7, 'elementor_admin_notices', 'a:1:{s:20:\"design_not_appearing\";a:2:{s:9:\"is_viewed\";b:0;s:4:\"meta\";a:1:{s:7:\"version\";s:6:\"3.21.5\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (145, 7, 'ecLA4_dashboard_quick_press_last_post_id', '634');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (146, 7, 'ecLA4_persisted_preferences', 'a:2:{s:14:\"core/edit-post\";a:2:{s:26:\"isComplementaryAreaVisible\";b:1;s:12:\"welcomeGuide\";b:0;}s:9:\"_modified\";s:24:\"2023-12-26T07:06:39.898Z\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (147, 7, 'ecLA4_elementor_connect_common_data', 'a:7:{s:9:\"client_id\";s:32:\"Tx03g2oxRhsHkSuaGtZlvtzmpPU9lvgO\";s:11:\"auth_secret\";s:32:\"ECubh5MvRZwCpCEO8tK3T6oGZlX79S07\";s:12:\"access_token\";s:288:\"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU2NzM3MzEsImF1ZCI6Imh0dHBzOi8vY2FpcnNwbGFuLmNvbS8iLCJjbGllbnRfaWQiOiJUeDAzZzJveFJoc0hrU3VhR3RabHZ0em1wUFU5bHZnTyIsImNvbm5lY3RfdHlwZSI6ImFjdGl2YXRlIiwiaWF0IjoxNzEwMTA3MTA0LCJleHAiOjMxNzI1NDU0OTUwNH0.NYUb2FjilcaJ4IjZZF4Hgh6IOm74cYTtxsBOGedT9sg\";s:19:\"access_token_secret\";s:32:\"I6znlnpP0JY0ykNJrqP3QzU9RRPvCYqu\";s:10:\"token_type\";s:6:\"bearer\";s:4:\"user\";O:8:\"stdClass\":1:{s:5:\"email\";s:12:\"mb@xt3ch.com\";}s:19:\"data_share_opted_in\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (148, 1, '_new_email', 'a:2:{s:4:\"hash\";s:32:\"49e079802d1844ce3fd7c05b3e316b8f\";s:8:\"newemail\";s:12:\"mb@xt3ch.com\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (149, 7, 'closedpostboxes_page', 'a:0:{}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (150, 7, 'metaboxhidden_page', 'a:0:{}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (151, 7, 'meta-box-order_page', 'a:3:{s:6:\"normal\";s:0:\"\";s:8:\"advanced\";s:23:\"wpcode-metabox-snippets\";s:4:\"side\";s:0:\"\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (153, 7, 'nav_menu_recently_edited', '19');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (154, 7, 'managenav-menuscolumnshidden', 'a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (155, 7, 'metaboxhidden_nav-menus', 'a:3:{i:0;s:28:\"add-post-type-e-landing-page\";i:1;s:26:\"add-post-type-asp-products\";i:2;s:12:\"add-post_tag\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (177, 7, 'session_tokens', 'a:1:{s:64:\"2203eacb012785a6eed19c21dabe7bc077912aac217cac1ee4603b8ca84fb116\";a:4:{s:10:\"expiration\";i:1716156147;s:2:\"ip\";s:13:\"95.220.22.189\";s:2:\"ua\";s:84:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:125.0) Gecko/20100101 Firefox/125.0\";s:5:\"login\";i:1715983347;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (178, 7, 'clinic_name', 'Test Clinic');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (179, 7, 'surgeon_name', 'Test Name');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (180, 7, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (205, 7, 'community-events-location', 'a:1:{s:2:\"ip\";s:11:\"95.220.22.0\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (206, 7, 'elementor_introduction', 'a:1:{s:27:\"ai-get-started-announcement\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (207, 7, 'user_plans', 'a:2:{i:1;a:2:{s:9:\"plan_name\";s:4:\"test\";s:9:\"plan_data\";a:9:{s:6:\"axis_1\";s:2:\"90\";s:5:\"arc_1\";s:2:\"45\";s:10:\"incision_1\";s:3:\"180\";s:9:\"is_axis_2\";s:2:\"on\";s:6:\"axis_2\";s:2:\"90\";s:5:\"arc_2\";s:2:\"45\";s:10:\"incision_2\";s:1:\"0\";s:3:\"eye\";s:5:\"right\";s:11:\"load-params\";s:1:\"0\";}}i:2;a:2:{s:9:\"plan_name\";s:4:\"tttt\";s:9:\"plan_data\";a:12:{s:6:\"axis_1\";s:3:\"256\";s:5:\"arc_1\";s:3:\"284\";s:10:\"incision_1\";s:3:\"255\";s:9:\"is_axis_2\";s:2:\"on\";s:6:\"axis_2\";s:3:\"267\";s:5:\"arc_2\";s:3:\"196\";s:10:\"incision_2\";s:3:\"214\";s:9:\"firstname\";s:4:\"Test\";s:8:\"lastname\";s:4:\"Test\";s:5:\"notes\";s:5:\"hello\";s:3:\"eye\";s:5:\"right\";s:11:\"load-params\";s:1:\"0\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (208, 10, 'nickname', 'brendan.cronin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (209, 10, 'first_name', 'Brendan');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (210, 10, 'last_name', 'Cronin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (211, 10, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (212, 10, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (213, 10, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (214, 10, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (215, 10, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (216, 10, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (217, 10, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (218, 10, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (219, 10, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (220, 10, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (221, 10, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (222, 10, 'user_registration_user_code', 'Truda');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (223, 10, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (224, 10, 'ur_user_ip', '120.153.231.73');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (225, 10, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (226, 10, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (227, 10, 'session_tokens', 'a:2:{s:64:\"69fac19756d5283b7b8945ae4e2dd62e173962619cfdee90edcbd864533ad707\";a:4:{s:10:\"expiration\";i:1716285127;s:2:\"ip\";s:14:\"120.153.231.73\";s:2:\"ua\";s:119:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Safari/605.1.15\";s:5:\"login\";i:1716112327;}s:64:\"77e0a1717ee6861b244c6ade9688b11c2e22f099baeee232ff5299131f223901\";a:4:{s:10:\"expiration\";i:1716355678;s:2:\"ip\";s:14:\"159.196.12.106\";s:2:\"ua\";s:117:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36\";s:5:\"login\";i:1716182878;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (228, 10, 'clinic_name', 'Queensland Eye Institute');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (229, 10, 'surgeon_name', 'Dr Brendan Cronin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (230, 10, 'user_registration_profile_pic_url', '623');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (258, 7, 'user_parameters', 'a:3:{i:1;a:2:{s:15:\"parameters_name\";s:4:\"test\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:3:\"333\";s:21:\"tunnel-outer-diameter\";s:2:\"33\";s:12:\"tunnel-depth\";s:2:\"33\";s:20:\"donor-cut-1-diameter\";s:2:\"33\";s:17:\"donor-cut-1-depth\";s:2:\"33\";s:20:\"donor-cut-2-diameter\";s:3:\"333\";s:17:\"donor-cut-2-depth\";s:2:\"33\";s:13:\"segment-width\";s:0:\"\";s:13:\"segment-depth\";s:0:\"\";s:14:\"saveParameters\";s:0:\"\";}}i:2;a:2:{s:15:\"parameters_name\";s:6:\"test 2\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:2:\"11\";s:21:\"tunnel-outer-diameter\";s:2:\"11\";s:12:\"tunnel-depth\";s:2:\"11\";s:20:\"donor-cut-1-diameter\";s:2:\"11\";s:17:\"donor-cut-1-depth\";s:2:\"11\";s:20:\"donor-cut-2-diameter\";s:2:\"11\";s:17:\"donor-cut-2-depth\";s:2:\"11\";s:13:\"segment-width\";s:2:\"11\";s:13:\"segment-depth\";s:2:\"11\";s:14:\"saveParameters\";s:0:\"\";}}i:3;a:2:{s:15:\"parameters_name\";s:7:\"3453453\";s:15:\"parameters_data\";a:9:{s:21:\"tunnel-inner-diameter\";s:2:\"11\";s:21:\"tunnel-outer-diameter\";s:2:\"11\";s:12:\"tunnel-depth\";s:2:\"11\";s:20:\"donor-cut-1-diameter\";s:2:\"11\";s:17:\"donor-cut-1-depth\";s:2:\"11\";s:20:\"donor-cut-2-diameter\";s:2:\"11\";s:17:\"donor-cut-2-depth\";s:2:\"11\";s:13:\"segment-width\";s:2:\"11\";s:13:\"segment-depth\";s:2:\"11\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (260, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:13:\"152.171.224.0\";}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (261, 7, '_clinic_name', 'field_65eae601e1dd4');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (262, 7, '_surgeon_name', 'field_65eae629e1dd5');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (283, 13, 'nickname', 'zaskia.tang');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (284, 13, 'first_name', 'Zaskia');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (285, 13, 'last_name', 'Tang');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (286, 13, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (287, 13, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (288, 13, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (289, 13, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (290, 13, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (291, 13, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (292, 13, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (293, 13, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (294, 13, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (295, 13, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (296, 13, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (297, 13, 'user_registration_user_code', '2020');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (298, 13, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (299, 13, 'ur_user_ip', '130.95.191.2');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (300, 13, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (301, 13, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (302, 13, 'session_tokens', 'a:2:{s:64:\"8cdf189f605038c9f10a3b355715e4fd0671827851a513b96b229e301044581a\";a:4:{s:10:\"expiration\";i:1712971882;s:2:\"ip\";s:12:\"130.95.191.2\";s:2:\"ua\";s:125:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0\";s:5:\"login\";i:1712799082;}s:64:\"3ae92a39734822893bc478b8a79d1ecd681dd29c839e6cbf7b30feeb890d8a06\";a:4:{s:10:\"expiration\";i:1712999533;s:2:\"ip\";s:12:\"130.95.191.2\";s:2:\"ua\";s:125:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0\";s:5:\"login\";i:1712826733;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (303, 13, 'clinic_name', 'Lions Eye Institute');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (304, 13, 'surgeon_name', 'Dr Evan Wong');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (305, 13, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (306, 13, 'user_plans', 'a:1:{i:1;a:2:{s:9:\"plan_name\";s:6:\"Rana H\";s:9:\"plan_data\";a:28:{s:6:\"axis_1\";s:3:\"247\";s:5:\"arc_1\";s:3:\"138\";s:10:\"incision_1\";s:3:\"178\";s:9:\"is_axis_2\";s:2:\"on\";s:6:\"axis_2\";s:2:\"91\";s:5:\"arc_2\";s:2:\"45\";s:10:\"incision_2\";s:3:\"316\";s:9:\"firstname\";s:1:\"H\";s:8:\"lastname\";s:1:\"R\";s:10:\"birth-date\";s:2:\"16\";s:11:\"birth-month\";s:4:\"Jan.\";s:10:\"birth-year\";s:4:\"1982\";s:9:\"patientid\";s:6:\"762952\";s:3:\"eye\";s:4:\"left\";s:4:\"bcva\";s:5:\"6/6-1\";s:17:\"refraction_sphere\";s:1:\"0\";s:19:\"refraction_cylinder\";s:4:\"-6.5\";s:15:\"refraction_axis\";s:3:\"100\";s:21:\"tunnel-inner-diameter\";s:1:\"5\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"200\";s:20:\"donor-cut-1-diameter\";s:1:\"5\";s:17:\"donor-cut-1-depth\";s:1:\"7\";s:11:\"load-params\";s:1:\"0\";s:20:\"donor-cut-2-diameter\";s:1:\"5\";s:17:\"donor-cut-2-depth\";s:1:\"7\";s:13:\"segment-width\";s:3:\"500\";s:13:\"segment-depth\";s:3:\"200\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (307, 14, 'nickname', 'ammar.issa');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (308, 14, 'first_name', 'Ammar');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (309, 14, 'last_name', 'Issa');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (310, 14, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (311, 14, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (312, 14, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (313, 14, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (314, 14, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (315, 14, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (316, 14, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (317, 14, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (318, 14, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (319, 14, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (320, 14, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (321, 14, 'user_registration_user_code', 'Amm1234ar');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (322, 14, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (323, 14, 'ur_user_ip', '169.224.5.16');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (324, 14, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (325, 14, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (326, 14, 'session_tokens', 'a:1:{s:64:\"fd233865f7407a71c288ca55436c4f23ec8da9cc4608c5886e7bca2f6c06e81a\";a:4:{s:10:\"expiration\";i:1713814178;s:2:\"ip\";s:12:\"169.224.5.16\";s:2:\"ua\";s:125:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0\";s:5:\"login\";i:1713641378;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (327, 14, 'clinic_name', 'Dr. Ammar Eye Clinic');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (328, 14, 'surgeon_name', 'Dr. Ammar Issa');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (329, 14, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (330, 14, 'user_parameters', 'a:1:{i:1;a:2:{s:15:\"parameters_name\";s:7:\"Default\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:1:\"6\";s:17:\"donor-cut-1-depth\";s:3:\"300\";s:20:\"donor-cut-2-diameter\";s:0:\"\";s:17:\"donor-cut-2-depth\";s:0:\"\";s:13:\"segment-width\";s:0:\"\";s:13:\"segment-depth\";s:0:\"\";s:14:\"saveParameters\";s:0:\"\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (331, 14, 'user_plans', 'a:1:{i:1;a:2:{s:9:\"plan_name\";s:28:\"احمد حسين شعبان\";s:9:\"plan_data\";a:21:{s:6:\"axis_1\";s:3:\"297\";s:5:\"arc_1\";s:3:\"169\";s:10:\"incision_1\";s:3:\"180\";s:9:\"is_axis_2\";s:2:\"on\";s:6:\"axis_2\";s:2:\"90\";s:5:\"arc_2\";s:2:\"45\";s:10:\"incision_2\";s:1:\"0\";s:9:\"firstname\";s:28:\"احمد حسين شعبان\";s:8:\"lastname\";s:28:\"احمد حسين شعبان\";s:10:\"birth-year\";s:4:\"2000\";s:9:\"patientid\";s:8:\"50084999\";s:3:\"eye\";s:4:\"left\";s:4:\"bcva\";s:4:\"6/18\";s:4:\"ucva\";s:4:\"6/18\";s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:3:\"7.5\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:1:\"6\";s:17:\"donor-cut-1-depth\";s:3:\"500\";s:11:\"load-params\";s:1:\"1\";s:12:\"surgeon_name\";s:14:\"Dr. Ammar Issa\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (332, 15, 'nickname', 'zakariahassanin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (333, 15, 'first_name', 'Zakaria');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (334, 15, 'last_name', 'Hassanin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (335, 15, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (336, 15, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (337, 15, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (338, 15, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (339, 15, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (340, 15, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (341, 15, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (342, 15, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (343, 15, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (344, 15, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (345, 15, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (346, 15, 'user_registration_user_code', '258085');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (347, 15, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (348, 15, 'ur_user_ip', '41.37.87.61');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (349, 15, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (350, 15, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (351, 15, 'session_tokens', 'a:1:{s:64:\"942cb203a8e96f22da5225c3d35879d585e1ab556b82f50feac63320f7a7156b\";a:4:{s:10:\"expiration\";i:1714080635;s:2:\"ip\";s:11:\"41.37.87.61\";s:2:\"ua\";s:119:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Safari/605.1.15\";s:5:\"login\";i:1713907835;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (352, 15, 'clinic_name', 'Zakaria Hassanin Eye Clinic');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (353, 15, 'surgeon_name', 'Zakaria Hassanin');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (354, 15, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (355, 16, 'nickname', 'jojtaz');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (356, 16, 'first_name', 'Tester');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (357, 16, 'last_name', 'Tester');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (358, 16, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (359, 16, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (360, 16, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (361, 16, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (362, 16, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (363, 16, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (364, 16, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (365, 16, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (366, 16, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (367, 16, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (368, 16, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (369, 16, 'user_registration_user_code', 'zxzxzx');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (370, 16, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (371, 16, 'ur_user_ip', '176.213.151.192');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (372, 16, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (373, 16, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (375, 17, 'nickname', 'vd');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (376, 17, 'first_name', 'Victor');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (377, 17, 'last_name', 'Derhartunian');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (378, 17, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (379, 17, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (380, 17, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (381, 17, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (382, 17, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (383, 17, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (384, 17, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (385, 17, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (386, 17, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (387, 17, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (388, 17, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (389, 17, 'user_registration_user_code', '291076');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (390, 17, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (391, 17, 'ur_user_ip', '89.144.222.130');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (392, 17, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (393, 17, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (394, 17, 'session_tokens', 'a:1:{s:64:\"0a97de6bbf2115ce9b14e7b3b89a9129e72a4015d52ff02838f8ad21ec090920\";a:4:{s:10:\"expiration\";i:1714728502;s:2:\"ip\";s:14:\"89.144.222.130\";s:2:\"ua\";s:117:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36\";s:5:\"login\";i:1714555702;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (395, 17, 'clinic_name', 'EyeLaser');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (396, 17, 'surgeon_name', 'Victor Derhartunian');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (397, 17, 'user_registration_profile_pic_url', '631');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (398, 17, 'user_parameters', 'a:1:{i:1;a:2:{s:15:\"parameters_name\";s:8:\"Standard\";s:15:\"parameters_data\";a:3:{s:21:\"tunnel-inner-diameter\";s:1:\"5\";s:21:\"tunnel-outer-diameter\";s:4:\"7.25\";s:12:\"tunnel-depth\";s:3:\"200\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (399, 18, 'nickname', 'p_r_andrews');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (400, 18, 'first_name', 'Peter');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (401, 18, 'last_name', 'Andrews');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (402, 18, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (403, 18, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (404, 18, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (405, 18, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (406, 18, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (407, 18, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (408, 18, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (409, 18, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (410, 18, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (411, 18, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (412, 18, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (413, 18, 'user_registration_user_code', '7673');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (414, 18, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (415, 18, 'ur_user_ip', '198.0.225.89');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (416, 18, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (417, 18, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (418, 18, 'session_tokens', 'a:1:{s:64:\"3b4ad2bd320e8eb4c75783b693ea6e9c049a725646c55dc593859521eb36292b\";a:4:{s:10:\"expiration\";i:1715380056;s:2:\"ip\";s:12:\"198.0.225.89\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36\";s:5:\"login\";i:1715207256;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (419, 18, 'clinic_name', 'Nvision Downtown Sacramento');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (420, 18, 'surgeon_name', 'Peter R. Andrews, MD');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (421, 18, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (422, 18, 'user_parameters', 'a:1:{i:1;a:2:{s:15:\"parameters_name\";s:18:\"Basic CAIRS tunnel\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:0:\"\";s:17:\"donor-cut-1-depth\";s:0:\"\";s:20:\"donor-cut-2-diameter\";s:0:\"\";s:17:\"donor-cut-2-depth\";s:0:\"\";s:13:\"segment-width\";s:0:\"\";s:13:\"segment-depth\";s:0:\"\";s:14:\"saveParameters\";s:0:\"\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (423, 18, 'user_plans', 'a:3:{i:1;a:2:{s:9:\"plan_name\";s:11:\"T.Hudson.OD\";s:9:\"plan_data\";a:25:{s:6:\"axis_1\";s:3:\"270\";s:6:\"axis_2\";s:2:\"90\";s:9:\"is_axis_2\";s:2:\"on\";s:10:\"incision_1\";s:3:\"180\";s:18:\"capture_satellites\";s:7:\"checked\";s:5:\"arc_1\";s:3:\"120\";s:5:\"arc_2\";s:3:\"120\";s:10:\"incision_2\";s:1:\"0\";s:10:\"birth-date\";s:2:\"21\";s:11:\"birth-month\";s:4:\"June\";s:10:\"birth-year\";s:4:\"1960\";s:9:\"patientid\";s:10:\"EMA7151727\";s:5:\"notes\";s:17:\"-5.50 -0.25 x 010\";s:3:\"eye\";s:5:\"right\";s:4:\"bcva\";s:5:\"20/60\";s:4:\"ucva\";s:5:\"20/80\";s:17:\"refraction_sphere\";s:5:\"-5.50\";s:19:\"refraction_cylinder\";s:5:\"-0.25\";s:15:\"refraction_axis\";s:2:\"10\";s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:3:\"6.1\";s:11:\"load-params\";s:1:\"1\";s:13:\"segment-width\";s:2:\"50\";}}i:2;a:2:{s:9:\"plan_name\";s:11:\"T.Hudson.OD\";s:9:\"plan_data\";a:28:{s:6:\"axis_1\";s:3:\"293\";s:6:\"axis_2\";s:2:\"77\";s:9:\"is_axis_2\";s:2:\"77\";s:10:\"incision_1\";s:3:\"203\";s:18:\"capture_satellites\";s:7:\"checked\";s:5:\"arc_1\";s:3:\"125\";s:5:\"arc_2\";s:3:\"109\";s:10:\"incision_2\";s:2:\"23\";s:10:\"birth-date\";s:2:\"21\";s:11:\"birth-month\";s:4:\"June\";s:10:\"birth-year\";s:4:\"1960\";s:9:\"patientid\";s:10:\"EMA7151727\";s:5:\"notes\";s:17:\"-5.50 -0.25 x 010\";s:3:\"eye\";s:5:\"right\";s:4:\"bcva\";s:5:\"20/60\";s:4:\"ucva\";s:5:\"20/80\";s:17:\"refraction_sphere\";s:5:\"-5.50\";s:19:\"refraction_cylinder\";s:5:\"-0.25\";s:15:\"refraction_axis\";s:2:\"10\";s:21:\"tunnel-inner-diameter\";s:3:\"4.4\";s:21:\"tunnel-outer-diameter\";s:3:\"7.1\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:3:\"7.0\";s:17:\"donor-cut-1-depth\";s:3:\"250\";s:11:\"load-params\";s:1:\"1\";s:20:\"donor-cut-2-diameter\";s:3:\"4.5\";s:17:\"donor-cut-2-depth\";s:3:\"250\";s:12:\"surgeon_name\";s:20:\"Peter R. Andrews, MD\";}}i:3;a:2:{s:9:\"plan_name\";s:11:\"T.Hudson.OD\";s:9:\"plan_data\";a:28:{s:6:\"axis_1\";s:3:\"293\";s:6:\"axis_2\";s:2:\"77\";s:9:\"is_axis_2\";s:2:\"77\";s:10:\"incision_1\";s:3:\"203\";s:18:\"capture_satellites\";s:7:\"checked\";s:5:\"arc_1\";s:3:\"125\";s:5:\"arc_2\";s:3:\"109\";s:10:\"incision_2\";s:2:\"23\";s:10:\"birth-date\";s:2:\"21\";s:11:\"birth-month\";s:4:\"June\";s:10:\"birth-year\";s:4:\"1960\";s:9:\"patientid\";s:10:\"EMA7151727\";s:5:\"notes\";s:17:\"Plan thin segment\";s:3:\"eye\";s:5:\"right\";s:4:\"bcva\";s:5:\"20/60\";s:4:\"ucva\";s:5:\"20/80\";s:17:\"refraction_sphere\";s:5:\"-5.50\";s:19:\"refraction_cylinder\";s:5:\"-0.25\";s:15:\"refraction_axis\";s:2:\"10\";s:21:\"tunnel-inner-diameter\";s:3:\"4.4\";s:21:\"tunnel-outer-diameter\";s:3:\"7.1\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:3:\"7.0\";s:17:\"donor-cut-1-depth\";s:3:\"250\";s:11:\"load-params\";s:1:\"1\";s:20:\"donor-cut-2-diameter\";s:3:\"4.5\";s:17:\"donor-cut-2-depth\";s:3:\"250\";s:12:\"surgeon_name\";s:20:\"Peter R. Andrews, MD\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (424, 19, 'nickname', 'takamed');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (425, 19, 'first_name', 'Takahiko');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (426, 19, 'last_name', 'Hayashi');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (427, 19, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (428, 19, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (429, 19, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (430, 19, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (431, 19, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (432, 19, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (433, 19, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (434, 19, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (435, 19, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (436, 19, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (437, 19, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (438, 19, 'user_registration_user_code', '435134');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (439, 19, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (440, 19, 'ur_user_ip', '240f:7f:deb3:1:4de8:9dc8:b098:89c7');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (441, 19, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (442, 19, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (443, 19, 'session_tokens', 'a:1:{s:64:\"9a1a00a21abcd18454bad650bceef4350a18c798e8047555d930ee0ad87cc2cf\";a:4:{s:10:\"expiration\";i:1715430689;s:2:\"ip\";s:34:\"240f:7f:deb3:1:4de8:9dc8:b098:89c7\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36\";s:5:\"login\";i:1715257889;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (444, 19, 'clinic_name', 'NIhon University');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (445, 19, 'surgeon_name', 'Takahiko Hayashi');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (446, 19, 'user_registration_profile_pic_url', '633');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (447, 19, 'user_parameters', 'a:1:{i:1;a:2:{s:15:\"parameters_name\";s:20:\"Manual CAIRS Hayashi\";s:15:\"parameters_data\";a:6:{s:21:\"tunnel-inner-diameter\";s:1:\"6\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:20:\"donor-cut-1-diameter\";s:1:\"7\";s:20:\"donor-cut-2-diameter\";s:1:\"6\";s:13:\"segment-width\";s:3:\"500\";s:13:\"segment-depth\";s:3:\"250\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (448, 16, 'session_tokens', 'a:1:{s:64:\"e8f6343b993791ffa2135e833732930d2277bc3b27f7d69b3ed1f821b13602b4\";a:4:{s:10:\"expiration\";i:1715477419;s:2:\"ip\";s:13:\"95.220.22.189\";s:2:\"ua\";s:84:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:125.0) Gecko/20100101 Firefox/125.0\";s:5:\"login\";i:1715304619;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (449, 20, 'nickname', 'idr');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (450, 20, 'first_name', 'Dylan');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (451, 20, 'last_name', 'Joseph');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (452, 20, 'description', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (453, 20, 'rich_editing', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (454, 20, 'syntax_highlighting', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (455, 20, 'comment_shortcuts', 'false');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (456, 20, 'admin_color', 'fresh');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (457, 20, 'use_ssl', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (458, 20, 'show_admin_bar_front', 'true');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (459, 20, 'locale', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (460, 20, 'ecLA4_capabilities', 'a:1:{s:5:\"guest\";b:1;}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (461, 20, 'ecLA4_user_level', '0');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (462, 20, 'dismissed_wp_pointers', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (463, 20, 'user_registration_user_code', '1234');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (464, 20, 'ur_form_id', '596');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (465, 20, 'ur_user_ip', '165.255.244.20');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (466, 20, 'ur_login_option', 'auto_login');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (467, 20, 'ur_registered_language', 'en-US');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (468, 20, 'session_tokens', 'a:1:{s:64:\"66a6392beebd9985874e16460c26bb5b5c0eaa645dbd15f8dfb017ab5c2a50e3\";a:4:{s:10:\"expiration\";i:1715856817;s:2:\"ip\";s:14:\"165.255.244.20\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36\";s:5:\"login\";i:1715684017;}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (469, 20, 'clinic_name', 'Vision for Life Clinic');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (470, 20, 'surgeon_name', 'Dylan Joseph');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (471, 20, 'user_registration_profile_pic_url', '');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (472, 10, 'user_parameters', 'a:2:{i:1;a:2:{s:15:\"parameters_name\";s:7:\"X Large\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:1:\"6\";s:17:\"donor-cut-1-depth\";s:3:\"500\";s:20:\"donor-cut-2-diameter\";s:1:\"4\";s:17:\"donor-cut-2-depth\";s:3:\"550\";s:13:\"segment-width\";s:0:\"\";s:13:\"segment-depth\";s:0:\"\";s:14:\"saveParameters\";s:0:\"\";}}i:2;a:2:{s:15:\"parameters_name\";s:5:\"Large\";s:15:\"parameters_data\";a:10:{s:21:\"tunnel-inner-diameter\";s:1:\"4\";s:21:\"tunnel-outer-diameter\";s:1:\"7\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:1:\"5\";s:17:\"donor-cut-1-depth\";s:3:\"500\";s:20:\"donor-cut-2-diameter\";s:1:\"4\";s:17:\"donor-cut-2-depth\";s:3:\"550\";s:13:\"segment-width\";s:0:\"\";s:13:\"segment-depth\";s:0:\"\";s:14:\"saveParameters\";s:0:\"\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (473, 10, 'user_plans', 'a:2:{i:1;a:2:{s:9:\"plan_name\";s:12:\"Lord Test LE\";s:9:\"plan_data\";a:28:{s:6:\"axis_1\";s:3:\"257\";s:6:\"axis_2\";s:2:\"90\";s:10:\"incision_1\";s:3:\"167\";s:9:\"is_axis_2\";s:2:\"on\";s:18:\"capture_satellites\";s:7:\"checked\";s:5:\"arc_1\";s:3:\"120\";s:5:\"arc_2\";s:3:\"120\";s:10:\"incision_2\";s:3:\"347\";s:10:\"birth-date\";s:1:\"5\";s:11:\"birth-month\";s:4:\"Apr.\";s:10:\"birth-year\";s:4:\"1983\";s:9:\"patientid\";s:6:\"223329\";s:5:\"notes\";s:9:\"Lord Test\";s:3:\"eye\";s:4:\"left\";s:4:\"bcva\";s:3:\"6/5\";s:4:\"ucva\";s:4:\"6/36\";s:17:\"refraction_sphere\";s:4:\"0.50\";s:19:\"refraction_cylinder\";s:5:\"-2.50\";s:15:\"refraction_axis\";s:2:\"16\";s:21:\"tunnel-inner-diameter\";s:3:\"4.5\";s:21:\"tunnel-outer-diameter\";s:3:\"7.0\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:3:\"6.3\";s:17:\"donor-cut-1-depth\";s:3:\"500\";s:11:\"load-params\";s:1:\"2\";s:20:\"donor-cut-2-diameter\";s:3:\"4.6\";s:17:\"donor-cut-2-depth\";s:3:\"550\";s:13:\"segment-width\";s:3:\"900\";}}i:2;a:2:{s:9:\"plan_name\";s:12:\"Lord Test LE\";s:9:\"plan_data\";a:28:{s:6:\"axis_1\";s:3:\"257\";s:6:\"axis_2\";s:2:\"90\";s:10:\"incision_1\";s:3:\"167\";s:9:\"is_axis_2\";s:2:\"on\";s:18:\"capture_satellites\";s:7:\"checked\";s:5:\"arc_1\";s:3:\"120\";s:5:\"arc_2\";s:3:\"120\";s:10:\"incision_2\";s:3:\"347\";s:10:\"birth-date\";s:1:\"5\";s:11:\"birth-month\";s:4:\"Apr.\";s:10:\"birth-year\";s:4:\"1983\";s:9:\"patientid\";s:6:\"223329\";s:5:\"notes\";s:9:\"Lord Test\";s:3:\"eye\";s:4:\"left\";s:4:\"bcva\";s:3:\"6/5\";s:4:\"ucva\";s:4:\"6/36\";s:17:\"refraction_sphere\";s:4:\"0.50\";s:19:\"refraction_cylinder\";s:5:\"-2.50\";s:15:\"refraction_axis\";s:2:\"16\";s:21:\"tunnel-inner-diameter\";s:3:\"4.5\";s:21:\"tunnel-outer-diameter\";s:3:\"7.0\";s:12:\"tunnel-depth\";s:3:\"250\";s:20:\"donor-cut-1-diameter\";s:3:\"6.3\";s:17:\"donor-cut-1-depth\";s:3:\"500\";s:11:\"load-params\";s:1:\"2\";s:20:\"donor-cut-2-diameter\";s:3:\"4.6\";s:17:\"donor-cut-2-depth\";s:3:\"550\";s:13:\"segment-width\";s:3:\"900\";}}}');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (474, 21, 'first_name', 'William');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (475, 21, 'code', '123456');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (476, 22, 'first_name', 'William');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (477, 22, 'last_name', 'Postoronnim');
INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (478, 22, 'code', '123456');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (1, 'wpadminuser', '$P$BfTM4H8OZmNiLd.Ul1brvLiu2rO0Tu.', 'wpadminuser', 'bgcronin@gmail.com', 'https://cairsplan.com', '2023-09-27 11:09:24', '1711172349:$P$BxLn22EiqT5aq4Y5uVxyUBJZRmss0s/', 0, 'Brendan');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (3, 'Gunny', '$P$B7bIxbMW5EV9XYAp8CDJaOLBLFgXl00', 'gunny', 'drdavidgunn@gmail.com', '', '2023-10-11 11:57:32', '1716176316:$P$BEBeGTbfhLS5HfEL4SHgsFepbNea.Z1', 0, 'David Gunn');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (6, 'support@elementor.com', '$P$BkhJdqaSQlx7NvfDVlBnDcqfTubSAd.', 'supportelementor-com', 'support@elementor.com', '', '2023-12-26 03:09:24', '', 0, 'elementor helpdesk');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (7, 'Mikhail', '$P$Bhe2aaHGrqgUZ5wGn7RnipebMRRzRZ.', 'mikhail', 'mikhailbalaev@gmail.com', '', '2023-12-26 06:59:16', '1714833488:$P$BpMYGEPSj0f620djVKbeyJs8D9wPbd1', 0, 'Mikhail Balaev');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (10, 'brendan.cronin', '$P$BzMIgDa6akTR86BBy0DaH/GPN2GF/J.', 'brendan-cronin', 'brendan.cronin@qei.org.au', '', '2024-03-24 03:00:07', '', 0, 'brendan.cronin');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (13, 'zaskia.tang', '$P$BxxK94cfKq8lLNGGdloxxNFna3g9Qu.', 'zaskia-tang', 'zaskia.tang@lei.org.au', '', '2024-04-11 01:31:22', '', 0, 'zaskia.tang');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (14, 'ammar.issa', '$P$BVSphrOyhlBQqYZcZmjKomD2fFu/p11', 'ammar-issa', 'ammar.issa@hotmail.com', '', '2024-04-20 19:29:38', '', 0, 'ammar.issa');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (15, 'zakariahassanin', '$P$B3JpjXlzXFJI5.oAYtb7p5NN.5dizg.', 'zakariahassanin', 'zakariahassanin@yahoo.com', '', '2024-04-23 21:30:35', '', 0, 'zakariahassanin');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (16, 'jojtaz', '$P$BHHOcPaSMNGFgp0q8C08jFHAdMiQ.k0', 'jojtaz', 'jojtaz@xdhhc.com', '', '2024-04-27 13:30:54', '', 0, 'jojtaz');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (17, 'vd', '$P$Bv.f0v4esk/N92IlveqOfcmU.7Ht56/', 'vd', 'vd@eyelaser.at', '', '2024-05-01 09:28:22', '', 0, 'vd');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (18, 'p_r_andrews', '$P$Bn.2BU2o3D9Ad4WPI8wpAFHdxjSPqw0', 'p_r_andrews', 'p_r_andrews@yahoo.com', '', '2024-05-08 22:27:36', '', 0, 'p_r_andrews');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (19, 'takamed', '$P$BiRqUCjSvsv45mbs0.F7DfTQWdgakD1', 'takamed', 'takamed@gmail.com', '', '2024-05-09 12:31:29', '', 0, 'takamed');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (20, 'idr', '$P$BmtccouqLG7Y72Qle3J0TfoQUz3sVi/', 'idr', 'idr@drdylanjoseph.com', '', '2024-05-14 10:53:37', '', 0, 'idr');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (21, 'g0nz0@ya.ru', 'd07c82b9922317ab601e4f762e4d2b3c', '', 'g0nz0@ya.ru', '', '0000-00-00 00:00:00', '', 0, '');
INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (22, 'aleksia.sky@gmail.com', 'd07c82b9922317ab601e4f762e4d2b3c', '', 'aleksia.sky@gmail.com', '', '2024-06-30 00:28:09', '', 0, '');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
