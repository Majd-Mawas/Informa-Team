FROM richarvey/nginx-php-fpm:1.7.2

# Copy application source
COPY . /var/www/html

# Copy scripts folder and make sure it's executable
COPY scripts/ /scripts/
RUN chmod +x /scripts/00-laravel-deploy.sh

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Run the Laravel deploy script before starting the container
CMD ["/bin/bash", "-c", "/scripts/00-laravel-deploy.sh && /start.sh"]
