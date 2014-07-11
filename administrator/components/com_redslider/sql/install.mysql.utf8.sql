CREATE TABLE IF NOT EXISTS `#__redslider_galleries` (
  `redslider_gallery_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ordering` int(11) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` char(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_by_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`redslider_gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `#__redslider_slides` (
  `redslider_slide_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `redslider_gallery_id` int(11) NOT NULL DEFAULT '0',
  `redslider_template_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) NOT NULL DEFAULT 'standard',
  `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'standard',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`redslider_slide_id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`enabled`),
  KEY `idx_catid` (`redslider_gallery_id`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`redslider_gallery_id`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36;

CREATE TABLE IF NOT EXISTS `#__redslider_templates` (
  `redslider_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `section` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `ordering` int(11) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`redslider_template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Templates Detail' AUTO_INCREMENT=13 ;

INSERT INTO `#__redslider_templates` (`redslider_template_id`, `name`, `alias`, `section`, `description`, `ordering`, `enabled`, `checked_out`, `checked_out_time`) VALUES
(13, 'article', '', 'article', '<table>\r\n<tbody>\r\n<tr>\r\n<td>{article_name}</td>\r\n</tr>\r\n<tr>\r\n<td>{article_description}</td>\r\n</tr>\r\n</tbody>\r\n</table>', 0, 1, 0, '0000-00-00 00:00:00'),
(14, 'event', '', 'event', '<table>\r\n<tbody>\r\n<tr>\r\n<td>{session_title}</td>\r\n</tr>\r\n<tr>\r\n<td>{session_date}</td>\r\n</tr>\r\n<tr>\r\n<td>{event_title}</td>\r\n</tr>\r\n<tr>\r\n<td>{event_description}</td>\r\n</tr>\r\n<tr>\r\n<td>{event_button}</td>\r\n</tr>\r\n</tbody>\r\n</table>', 0, 1, 0, '0000-00-00 00:00:00'),
(15, 'product', '', 'product', '<p>;</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td rowspan="4">{product_image}</td>\r\n<td colspan="2">{product_name}</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2">{product_description}</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2">{product_attribute}</td>\r\n</tr>\r\n<tr>\r\n<td>{product_quantity}</td>\r\n<td>{addtocart_button}</td>\r\n</tr>\r\n</tbody>\r\n</table>', 0, 1, 0, '0000-00-00 00:00:00');
