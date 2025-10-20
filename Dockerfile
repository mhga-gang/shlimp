FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y    \
        php                                 \
        php-mysql                           \
        php-gd                              \
        php-curl                            \
        php-mbstring                        \
        php-xml                             \
        php-zip                             \
        && rm -rf /var/lib/apt/lists/*

COPY . /app

WORKDIR /app

EXPOSE 1337

CMD [ "php", "-S", "0.0.0.0:1337", "shlimp.php" ]
