# share
v1.6

## bash script
```
#!/bin/bash
alllogs=".history_md5kan.log"
#log_0="log_0.txt"

echo -e "Original Path:" | tee -a $alllogs
#read oripath
#nanti tukar dekat epoch
oripath="/usr/home/shah/201910-October/"
#echo -e $oripath >> $alllogs
#echo -e $oripath > $log_0
#while IFS= read -r line
#do
#  echo "$line"
#done < "$log_0"
echo -e $oripath | tee -a $alllogs

echo -e "Original Filename: \c" | tee -a $alllogs
read orifilename
echo -e $orifilename | tee -a $alllogs

echo -e "md5 checksum" | tee -a $alllogs
md5file=$(md5 -q $oripath$orifilename)
echo -e $md5file | tee -a $alllogs

echo -e "First 1 checksum" | tee -a $alllogs
first1=${md5file:0:1}
echo -e $first1 | tee -a $alllogs


echo -e "First 2 checksum" | tee -a $alllogs
first2=${md5file:0:2}
echo -e $first2 | tee -a $alllogs

echo -e "First 3 checksum" | tee -a $alllogs
first3=${md5file:0:3}
echo -e $first3 | tee -a $alllogs

echo -e "New path" | tee -a $alllogs
#read newpath
newpath="/usr/home/shah/sharedata/alldata/$first1/$first2/$first3/"
echo -e $newpath | tee -a $alllogs
echo -e "Make new directory" | tee -a $alllogs
mkdir -p $newpath
echo -e "Copying..."
cp $oripath$orifilename $newpath$md5file
#mv $oripath$orifilename $newpath$md5file
echo -e "Symlink path" | tee -a $alllogs
#read symlinkpath
symlinkpath="/usr/home/shah/sharedata/userdata/1/1575809399/"
mkdir -p $symlinkpath
echo -e $symlinkpath | tee -a $alllogs

echo -e "Create symbolic link" | tee -a $alllogs
ln -s $newpath$md5file $symlinkpath$orifilename
echo -e $newpath$md5file | tee -a $alllogs
echo -e "Done!" | tee -a $alllogs
echo -e "" | tee -a $alllogs
echo -e "**********************************************" | tee -a $alllogs
echo -e "" | tee -a $alllogs
echo -e "" | tee -a $alllogs
```

## mysql 
```
SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for download_history
-- ----------------------------
DROP TABLE IF EXISTS `download_history`;
CREATE TABLE `download_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `downloaded_at` datetime DEFAULT current_timestamp(),
  `remote_addr` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `testing` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for download_manager
-- ----------------------------
DROP TABLE IF EXISTS `download_manager`;
CREATE TABLE `download_manager` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `downloads` int(10) unsigned NOT NULL DEFAULT 1,
  `testing` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `manage_id` int(6) DEFAULT NULL,
  `pages_id` int(11) DEFAULT NULL,
  `filenamefullpath` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `real_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `real_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `md5_checksum` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `all_user_id` int(11) NOT NULL,
  `all_logs` varchar(128) COLLATE utf8_unicode_ci DEFAULT '',
  `all_status` varchar(128) COLLATE utf8_unicode_ci DEFAULT '',
  `downloaded_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `order_q` int(11) DEFAULT NULL,
  `epoch_int` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for testingg
-- ----------------------------
DROP TABLE IF EXISTS `testingg`;
CREATE TABLE `testingg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apa_apa_jer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `special` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

## features
- create lib directory
- directory refer to path in database
- user can view their page only
- one directory page on tiga
- remove all directory pages

# resources
- https://tableplus.com/blog/2018/10/how-to-create-a-superuser-in-mysql.html
- https://zemez.io/magento/support/how-to/create-new-database-database-user-grant-permissions-ssh/
- https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
- https://tutorialzine.com/2010/02/php-mysql-download-counter
- https://tutorialzine.com/2013/05/mini-ajax-file-upload-form

# telegram
t.me/shahadansaad
