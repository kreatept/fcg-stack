FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
libzip-dev \
libmemcached-dev \
libcurl4-openssl-dev \
libonig-dev \
libpng-dev \
libjpeg-dev \
libfreetype6-dev \
libxml2-dev \
libicu-dev \
unzip \
git \
zip \
curl \
&& docker-php-ext-configure zip \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install \
bcmath \
curl \
exif \
gd \
intl \
mbstring \
mysqli \
opcache \
pdo \
pdo_mysql \
xml \
zip

# Instala e habilita Memcached
RUN pecl install memcached \
&& docker-php-ext-enable memcached

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Limpeza
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
