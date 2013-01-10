-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2012 at 10:33 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `tto`
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

INSERT INTO `gxc_auth_item` VALUES('Editor', 2, 'Editor', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Reporter', 2, 'Reporter', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Admin', 2, 'Admin', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Guest', 2, 'Guest', NULL, 'N;');
INSERT INTO `gxc_auth_item` VALUES('Authenticated', 2, 'Authenticated', NULL, 'N;');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `gxc_block`
--

INSERT INTO `gxc_block` VALUES(45, 'Contact us Block', 'html', 1356601994, 1, 1356601994, 'YToxOntzOjQ6Imh0bWwiO3M6NTE6IjxoMj5Db250YWN0IHVzPC9oMj4NCjxwPlRoaXMgaXMgQ29udGFjdCB1cyBwYWdlPC9wPiI7fQ==');
INSERT INTO `gxc_block` VALUES(42, 'News in Homepage', 'listview', 1356601771, 1, 1356601771, 'YToyOntzOjEyOiJjb250ZW50X2xpc3QiO2E6MTp7aTowO3M6MToiNyI7fXM6MTI6ImRpc3BsYXlfdHlwZSI7czoxOiIwIjt9');
INSERT INTO `gxc_block` VALUES(44, 'About us Block', 'html', 1356601967, 1, 1356601967, 'YToxOntzOjQ6Imh0bWwiO3M6NDc6IjxoMj5BYm91dCB1czwvaDI+DQo8cD5UaGlzIGlzIEFib3V0IHVzIHBhZ2U8L3A+Ijt9');
INSERT INTO `gxc_block` VALUES(39, 'Menu Block', 'menu', 1356600993, 1, 1356600993, 'YToxOntzOjc6Im1lbnVfaWQiO3M6MToiMSI7fQ==');
INSERT INTO `gxc_block` VALUES(41, 'Make Better HTML Block', 'html', 1356601717, 1, 1356601717, 'YToxOntzOjQ6Imh0bWwiO3M6MzY3OiI8ZGl2IGNsYXNzPSJpbmZvLWJsb2ciPg0KCQkJCTxwPjxzdHJvbmc+TWFrZSB0aGlzIHNvdXJjZSBiZXR0ZXI8L3N0cm9uZz48L3A+DQoJCQkJCUlmIHlvdSBoYXZlIGFueSBpZGVhcyBvciBzdWdnZXN0aW9ucyB0byBtYWtlIHRoaXMgc2l0ZSBiZXR0ZXIsIHBsZWFzZSBkbyBub3QgaGVzdGl0YXRlIHRvIGNvbnRhY3QgbWUgZGlyZWN0bHkgYXQgPGEgaHJlZj0iaHR0cHM6Ly9tYWlsLmdvb2dsZS5jb20vbWFpbC8/dmlldz1jbSZhbXA7ZnM9MSZhbXA7dGY9MSZhbXA7dG89bmdhbmh0dWFuNjNAZ21haWwuY29tIiB0YXJnZXQ9Il9ibGFuayI+bmdhbmh0dWFuNjNAZ21haWwuY29tPC9hPi4gQWxsIGlkZWFzIGFyZSB3ZWxjb21lLg0KCQkJPC9kaXY+Ijt9');

-- --------------------------------------------------------

--
-- Table structure for table `gxc_comment`
--

CREATE TABLE `gxc_comment` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(255) NOT NULL DEFAULT '',
  `comment_author_url` varchar(255) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` int(11) NOT NULL,
  `comment_date_gmt` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_title` text,
  `comment_modified_content` text,
  PRIMARY KEY (`comment_id`),
  KEY `comment_approved` (`comment_approved`),
  KEY `comment_post_ID` (`object_id`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gxc_comment`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gxc_content_list`
--

INSERT INTO `gxc_content_list` VALUES(7, 'News Content List in Homepage', 'a:9:{s:4:"type";s:1:"2";s:4:"lang";a:1:{i:0;s:1:"0";}s:12:"content_type";a:1:{i:0;s:7:"article";}s:5:"terms";a:1:{i:0;s:1:"0";}s:4:"tags";s:0:"";s:6:"paging";s:1:"0";s:6:"number";s:2:"10";s:8:"criteria";s:1:"1";s:11:"manual_list";a:0:{}}', 1356601769);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gxc_menu`
--

INSERT INTO `gxc_menu` VALUES(1, 'Header Menu', 'Header Menu', 1, '50d45d61c1376');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gxc_menu_item`
--

INSERT INTO `gxc_menu_item` VALUES(7, 1, 'Contact us', 'Contact us', '1', '6', 0, 2);
INSERT INTO `gxc_menu_item` VALUES(6, 1, 'About us', 'About us', '1', '5', 0, 1);
INSERT INTO `gxc_menu_item` VALUES(5, 1, 'Home', 'home', '6', '1', 0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `gxc_object`
--

INSERT INTO `gxc_object` VALUES(4, 1, 1356084396, 1356059196, '<p>\r\n  I don&#39;t want to be rescued. Bite my shiny metal ass. I&#39;m sorry, guys. I never meant to hurt you. Just to destroy everything you ever believed in. WINDMILLS DO NOT WORK THAT WAY! GOOD NIGHT! Isn&#39;t it true that you have been paid for your testimony?</p>\r\n<h2>\r\n The Deep South</h2>\r\n<p>\r\n  Yeah, lots of people did. Bender, this is Fry&#39;s decision&hellip; and he made it wrong. So it&#39;s time for us to interfere in his life. I could if you hadn&#39;t turned on the light and shut off my stereo. They&#39;re like sex, except I&#39;m having them!</p>\r\n<ul>\r\n  <li>\r\n    Ah, the &#39;Breakfast Club&#39; soundtrack! I can&#39;t wait til I&#39;m old enough to feel ways about stuff!</li>\r\n <li>\r\n    I could if you hadn&#39;t turned on the light and shut off my stereo.</li>\r\n  <li>\r\n    Dr. Zoidberg, that doesn&#39;t make sense. But, okay!</li>\r\n  <li>\r\n    Who said that? SURE you can die! You want to die?!</li>\r\n</ul>\r\n<h3>\r\n  Godfellas</h3>\r\n<p>\r\n I&#39;ve been there. My folks were always on me to groom myself and wear underpants. What am I, the pope? It may comfort you to know that Fry&#39;s death took only fifteen seconds, yet the pain was so intense, that it felt to him like fifteen years. And it goes without saying, it caused him to empty his bowels. That&#39;s right, baby. I ain&#39;t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him! Bender, we&#39;re trying our best.</p>\r\n<h4>\r\n The Route of All Evil</h4>\r\n<p>\r\n Hey! I&#39;m a porno-dealing monster, what do I care what you think? And why did &#39;I&#39; have to take a cab? Does anybody else feel jealous and aroused and worried? And yet you haven&#39;t said what I told you to say! How can any of us trust you? It&#39;s okay, Bender. I like cooking too. It doesn&#39;t look so shiny to me.</p>\r\n<ol>\r\n <li>\r\n    I daresay that Fry has discovered the smelliest object in the known universe!</li>\r\n  <li>\r\n    Guess again.</li>\r\n <li>\r\n    I wish! It&#39;s a nickel.</li>\r\n <li>\r\n    I daresay that Fry has discovered the smelliest object in the known universe!</li>\r\n</ol>\r\n<h5>\r\n The 30% Iron Chef</h5>\r\n<p>\r\n I&#39;ve been there. My folks were always on me to groom myself and wear underpants. What am I, the pope? Oh, you&#39;re a dollar naughtier than most. Ah, the &#39;Breakfast Club&#39; soundtrack! I can&#39;t wait til I&#39;m old enough to feel ways about stuff! Stop! Don&#39;t shoot fire stick in space canoe! Cause explosive decompression!</p>\r\n', 'This is the sample post 1', 'I don''t want to be rescued. Bite my shiny metal ass. I''m sorry, guys. I never meant to hurt you. Just to destroy everything you ever believed in. WINDMILLS DO NOT WORK THAT WAY! GOOD NIGHT! Isn''t it true that you have been paid for your testimony?', 1, 1, NULL, 'This is the sample post 1', 1356098365, 1356073165, NULL, 0, '50d434acd1129', 'article', 0, 'this-is-the-sample-post-1', 'I don''t want to be rescued. Bite my shiny metal ass. I''m sorry, guys. I never meant to hurt you. Just to destroy everything you ever believed in. WINDMILLS DO NOT WORK THAT WAY! GOOD NIGHT! Isn''t it true that you have been paid for your testimony?', '', 1, 'Admin', 0, 0, '', 0, 0, 0, 0, 0, NULL);
INSERT INTO `gxc_object` VALUES(5, 1, 1356084454, 1356059254, '<p>\r\n  Beer. Now there&#39;s a temporary solution. I hope I didn&#39;t brain my damage. You don&#39;t win friends with salad. Weaseling out of things is important to learn. It&#39;s what separates us from the animals&hellip;except the weasel. No children have ever meddled with the Republican Party and lived to tell about it. D&#39;oh.</p>\r\n<h2>\r\n Homer: Bad Man</h2>\r\n<p>\r\n  I&#39;m a Spalding Gray in a Rick Dees world. I don&#39;t like being outdoors, Smithers. For one thing, there&#39;s too many fat children. Thank you, steal again. How is education supposed to make me feel smarter? Besides, every time I learn something new, it pushes some old stuff out of my brain. Remember when I took that home winemaking course, and I forgot how to drive?</p>\r\n<ul>\r\n <li>\r\n    I&#39;m allergic to bee stings. They cause me to, uh, die.</li>\r\n <li>\r\n    I&#39;ve done everything the Bible says &mdash; even the stuff that contradicts the other stuff!</li>\r\n <li>\r\n    You don&#39;t win friends with salad.</li>\r\n</ul>\r\n<h3>\r\n Duffless</h3>\r\n<p>\r\n  Son, a woman is like a beer. They smell good, they look good, you&#39;d step over your own mother just to get one! But you can&#39;t stop at one. You wanna drink another woman! Oh, so they have Internet on computers now! Last night&#39;s &quot;Itchy and Scratchy Show&quot; was, without a doubt, the worst episode *ever.* Rest assured, I was on the Internet within minutes, registering my disgust throughout the world. Fame was like a drug. But what was even more like a drug were the drugs. I prefer a vehicle that doesn&#39;t hurt Mother Earth. It&#39;s a go-cart, powered by my own sense of self-satisfaction.</p>\r\n<h4>\r\n  Natural Born Kissers</h4>\r\n<p>\r\n  Lisa, vampires are make-believe, like elves, gremlins, and Eskimos. Shoplifting is a victimless crime. Like punching someone in the dark. Get ready, skanks! It&#39;s time for the truth train! &hellip;And the fluffy kitten played with that ball of string all through the night. On a lighter note, a Kwik-E-Mart clerk was brutally murdered last night. Aaah! Natural light! Get it off me! Get it off me! I&#39;m allergic to bee stings. They cause me to, uh, die.</p>\r\n<ol>\r\n <li>\r\n    I prefer a vehicle that doesn&#39;t hurt Mother Earth. It&#39;s a go-cart, powered by my own sense of self-satisfaction.</li>\r\n <li>\r\n    I prefer a vehicle that doesn&#39;t hurt Mother Earth. It&#39;s a go-cart, powered by my own sense of self-satisfaction.</li>\r\n</ol>\r\n<h5>\r\n  Selma&#39;s Choice</h5>\r\n<p>\r\n  Fire can be our friend; whether it&#39;s toasting marshmallows or raining down on Charlie. You don&#39;t like your job, you don&#39;t strike. You go in every day and do it really half-assed. That&#39;s the American way. We started out like Romeo and Juliet, but it ended up in tragedy. Oh, I&#39;m in no condition to drive. Wait a minute. I don&#39;t have to listen to myself. I&#39;m drunk.</p>\r\n', 'This is the sample post 2', 'Beer. Now there''s a temporary solution. I hope I didn''t brain my damage. You don''t win friends with salad. Weaseling out of things is important to learn. It''s what separates us from the animalsâ€¦except the weasel. No children have ever meddled with the Republican Party and lived to tell about it. D''oh.', 1, 1, NULL, 'This is the sample post 2', 1356403230, 1356378030, NULL, 0, '50d434e6e7423', 'article', 0, 'this-is-the-sample-post-2', 'Beer. Now there''s a temporary solution. I hope I didn''t brain my damage. You don''t win friends with salad. Weaseling out of things is important to learn. It''s what separates us from the animalsâ€¦except the weasel. No children have ever meddled with the Republican Party and lived to tell about it. D''oh.', '', 1, 'Admin', 0, 0, '', 0, 0, 0, 0, 0, NULL);

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
  `data` tinyint(2) NOT NULL DEFAULT '0',
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
  `display_app` varchar(50) NOT NULL DEFAULT 'all',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `gxc_page`
--

INSERT INTO `gxc_page` VALUES(1, 'home', 'Homepage', 'Homepage', 0, 'default', 'home', 1, '4f3373e0a0648', 1, 'Homepage', 1, 1, 'main', 'web');
INSERT INTO `gxc_page` VALUES(5, 'About us', 'About us', 'About us', 1, 'default', 'about-us', 1, '50d45cc6635c3', 1, '', 1, 1, 'main', 'web');
INSERT INTO `gxc_page` VALUES(3, 'Article detail', 'Article detail', 'Article detail', 1, 'default', 'post', 1, '4f34da1b41620', 1, 'Article detail', 1, 1, 'main', 'web');
INSERT INTO `gxc_page` VALUES(6, 'Contact us', 'Contact us', 'Contact us', 1, 'default', 'contact-us', 1, '50d45cd4ebf39', 1, '', 1, 1, 'main', 'web');

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

INSERT INTO `gxc_page_block` VALUES(5, 39, 1, 1, 0);
INSERT INTO `gxc_page_block` VALUES(1, 39, 2, 1, 0);
INSERT INTO `gxc_page_block` VALUES(3, 41, 1, 1, 2);
INSERT INTO `gxc_page_block` VALUES(1, 42, 1, 1, 1);
INSERT INTO `gxc_page_block` VALUES(3, 39, 2, 1, 0);
INSERT INTO `gxc_page_block` VALUES(6, 45, 1, 1, 1);
INSERT INTO `gxc_page_block` VALUES(6, 39, 1, 1, 0);
INSERT INTO `gxc_page_block` VALUES(5, 41, 1, 1, 2);
INSERT INTO `gxc_page_block` VALUES(1, 41, 1, 1, 2);
INSERT INTO `gxc_page_block` VALUES(5, 44, 1, 1, 1);
INSERT INTO `gxc_page_block` VALUES(6, 41, 1, 1, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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

INSERT INTO `gxc_settings` VALUES(3, 'system', 'support_email', 'czoxOToiYWRtaW5AbG9jYWxob3N0LmNvbSI7');
INSERT INTO `gxc_settings` VALUES(5, 'system', 'page_size', 'czoyOiIxMCI7');
INSERT INTO `gxc_settings` VALUES(7, 'general', 'site_name', 'czo5OiJHWEMgLSBDTVMiOw==');
INSERT INTO `gxc_settings` VALUES(8, 'general', 'site_title', 'czoxOToiT3BlbiBzb3VyY2UgWWlpIENNUyI7');
INSERT INTO `gxc_settings` VALUES(9, 'general', 'site_description', 'czoxOToiT3BlbiBzb3VyY2UgWWlpIENNUyI7');
INSERT INTO `gxc_settings` VALUES(13, 'general', 'homepage', 'czo0OiJob21lIjs=');
INSERT INTO `gxc_settings` VALUES(17, 'system', 'keep_file_name_upload', 'czoxOiIwIjs=');

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

INSERT INTO `gxc_taxonomy` VALUES(1, 'Article Categories', 'Article Categories', 'article', 1, '4f336d87ac576');
INSERT INTO `gxc_taxonomy` VALUES(2, 'Event Categories', 'Event Categories', 'event', 1, '4f336d99f1482');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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

INSERT INTO `gxc_user` VALUES(1, 'admin', 'admin', 'Admin', 'b8b19ad7133fc9e145dd153aac6c2267:OWNhMzM2ODNhN2QxZWQ5N2U5YTViMmFlNTA0NThkYTkyM21zODIwN3g=', 'admin@localhost.com', NULL, 1, 1328777092, 1356620944, 1356620944, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);
INSERT INTO `gxc_user` VALUES(3, 'reporter', '', 'Reporter', 'b8b19ad7133fc9e145dd153aac6c2267:OWNhMzM2ODNhN2QxZWQ5N2U5YTViMmFlNTA0NThkYTkyM21zODIwN3g=', 'reporter@localhost.com', NULL, 1, 1353488915, 1356322914, 1356322914, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);

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

