FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client

# Очистка кэша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем пользователя www с UID 1000
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Устанавливаем права ПЕРЕД копированием файлов
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache
RUN chown -R www:www /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Копируем приложение
COPY ./src /var/www

# Устанавливаем права еще раз после копирования
RUN chown -R www:www /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Переключение на пользователя www
USER www

# Установка рабочей директории
WORKDIR /var/www

CMD ["php-fpm"]