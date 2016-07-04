FROM ubuntu

RUN mkdir -p /var/www
CMD -v .:/var/www

RUN apt-get update
RUN apt-get install -y php7 phpunit curl mc htop
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
