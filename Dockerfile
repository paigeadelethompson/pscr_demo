FROM debian:latest

ENV DEBIAN_FRONTEND noninteractive

ENV PSCR_LIB_ROOT /pscr/

ENV PSCR_PROJECT_ROOT /pscr/

ENV COMPOSER_CACHE_DIR /tmp/

ENV HOME /tmp/

ENV HOST 0.0.0.0

ENV PORT 80

EXPOSE 80

RUN apt -y update

RUN apt -y install php7.4-cgi git 

WORKDIR /tmp

ADD https://getcomposer.org/installer /tmp/installer

RUN php /tmp/installer

RUN mv /tmp/composer.phar /usr/bin/composer 

RUN chmod +x /usr/bin/composer

ADD . /pscr

WORKDIR /pscr

RUN groupadd -g 1000 pscr

RUN useradd -u 1000 -g pscr pscr

RUN apt -y autoremove

RUN chown -R pscr:pscr /pscr

USER pscr

RUN composer install

USER root 

USER pscr

VOLUME /pscr/settings

CMD ["composer", "serve"]
