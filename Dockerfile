FROM php:7.4.18-apache-buster
LABEL author="Jonathan Cooper"

RUN apt-get update && apt-get -y upgrade

# Expose apache.
EXPOSE 80

# Copy this repo into place.
ADD www /var/www/html

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]