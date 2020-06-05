# CRUD application codeigniter

## Download codeigniter version 3.0
After extracting downloaded file in your htdocs folder

## Create Database

go to http://localhost/phpmyadmin

```sql
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

```

## Create Routes

## Add Controller for crud operations

## Make model 

## View for the crud operations
