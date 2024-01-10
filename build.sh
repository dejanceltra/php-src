#!/bin/bash
set -eu -o pipefail

./buildconf

./configure \
 --prefix=/opt/php/php8 \
 --enable-cli \
 --enable-fpm \
 --enable-intl \
 --enable-mbstring \
 --enable-opcache \
 --enable-sockets \
 --enable-soap \
 --enable-pcntl \
 --with-curl \
 --with-freetype \
 --with-fpm-user=www-data \
 --with-fpm-group=www-data \
 --with-jpeg \
 --with-mysql-sock \
 --with-mysqli \
 --with-openssl \
 --with-pdo-mysql \
 --with-odbc \
 --with-unixODBC \
 --with-pgsql \
 --with-xsl \
 --with-zlib

make -j 4
