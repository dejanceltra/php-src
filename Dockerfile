FROM ubuntu:jammy

ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update
RUN apt-get install -y sudo git build-essential libmysqlclient-dev autoconf \
 re2c \
 bison \
 libsqlite3-dev \
 libpq-dev \
 libonig-dev \
 libfcgi-dev \
 libfcgi0ldbl \
 libjpeg-dev \
 libpng-dev \
 libssl-dev \
 libxml2-dev \
 libcurl4-openssl-dev \
 libxpm-dev \
 libgd-dev \
 libmysqlclient-dev \
 libfreetype6-dev \
 libxslt1-dev \
 libpspell-dev \
 libzip-dev \
 libgccjit-10-dev
 

ARG UID=1000
ARG GID=1000
RUN groupadd --gid ${GID} dev && \
    useradd --uid ${UID} --gid dev --create-home --home /home/dev --shell /bin/bash dev

# Allow passwordless sudo
RUN echo 'dev ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

USER dev
WORKDIR /app

RUN git config --global --add safe.directory /app
