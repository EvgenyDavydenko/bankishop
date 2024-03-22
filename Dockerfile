# Use the official PHP image as the base image
FROM php:8.2.16-cli-bookworm

RUN apt update
RUN apt install -y git zip curl \ 
    ca-certificates gnupg
    # cron

RUN docker-php-ext-install pdo_mysql

# install swoole
# RUN pecl install swoole && docker-php-ext-enable swoole

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install nodejs
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_20.x nodistro main" > /etc/apt/sources.list.d/nodesource.list
RUN apt update
RUN apt install -y nodejs

# Add the cron job
# RUN echo "* * * * * /usr/local/bin/php /var/www/html/index.php" | crontab -
# RUN chmod 0600 /var/spool/cron/crontabs/root
# CMD ["/usr/sbin/cron", "-f"]

WORKDIR /var/www/html
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www
USER "1000:1000"

