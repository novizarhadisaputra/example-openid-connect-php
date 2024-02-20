FROM php:8.2-fpm

# Install required dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    curl \
    git \
    unzip \
    libpq-dev \
    postgresql-client \
    && rm -rf /var/lib/apt/lists/*

# Install PostgreSQL extension
RUN docker-php-ext-install pdo_pgsql pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --no-scripts --no-progress --no-suggest

# Optimize autoloader
RUN composer dump-autoload --no-dev --optimize
RUN php artisan config:clear && php artisan optimize:clear

# Expose port
EXPOSE 8000
