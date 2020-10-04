CREATE TABLE IF NOT EXISTS `#__igallery` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `ordering` int(7) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `profile` int(5) NOT NULL,
  `parent` int(9) NOT NULL DEFAULT '0',
  `menu_image_filename` varchar(255) NOT NULL,
  `menu_description` text NOT NULL,
  `gallery_description` text NOT NULL,
  `user` int(9) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hits` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `moderate` INT(1) NOT NULL DEFAULT '1',
  `page_title` varchar(255) NOT NULL,
  `metadesc` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ordering` (`ordering`),
  KEY `date` (`date`),
  KEY `published` (`published`),
  KEY `hits` (`hits`),
  KEY `publish_up` (`publish_up`),
  KEY `publish_down` (`publish_down`),
  KEY `moderate` (`moderate`),
  KEY `profile` (`profile`),
  `second_user` INT(9) NOT NULL,
  `third_user` INT(9) NOT NULL,
  `fourth_user` INT(9) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__igallery_img` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(9) NOT NULL,
  `ordering` int(7) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `target_blank` int(1) NOT NULL DEFAULT '1',
  `user` int(11) NOT NULL,
  `access` int(2) NOT NULL DEFAULT '1',
  `published` int(1) NOT NULL DEFAULT '1',
  `rotation` int(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `menu_image` int(1) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `moderate` INT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`),
  KEY `ordering` (`ordering`),
  KEY `date` (`date`),
  KEY `user` (`user`),
  KEY `access` (`access`),
  KEY `published` (`published`),
  KEY `hits` (`hits`),
  KEY `menu_image` (`menu_image`),
  KEY `publish_up` (`publish_up`),
  KEY `publish_down` (`publish_down`),
  KEY `moderate` (`moderate`)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__igallery_profiles` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ordering` int(4) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `img_quality` int(3) NOT NULL DEFAULT '80',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `menu_max_width` int(4) NOT NULL DEFAULT '200',
  `menu_max_height` int(4) NOT NULL DEFAULT '150',
  `columns` int(2) NOT NULL DEFAULT '2',
  `show_large_image` int(1) NOT NULL DEFAULT '1',
  `max_width` int(4) NOT NULL DEFAULT '600',
  `max_height` int(4) NOT NULL DEFAULT '450',
  `img_container_width` int(4) NOT NULL DEFAULT '0',
  `img_container_height` int(4) NOT NULL DEFAULT '0',
  `fade_duration` int(4) NOT NULL DEFAULT '50',
  `preload` int(1) NOT NULL DEFAULT '1',
  `magnify` int(1) NOT NULL DEFAULT '1',
  `show_thumbs` int(1) NOT NULL DEFAULT '1',
  `thumb_width` int(4) NOT NULL DEFAULT '120',
  `thumb_height` int(4) NOT NULL DEFAULT '90',
  `crop_thumbs` int(1) NOT NULL DEFAULT '1',
  `thumb_position` varchar(10) NOT NULL DEFAULT 'below',
  `thumb_container_width` int(4) NOT NULL DEFAULT '0',
  `thumb_container_height` int(4) NOT NULL DEFAULT '0',
  `images_per_row` int(4) NOT NULL DEFAULT '0',
  `thumb_scrollbar` int(1) NOT NULL DEFAULT '0',
  `arrows_up_down` int(1) NOT NULL DEFAULT '0',
  `arrows_left_right` int(1) NOT NULL DEFAULT '0',
  `scroll_speed` decimal(2,2) NOT NULL DEFAULT '0.07',
  `scroll_boundary` int(4) NOT NULL DEFAULT '120',
  `gallery_des_position` varchar(10) NOT NULL DEFAULT 'below',
  `allow_comments` int(1) NOT NULL DEFAULT '0',
  `allow_rating` int(1) NOT NULL DEFAULT '0',
  `align` varchar(10) NOT NULL DEFAULT 'left',
  `style` varchar(64) NOT NULL DEFAULT 'grey-border-shadow',
  `show_slideshow_controls` int(1) NOT NULL DEFAULT '0',
  `slideshow_autostart` int(1) NOT NULL DEFAULT '0',
  `slideshow_pause` int(5) NOT NULL DEFAULT '3000',
  `show_descriptions` int(1) NOT NULL DEFAULT '1',
  `photo_des_position` varchar(10) NOT NULL DEFAULT 'below',
  `photo_des_width` int(4) NOT NULL DEFAULT '0',
  `photo_des_height` int(4) NOT NULL DEFAULT '40',
  `lightbox` int(1) NOT NULL DEFAULT '1',
  `lbox_max_width` int(4) NOT NULL DEFAULT '800',
  `lbox_max_height` int(4) NOT NULL DEFAULT '600',
  `lbox_img_container_width` int(4) NOT NULL DEFAULT '0',
  `lbox_img_container_height` int(4) NOT NULL DEFAULT '0',
  `lbox_fade_duration` int(4) NOT NULL DEFAULT '50',
  `lbox_preload` int(1) NOT NULL DEFAULT '1',
  `lbox_show_thumbs` int(1) NOT NULL DEFAULT '1',
  `lbox_thumb_width` int(4) NOT NULL DEFAULT '120',
  `lbox_thumb_height` int(4) NOT NULL DEFAULT '90',
  `lbox_crop_thumbs` int(1) NOT NULL DEFAULT '1',
  `lbox_thumb_position` varchar(12) NOT NULL DEFAULT 'below',
  `lbox_thumb_container_width` int(4) NOT NULL DEFAULT '0',
  `lbox_thumb_container_height` int(4) NOT NULL DEFAULT '0',
  `lbox_images_per_row` int(3) NOT NULL DEFAULT '0',
  `lbox_thumb_scrollbar` int(1) NOT NULL DEFAULT '0',
  `lbox_arrows_left_right` int(1) NOT NULL DEFAULT '0',
  `lbox_arrows_up_down` int(1) NOT NULL DEFAULT '0',
  `lbox_scroll_speed` decimal(2,2) NOT NULL DEFAULT '0.07',
  `lbox_scroll_boundary` int(4) NOT NULL DEFAULT '120',
  `lbox_allow_comments` int(1) NOT NULL DEFAULT '0',
  `lbox_allow_rating` int(1) NOT NULL DEFAULT '0',
  `lbox_close_position` varchar(12) NOT NULL DEFAULT 'below',
  `lbox_show_slideshow_controls` int(1) NOT NULL DEFAULT '0',
  `lbox_slideshow_autostart` int(1) NOT NULL DEFAULT '0',
  `lbox_slideshow_pause` int(5) NOT NULL DEFAULT '3000',
  `lbox_show_descriptions` int(1) NOT NULL DEFAULT '1',
  `lbox_photo_des_position` varchar(10) NOT NULL DEFAULT 'below',
  `lbox_photo_des_width` int(4) NOT NULL DEFAULT '0',
  `lbox_photo_des_height` int(4) NOT NULL DEFAULT '40',
  `watermark` int(1) NOT NULL DEFAULT '0',
  `watermark_position` varchar(16) NOT NULL DEFAULT 'right_bottom',
  `watermark_transparency` int(3) NOT NULL DEFAULT '100',
  `watermark_filename` varchar(255) NOT NULL,
  `download_image` varchar(16) NOT NULL DEFAULT 'none',
  `lbox_download_image` varchar(16) NOT NULL DEFAULT 'none',
  `show_search` int(1) NOT NULL DEFAULT '0',
  `show_cat_title` int(1) NOT NULL DEFAULT '0',
  `crop_menu` int(1) NOT NULL DEFAULT '1',
  `crop_main` int(1) NOT NULL DEFAULT '0',
  `crop_lbox` int(1) NOT NULL DEFAULT '0',
  `menu_pagination` int(1) NOT NULL DEFAULT '0',
  `menu_pagination_amount` int(3) NOT NULL DEFAULT '20',
  `round_large` int(1) NOT NULL DEFAULT '0',
  `round_thumb` int(1) NOT NULL DEFAULT '0',
  `round_fill` varchar(16) NOT NULL DEFAULT '255,255,255',
  `round_menu` int(1) NOT NULL DEFAULT '0',
  `refresh_mode` varchar(24) NOT NULL DEFAULT 'hash',
  `show_tags` int(1) NOT NULL DEFAULT '0',
  `lbox_show_tags` int(1) NOT NULL DEFAULT '0',
  `watermark_text` varchar(255) NOT NULL,
  `watermark_text_color` varchar(24) NOT NULL DEFAULT '255,255,255',
  `watermark_text_size` int(4) NOT NULL DEFAULT '16',
  `share_facebook` int(1) NOT NULL DEFAULT '0',
  `lbox_share_facebook` int(1) NOT NULL DEFAULT '0',
  `menu_image_defaults` int(1) NOT NULL DEFAULT '1',
  `report_image` int(1) NOT NULL DEFAULT '0',
  `lbox_report_image` int(1) NOT NULL DEFAULT '0',
  `thumb_pagination` int(1) NOT NULL DEFAULT '0',
  `thumb_pagination_amount` int(4) NOT NULL DEFAULT '20',
  `lbox_scalable` int(1) NOT NULL DEFAULT '0',
  `access` int(2) NOT NULL DEFAULT '1',
  `menu_access` int(2) NOT NULL DEFAULT '1',
  `show_category_hits` int(1) NOT NULL DEFAULT '0',
  `search_results` varchar(24) NOT NULL DEFAULT 'joomla',
  `asset_id` int(10) NOT NULL,
  `slideshow_position` VARCHAR(24) NOT NULL DEFAULT 'below',
  `lbox_slideshow_position` VARCHAR(24) NOT NULL DEFAULT 'below',
  `show_filename` VARCHAR(24) NOT NULL DEFAULT 'none',
  `lbox_show_filename` VARCHAR(24) NOT NULL DEFAULT 'none',
  `show_numbering` INT(1) NOT NULL DEFAULT '0',
  `lbox_show_numbering` INT(1) NOT NULL DEFAULT '0',
  `show_thumb_info` VARCHAR(24) NOT NULL DEFAULT 'none',
  `lbox_show_thumb_info` VARCHAR(24) NOT NULL DEFAULT 'none',
  `plus_one` INT(1) NOT NULL DEFAULT '0',
  `lbox_plus_one` INT(1) NOT NULL DEFAULT '0',
  `main_image_align_horiz` VARCHAR( 24 ) NOT NULL DEFAULT 'center',
  `main_image_align_vert` VARCHAR( 24 ) NOT NULL DEFAULT 'center',
  `lbox_image_align_horiz` VARCHAR( 24 ) NOT NULL DEFAULT 'center',
  `lbox_image_align_vert` VARCHAR( 24 ) NOT NULL DEFAULT 'center',
  `show_image_count` INT( 1 ) NOT NULL DEFAULT '0',
  `image_ordering` VARCHAR( 24 ) NOT NULL DEFAULT 'ordering',
  `twitter_button` INT( 1 ) NOT NULL DEFAULT '0',
  `lbox_twitter_button` INT( 1 ) NOT NULL DEFAULT '0',
  `show_thumb_arrows` INT( 1 ) NOT NULL DEFAULT '1',
  `lbox_show_thumb_arrows` INT( 1 ) NOT NULL DEFAULT '1',
  `comments_position` VARCHAR( 32 ) NOT NULL DEFAULT 'below',
  `lbox_comments_position` VARCHAR( 32 ) NOT NULL DEFAULT 'below',
  `pinterest_button` INT( 1 ) NOT NULL DEFAULT '0',
  `lbox_pinterest_button` INT( 1 ) NOT NULL DEFAULT '0',
  `show_cat_author` INT( 1 ) NOT NULL DEFAULT '0',
  `show_image_author` INT( 1 ) NOT NULL DEFAULT '0',
  `lbox_show_image_author` INT( 1 ) NOT NULL DEFAULT '0',
  `show_image_hits` INT( 1 ) NOT NULL DEFAULT '0',
  `lbox_show_image_hits` INT( 1 ) NOT NULL DEFAULT '0',
  `lbox_back_color` VARCHAR( 32 ) NOT NULL DEFAULT 'black',
  `lbox_back_custom` VARCHAR( 32 ) NOT NULL ,
  `lbox_back_opacity` INT( 4 ) NOT NULL DEFAULT '70',
  `lbox_front_color` VARCHAR( 32 ) NOT NULL DEFAULT 'white',
  `lbox_front_custom` VARCHAR( 32 ) NOT NULL,
  `mobile_hide_thumbs` INT NOT NULL DEFAULT '1',
  `mobile_lbox_hide_thumbs` INT( 1 ) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__igallery_ratings`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `user` int(11) NOT NULL,
  `published` int(1) NOT NULL DEFAULT '1',
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  KEY `published` (`published`)
)  DEFAULT CHARSET=utf8;

