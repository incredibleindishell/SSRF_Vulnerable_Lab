FROM php:7.2-apache

# Fix for EOL Debian Buster repositories
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list \
    && sed -i 's/security.debian.org/archive.debian.org/g' /etc/apt/sources.list \
    && sed -i '/buster-updates/d' /etc/apt/sources.list

# Install packages and older Weasyprint via Python 2
RUN apt update && apt install -y \
    xvfb \
    libfontconfig \
    wkhtmltopdf \
    build-essential \
    python-dev \
    python-pip \
    python-cffi \
    libcairo2 \
    libpango1.0-0 \
    libpangocairo-1.0.0 \
    libgdk-pixbuf2.0-0 \
    libffi-dev \
    shared-mime-info \
    && python2 -m pip install "weasyprint<43"

# Configure PHP Extensions and Permissions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
RUN chown www-data:www-data /var/www/html/

# Copy application source files
ADD www /var/www/html/

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]

