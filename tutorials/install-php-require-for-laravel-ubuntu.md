# INSTALL PHP REQUIRE FOR LARAVEL ON UBUNTU

## Steps:

1. (OPTIONAL) check php version used 'sudo update-alternatives --config' and select php version if there are more than 1 php version installed
2. Install PHP extensions with the command `sudo apt-get install php-xml php-mbstring php-tokenizer php-zip php-gd php-curl php-mysql`, replace the php version with the version used if necessary (example: php7.4-xml)
3. Restart the web server with the command `sudo service apache2 restart`
4. Check the installed PHP extensions with the command `php -m`
