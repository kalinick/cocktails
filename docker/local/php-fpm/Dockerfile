FROM ubuntu:latest

ENV DEBIAN_FRONTEND noninteractive

# Install and set up all packages
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
    curl \
    git \
    php \
    php-cli \
    php-curl \
    php-dom \
    php-intl \
    php-json \
    php-ldap \
    php-mbstring \
    php-mcrypt \
    php-mysql \
    php-zip && \
    apt-get clean

# add nesessary folder for php-fpm and remove previous configuration
RUN mkdir /run/php && \
    rm /etc/php/7.0/fpm/pool.d/www.conf

# add custom php.ini configuration
ADD project-demo.ini /etc/php/7.0/fpm/conf.d/
ADD project-demo.ini /etc/php/7.0/cli/conf.d/

# add custom php-fpm.pool configuration
ADD project-demo.pool.conf /etc/php/7.0/fpm/pool.d/

# install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# change container work permission to www-data
RUN usermod -u 1000 www-data

# launch php-fpm on container up
CMD ["php-fpm7.0", "-F"]

EXPOSE 9000
