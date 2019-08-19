# share

# setup
```CREATE USER 'username'@'localhost' IDENTIFIED BY 'the_password';
GRANT ALL PRIVILEGES ON *.* TO 'user_name'@'localhost' WITH GRANT OPTION;
CREATE USER 'username'@'%' IDENTIFIED BY 'the_password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
SHOW GRANTS FOR username;
FLUSH PRIVILEGES;
CREATE DATABASE databasename
GRANT ALL PRIVILEGES ON databasename.* TO 'user_name'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

## mysql
```use databasename
CREATE TABLE users (
    	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    	username VARCHAR(50) NOT NULL UNIQUE,
    	password VARCHAR(255) NOT NULL,
    	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Experiment01
```CREATE TABLE download_manager (
  	id int(6) unsigned NOT NULL auto_increment,
  	filename varchar(128) collate utf8_unicode_ci NOT NULL default '',
  	downloads int(10) unsigned NOT NULL default '1',
  	PRIMARY KEY  ('id'),
  	UNIQUE KEY 'filename' ('filename')
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

### Experiment02
```CREATE TABLE download_history (
 	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 	manager_id INT NOT NULL,
 	user_id INT NOT NULL,
 	downloaded_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```
# resources
- https://tableplus.com/blog/2018/10/how-to-create-a-superuser-in-mysql.html
- https://zemez.io/magento/support/how-to/create-new-database-database-user-grant-permissions-ssh/
- https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
- https://tutorialzine.com/2010/02/php-mysql-download-counter
