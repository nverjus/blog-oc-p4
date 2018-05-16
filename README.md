# Blog OpenclassRooms project 5

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/441ecf28949b44cda493b42499ee8cc2)](https://app.codacy.com/app/nverjus/blog-oc-p5?utm_source=github.com&utm_medium=referral&utm_content=nverjus/blog-oc-p5&utm_campaign=badger)

#### This is a simple CV/Blog appliation

### Requirements

[Apache2 with rewrite mod enabled](https://httpd.apache.org/download.cgi)

[PHP 7.1](http://php.net/downloads.php)

[MySQL](https://www.mysql.com)

### Installation

Clone [the project](https://github.com/nverjus/blog-oc-p5) in your Apache web folder

On Linux : `/var/www/html/`

Move to directory

`$ cd path/to/directory`

Install the [Composer](https://getcomposer.org/download/) and run

`$ php composer.phar install`

 Duplicate the '/config/config.yml.dist' file as 'config.yml'

 Add your MySQL and mail credentials in the config.yml file

 Execute the database creation script

 `$ php setup/db-schema.php`

 You can load some fixtures by running th db-fixtures.php script

 `$ php setup/db-fixture.php`

 Copy the blog.conf file to 'sites-availables' folder from Apache and enable the site

 On Linux :
 `$ sudo cp setup/000-default.conf /etc/apache2/sites-available/000-default.conf`

 `$ sudo systemctl restart apache2`

 Run <http://> in your web brower to access the site.
