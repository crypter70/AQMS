# FROM php:8.1
# RUN apt-get update -y && apt-get install -y openssl zip unzip 
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# # RUN docker-php-ext-install pdo mbstring

# # Install PHP extensions
# RUN docker-php-ext-install gd pdo pdo_mysql mbstring 


# WORKDIR /app
# COPY . /app
# RUN composer install

# CMD php artisan serve --host=0.0.0.0 --port=8181
# EXPOSE 8181

FROM php:8.1

# Install system dependencies
RUN apt-get update -y && \
    apt-get install -y \
    openssl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    curl \
    gnupg

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy application code
COPY . /app

# Install PHP dependencies
RUN composer install

# Command to run the application
CMD php artisan serve --host=0.0.0.0 --port=8181

# Expose port 8181
EXPOSE 8181

# FROM php:8.2-fpm

# ARG user
# ARG uid

# # Install system dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip \
#     supervisor \
#     nginx \
#     build-essential \
#     openssl

# RUN docker-php-ext-install gd pdo pdo_mysql sockets

# # Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# WORKDIR /var/www

# # If you need to fix ssl
# COPY ./openssl.cnf /etc/ssl/openssl.cnf

# COPY composer.json composer.lock ./
# RUN composer install --no-dev --optimize-autoloader --no-scripts

# COPY . .

# RUN chown -R $uid:$uid /var/www

# # copy supervisor configuration
# # COPY ./supervisord.conf /etc/supervisord.conf

# # run supervisor
# #CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
