SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_token` varchar(255) DEFAULT NULL,
  `acc_addtime` int(11) DEFAULT NULL,
  `pub_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `info_reply`;
CREATE TABLE `info_reply` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) DEFAULT NULL,
  `p_title` varchar(100) DEFAULT NULL,
  `p_keysword` varchar(100) DEFAULT NULL,
  `p_content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `FK_p_i` (`pub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `pub_id` int(11) DEFAULT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  KEY `FK_p_m` (`pub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `public_number`;
CREATE TABLE `public_number` (
  `pub_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `pub_name` varchar(32) DEFAULT NULL,
  `pub_type` int(11) DEFAULT NULL,
  `pub_appid` varchar(100) DEFAULT NULL,
  `pub_token` varchar(100) DEFAULT NULL,
  `pub_appsecret` varchar(100) DEFAULT NULL,
  `pub_num` varchar(30) DEFAULT NULL,
  `pub_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pub_id`),
  KEY `FK_u_p` (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(32) DEFAULT NULL,
  `u_pwd` char(32) DEFAULT NULL,
  `u_phone` int(11) DEFAULT NULL,
  `u_email` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;