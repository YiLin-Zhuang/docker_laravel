FROM php:7.4-apache

# 安裝必要的套件和擴充模組】
RUN apt-get update && \
    apt-get install -y libpq-dev libzip-dev unzip && \
    docker-php-ext-install pdo pdo_mysql zip && \
    pecl install xdebug-2.9.8 && \
    docker-php-ext-enable xdebug && \
    rm -rf /var/lib/apt/lists/*

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 複製 Laravel 專案到容器中
WORKDIR /var/www/html
COPY src .

# 安裝 Laravel 相依套件並設定權限
RUN composer install --optimize-autoloader --no-dev
RUN chown -R www-data:www-data /var/www/html/storage

# 啟動 Laravel 內建的伺服器
CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]