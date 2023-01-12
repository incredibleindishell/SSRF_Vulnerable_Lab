FROM php:7.2-apache

RUN apt update && apt install -y xvfb libfontconfig wkhtmltopdf build-essential python-dev python-pip python-cffi libcairo2 libpango1.0-0 libpangocairo-1.0.0 libgdk-pixbuf2.0-0 libffi-dev shared-mime-info && python2 -m pip install "weasyprint<43"


RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli 
RUN  chown www-data:www-data /var/www/html/

ADD www /var/www/html/


EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]
