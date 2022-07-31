FROM debian:stretch

ENV DEBIAN_FRONTEND noninteractive

ENV PSCR_LIB_ROOT /pscr/

ENV PSCR_PROJECT_ROOT /pscr/

ENV COMPOSER_CACHE_DIR /tmp/

EXPOSE 80

RUN apt -y update

RUN apt -y install php7.0-cgi composer

ADD . /pscr

WORKDIR /pscr

RUN groupadd -g 1000 pscr

RUN useradd -u 1000 -g pscr pscr

RUN chown -R pscr:pscr /pscr

USER pscr

RUN composer install

RUN apt -y remove composer

RUN apt -y autoremove

VOLUME /pscr/settings

CMD ["/usr/bin/php", "-S", "0.0.0.0:80", "/pscr/index.php"]
