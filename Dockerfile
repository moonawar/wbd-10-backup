FROM php:8.0-apache
WORKDIR /var/www/html

# PHP extension and Apache configuration
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
RUN apt-get update \
    && apt-get install -y \
        libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# Enable SOAP extension
RUN docker-php-ext-install soap