FROM composer:latest

WORKDIR /var/www/skolkovo22_cms

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
