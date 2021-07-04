FROM wyveo/nginx-php-fpm:php74
WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/ngix/html
RUN ln -s public html