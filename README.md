# CRUD application codeigniter

## Download codeigniter version 3.0
After extracting downloaded file in your htdocs folder
1. run xampp
2. check to see the welcome page of the application 

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


```php
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['crud'] = 'crud/index'; //home page for the application
$route['crud/(:num)'] = 'crud/show/$1'; // single inserted item
$route['crudCreate']['post'] = 'crud/store'; // for creating an item post
$route['crudEdit/(:any)'] = 'crud/edit/$1'; // for editing the item
$route['crudUpdate/(:any)']['put'] = 'crud/update/$1'; // Updating the item
$route['crudDelete/(:any)']['delete'] = 'crud/delete/$1'; // deleting the item
```

## Add Controller for crud operations

## Make model 

## View for the crud operations
