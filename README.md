# share
v1.4

## mysql
```
CREATE TABLE `download_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `downloaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `remote_addr` varchar(128) DEFAULT NULL,
  `testing` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `download_manager` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `downloads` int(10) unsigned NOT NULL DEFAULT '1',
  `testing` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(50) NOT NULL,
  `parentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `special` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

```

## features
- create lib directory
- directory refer to path in database
- one directory page on tiga
- remove all directory pages

# resources
- https://tableplus.com/blog/2018/10/how-to-create-a-superuser-in-mysql.html
- https://zemez.io/magento/support/how-to/create-new-database-database-user-grant-permissions-ssh/
- https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
- https://tutorialzine.com/2010/02/php-mysql-download-counter

# telegram
t.me/shahadansaad
