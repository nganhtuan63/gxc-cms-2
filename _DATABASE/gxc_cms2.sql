-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2012 at 05:13 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gxc_cms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `gxc_auth_assignment`
--

CREATE TABLE `gxc_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_auth_assignment`
--

INSERT INTO `gxc_auth_assignment` VALUES('Admin', '1', NULL, 'N;');
INSERT INTO `gxc_auth_assignment` VALUES('Reporter', '3', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_auth_item`
--

CREATE TABLE `gxc_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_auth_item`
--

INSERT INTO `gxc_auth_item` VALUES('Guest', 2, 'Guest', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Authenticated', 2, 'Authenticated', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Admin', 2, 'Admin', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Reporter', 2, 'Reporter', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Editor', 2, 'Editor', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_auth_item_child`
--

CREATE TABLE `gxc_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_auth_item_child`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_autologin_tokens`
--

CREATE TABLE `gxc_autologin_tokens` (
  `user_id` bigint(20) NOT NULL,
  `token` char(40) NOT NULL,
  PRIMARY KEY (`user_id`,`token`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gxc_autologin_tokens`
--

INSERT INTO `gxc_autologin_tokens` VALUES(1, 'c7e000bb39fcdd89fdf28cd445d12b1c020f4e54');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_block`
--

CREATE TABLE `gxc_block` (
  `block_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `created` int(11) DEFAULT '0',
  `creator` bigint(20) NOT NULL,
  `updated` int(11) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `gxc_block`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_content_list`
--

CREATE TABLE `gxc_content_list` (
  `content_list_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`content_list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gxc_content_list`
--

INSERT INTO `gxc_content_list` VALUES(1, 'Test', 'a:9:{s:4:"type";s:1:"2";s:4:"lang";a:1:{i:0;s:1:"1";}s:12:"content_type";a:1:{i:0;s:7:"article";}s:5:"terms";a:1:{i:0;s:1:"1";}s:4:"tags";s:0:"";s:6:"paging";s:1:"0";s:6:"number";s:2:"10";s:8:"criteria";s:1:"1";s:11:"manual_list";a:0:{}}', 1354788099);

-- --------------------------------------------------------

--
-- Table structure for table `gxc_language`
--

CREATE TABLE `gxc_language` (
  `lang_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(255) DEFAULT '',
  `lang_desc` varchar(255) DEFAULT '',
  `lang_required` tinyint(1) DEFAULT '0',
  `lang_active` tinyint(1) DEFAULT '0',
  `lang_short` varchar(10) NOT NULL,
  PRIMARY KEY (`lang_id`),
  KEY `lang_desc` (`lang_desc`),
  KEY `lang_name` (`lang_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gxc_language`
--

INSERT INTO `gxc_language` VALUES(1, 'vi_vn', 'Vietnamese', 0, 1, 'vi');
INSERT INTO `gxc_language` VALUES(2, 'en_us', 'English', 0, 1, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_menu`
--

CREATE TABLE `gxc_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `lang` tinyint(4) DEFAULT NULL,
  `guid` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_menu_item`
--

CREATE TABLE `gxc_menu_item` (
  `menu_item_id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `parent` int(10) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gxc_menu_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_object`
--

CREATE TABLE `gxc_object` (
  `object_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_author` bigint(20) unsigned DEFAULT '0',
  `object_date` int(11) NOT NULL DEFAULT '0',
  `object_date_gmt` int(11) NOT NULL DEFAULT '0',
  `object_content` longtext,
  `object_title` text,
  `object_excerpt` text,
  `object_status` tinyint(4) NOT NULL DEFAULT '1',
  `comment_status` tinyint(4) NOT NULL DEFAULT '1',
  `object_password` varchar(20) DEFAULT NULL,
  `object_name` varchar(255) NOT NULL,
  `object_modified` int(11) NOT NULL DEFAULT '0',
  `object_modified_gmt` int(11) NOT NULL DEFAULT '0',
  `object_content_filtered` text,
  `object_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `object_type` varchar(20) NOT NULL DEFAULT 'object',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `object_slug` varchar(255) DEFAULT NULL,
  `object_description` text,
  `object_keywords` text,
  `lang` tinyint(4) DEFAULT '1',
  `object_author_name` varchar(255) DEFAULT NULL,
  `total_number_meta` tinyint(3) NOT NULL,
  `total_number_resource` tinyint(3) NOT NULL,
  `tags` text,
  `object_view` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `dislike` int(11) NOT NULL DEFAULT '0',
  `rating_scores` int(11) NOT NULL DEFAULT '0',
  `rating_average` float NOT NULL DEFAULT '0',
  `layout` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`object_id`),
  KEY `type_status_date` (`object_type`,`object_status`,`object_date`,`object_id`),
  KEY `object_parent` (`object_parent`),
  KEY `object_author` (`object_author`),
  KEY `object_name` (`object_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_object`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_object_meta`
--

CREATE TABLE `gxc_object_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `object_id` (`meta_object_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_object_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_object_resource`
--

CREATE TABLE `gxc_object_resource` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `resource_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `resource_order` int(11) NOT NULL DEFAULT '0',
  `description` longtext,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`object_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_object_resource`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_object_term`
--

CREATE TABLE `gxc_object_term` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_id`),
  KEY `term_id` (`term_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_object_term`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_page`
--

CREATE TABLE `gxc_page` (
  `page_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent` bigint(20) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `lang` tinyint(4) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `allow_index` tinyint(1) NOT NULL DEFAULT '1',
  `allow_follow` tinyint(1) NOT NULL DEFAULT '1',
  `display_type` varchar(50) NOT NULL DEFAULT 'main',
  `display_device` varchar(50) NOT NULL DEFAULT 'web',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gxc_page`
--

INSERT INTO `gxc_page` VALUES(1, 'home', 'Homepage', 'Homepage', 0, 'default', 'home', 2, '4f3373e0a0648', 1, 'Homepage', 1, 1, 'main', 'web');
INSERT INTO `gxc_page` VALUES(2, 'Error', 'Error', 'Error Notification', 0, 'default', 'error', 2, '4f34d20be0f79', 1, 'Error Notification', 1, 1, 'empty', 'web');
INSERT INTO `gxc_page` VALUES(3, 'Post Detail View', 'Post Detail View', 'Post Detail View', 1, 'default', 'post', 2, '4f34da1b41620', 1, 'Post Detail View', 1, 1, 'main', 'web');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_page_block`
--

CREATE TABLE `gxc_page_block` (
  `page_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `block_order` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `region` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`block_id`,`block_order`,`region`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_page_block`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_resource`
--

CREATE TABLE `gxc_resource` (
  `resource_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(255) DEFAULT '',
  `resource_body` text,
  `resource_path` varchar(255) DEFAULT '',
  `resource_type` varchar(50) DEFAULT NULL,
  `created` int(11) DEFAULT '0',
  `updated` int(11) DEFAULT '0',
  `creator` bigint(20) NOT NULL,
  `where` varchar(50) NOT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_resource`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_rights`
--

CREATE TABLE `gxc_rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_session`
--

CREATE TABLE `gxc_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_session`
--

INSERT INTO `gxc_session` VALUES('921c721e7873ac49bf82b99e732c3922', 1354790021, 'gxc_u_autoLoginToken|s:40:"9c093f27c632f42fd035752cc153d30a3ff34316";gxc_u___id|s:1:"1";gxc_u___name|s:5:"admin";gxc_u___states|a:1:{s:14:"autoLoginToken";b:1;}gxc_u_current_user|a:8:{s:8:"username";s:5:"admin";s:8:"user_url";s:5:"admin";s:12:"display_name";s:5:"Admin";s:5:"email";s:19:"admin@localhost.com";s:5:"fbuid";N;s:6:"status";s:1:"1";s:12:"recent_login";s:10:"1354780715";s:6:"avatar";N;}gxc_u_current_roles|a:1:{i:0;s:5:"Admin";}gxc_u_Rights_isSuperuser|b:1;');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_settings`
--

CREATE TABLE `gxc_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gxc_settings`
--

INSERT INTO `gxc_settings` VALUES(3, 'system', 'support_email', 's:21:"support@localhost.com";');
INSERT INTO `gxc_settings` VALUES(5, 'system', 'page_size', 's:2:"10";');
INSERT INTO `gxc_settings` VALUES(6, 'system', 'language_number', 's:1:"2";');
INSERT INTO `gxc_settings` VALUES(7, 'general', 'site_name', 's:3:"CMS";');
INSERT INTO `gxc_settings` VALUES(8, 'general', 'site_title', 's:22:"GXC-CMS Demo TEST ZONE";');
INSERT INTO `gxc_settings` VALUES(9, 'general', 'site_description', 's:22:"GXC-CMS Demo TEST ZONE";');
INSERT INTO `gxc_settings` VALUES(13, 'general', 'homepage', 's:4:"home";');
INSERT INTO `gxc_settings` VALUES(14, 'general', 'slogan', 's:40:"We build apps for better life experience";');
INSERT INTO `gxc_settings` VALUES(15, 'general', 'post_link', 's:4:"post";');
INSERT INTO `gxc_settings` VALUES(16, 'general', 'error_link', 's:5:"error";');
INSERT INTO `gxc_settings` VALUES(17, 'system', 'keep_file_name_upload', 's:1:"0";');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_source_message`
--

CREATE TABLE `gxc_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_source_message`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_tag`
--

CREATE TABLE `gxc_tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `frequency` int(11) DEFAULT '1',
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_tag_relationships`
--

CREATE TABLE `gxc_tag_relationships` (
  `tag_id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL,
  PRIMARY KEY (`tag_id`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_tag_relationships`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_taxonomy`
--

CREATE TABLE `gxc_taxonomy` (
  `taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'article',
  `lang` tinyint(4) DEFAULT '1',
  `guid` varchar(255) NOT NULL,
  PRIMARY KEY (`taxonomy_id`),
  KEY `taxonomy` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gxc_taxonomy`
--

INSERT INTO `gxc_taxonomy` VALUES(1, 'Article Categories', 'Article Categories', 'article', 2, '4f336d87ac576');
INSERT INTO `gxc_taxonomy` VALUES(2, 'Event Categories', 'Event Categories', 'event', 2, '4f336d99f1482');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_term`
--

CREATE TABLE `gxc_term` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '',
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`term_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gxc_term`
--

INSERT INTO `gxc_term` VALUES(1, 1, 'Uncategories', 'Uncategories', 'uncategories', 0, 1);
INSERT INTO `gxc_term` VALUES(2, 2, 'Uncategories', 'Uncategories', 'uncategories-event', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gxc_transfer`
--

CREATE TABLE `gxc_transfer` (
  `transfer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) NOT NULL,
  `from_user_id` bigint(20) NOT NULL,
  `to_user_id` bigint(20) NOT NULL,
  `before_status` tinyint(2) NOT NULL,
  `after_status` tinyint(2) NOT NULL,
  `type` int(11) NOT NULL,
  `note` varchar(125) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_transfer`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_translated_message`
--

CREATE TABLE `gxc_translated_message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) NOT NULL DEFAULT '',
  `translation` text,
  PRIMARY KEY (`id`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gxc_translated_message`
--


-- --------------------------------------------------------

--
-- Table structure for table `gxc_user`
--

CREATE TABLE `gxc_user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `user_url` varchar(128) DEFAULT NULL,
  `display_name` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `fbuid` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_time` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `recent_login` int(11) NOT NULL,
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `confirmed` tinyint(2) NOT NULL DEFAULT '0',
  `gender` varchar(10) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `bio` text,
  `birthday_month` varchar(50) DEFAULT NULL,
  `birthday_day` varchar(2) DEFAULT NULL,
  `birthday_year` varchar(4) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_site_news` tinyint(1) NOT NULL DEFAULT '1',
  `email_search_alert` tinyint(1) NOT NULL DEFAULT '1',
  `email_recover_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gxc_user`
--

INSERT INTO `gxc_user` VALUES(1, 'admin', 'admin', 'Admin', 'b8b19ad7133fc9e145dd153aac6c2267:OWNhMzM2ODNhN2QxZWQ5N2U5YTViMmFlNTA0NThkYTkyM21zODIwN3g=', 'admin@localhost.com', NULL, 1, 1328777092, 1354780715, 1354780715, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);
INSERT INTO `gxc_user` VALUES(3, 'reporter', '', 'Reporter', 'b8b19ad7133fc9e145dd153aac6c2267:OWNhMzM2ODNhN2QxZWQ5N2U5YTViMmFlNTA0NThkYTkyM21zODIwN3g=', 'reporter@localhost.com', NULL, 1, 1353488915, 1354001807, 1354001807, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gxc_user_meta`
--

CREATE TABLE `gxc_user_meta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_user_meta`
--

