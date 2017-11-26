DB Name : lumen

----  schema -----


CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '									',
  `category` tinyint(4) DEFAULT '1' COMMENT '------ category or section ------\n	1=> News, 2=>Entertainment',
  `content_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'Article' COMMENT 'Article, Video',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

1----------  run local server ---------

  /var/www/lumenRestApi $ php -S localhost:8000 -t public

2-------- get feed data frist time ----

	/var/www/lumenRestApi $ php artisan XmlFeedParser:parsefeed


3----------- end points -----------------

	api_token = 12345 ( send as header )

	http://localhost:8000/api/v1/content/ 		( entire listing GET Request )
	http://localhost:8000/api/v1/content/{id} 	( detail page GET Request )

4--------- cron -----------------

  * * * * * php /var/www/lumenRestApi/artisan schedule:run >> /dev/null 2>&1


