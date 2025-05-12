#!/bin/bash

# Update system packages
yum update -y

# Install Apache and PHP
yum install -y httpd php php-cli php-mysqlnd

# Start Apache service
systemctl start httpd

# Enable Apache to start on boot
systemctl enable httpd

# Set permissions for Apache
usermod -a -G apache ec2-user
chown -R ec2-user:apache /var/www
chmod 2775 /var/www
find /var/www -type d -exec chmod 2775 {} \;
find /var/www -type f -exec chmod 0664 {} \;

# Configure Apache to use index.php as default page
echo "DirectoryIndex index.php index.html" > /etc/httpd/conf.d/directory_index.conf

# Restart Apache to apply changes
systemctl restart httpd
