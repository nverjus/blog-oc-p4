# Blog OpenclassRooms project 5

#### This is a simple CV/Blog appliation

### Requirements

[Apache2](https://httpd.apache.org/download.cgi)

[PHP 7.1](http://php.net/downloads.php)

[MySQL](https://www.mysql.com)

### Installation

Clone [the project](https://github.com/nverjus/blog-oc-p5) in your Apache web folder

On Linux : `/var/www/html/`

Move to directory

`$ cd path/to/directory`

Install the [Composer](https://getcomposer.org/download/) and run

`$ php composer.phar install`

Run MySql and import the NVBlog_DB.sql file

 `$ mysql -u root -p`

 `mysql > SOURCE NVBlog_DB.sql`

 Duplicate the '/config/config.yml.dist' file as 'config.yml'

 Add your MySQL and mail credentials in the config.yml file

 Copy the blog.conf file to 'sites-availables' folder from Apache and enable the site

 On Linux :
 `$ sudo cp blog.conf etc/apache2/sites-available/blog.conf`

 `$ sudo a2ensite blog.conf`

 `$ sudo systemctl restart apache2`

 Run <http://blog.oc> in your web brower to access the site.
