# share
v1.5
## bash script
```
#!/bin/bash
alllogs=".history_md5kan.log"
#log_0="log_0.txt"

echo -e "Original Path:" | tee -a $alllogs
#read oripath
oripath="/usr/home/shah/201908-August/"
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

echo -e "First 3 checksum" | tee -a $alllogs
first3=${md5file:0:3}
echo -e $first3 | tee -a $alllogs

echo -e "New path" | tee -a $alllogs
#read newpath
newpath="/usr/home/shah/sharedata/alldata/$first3/"
echo -e $newpath | tee -a $alllogs
echo -e "Make new directory" | tee -a $alllogs
mkdir -p $newpath
echo -e "Copying..."
cp $oripath$orifilename $newpath$md5file

echo -e "Symlink path" | tee -a $alllogs
#read symlinkpath
symlinkpath="/usr/home/shah/sharedata/userdata/1/1575808455/"
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
## mysql (this is v1.4) will update later
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
- user can view their page only
- one directory page on tiga
- remove all directory pages

# resources
- https://tableplus.com/blog/2018/10/how-to-create-a-superuser-in-mysql.html
- https://zemez.io/magento/support/how-to/create-new-database-database-user-grant-permissions-ssh/
- https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
- https://tutorialzine.com/2010/02/php-mysql-download-counter

# telegram
t.me/shahadansaad
