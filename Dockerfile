FROM php:8.3-alpine

ENV TIMEZONE America/Sao_Paulo

# Instalar dependências otimizadas
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    zip \
    libzip-dev \
    icu-dev \
    linux-headers \
    nodejs \
    npm \
    python3 \
    py3-pip \
    autoconf \
    dpkg-dev dpkg \
    file \
    g++ \
    gcc \
    libc-dev \
    make \
    pkgconf \
    re2c \
    $PHPIZE_DEPS && \
    curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    rm -rf /var/cache/apk/*

# Configuração de fuso horário
RUN ln -sf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && \
    echo $TIMEZONE > /etc/timezone
