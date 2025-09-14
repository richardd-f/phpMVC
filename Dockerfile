FROM php:8.2-apache

# Install MySQL PDO driver
RUN docker-php-ext-install pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite
