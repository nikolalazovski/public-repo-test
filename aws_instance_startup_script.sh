/bin/bash
# Use this for your user data (script from top to bottom)
# install httpd (Linux 2 version)
yum update -y
yum install -y httpd php
# Configure PHP as Apache module
# Install PHP extensions:
# - php-fpm: FastCGI Process Manager for PHP
# - php-json: JSON support for PHP
yum install -y php-fpm php-json
# Start and enable PHP-FPM service
systemctl start php-fpm
systemctl enable php-fpm
# Configure Apache to use PHP and set index.php as default
sed -i 's/DirectoryIndex index.html/DirectoryIndex index.php index.html/' /etc/httpd/conf/httpd.conf
# Start and enable Apache
systemctl start httpd
systemctl enable httpd
wget -O /var/www/html/index.php https://raw.githubusercontent.com/nikolalazovski/public-repo-test/refs/heads/niksa/calculator_1/index.php
