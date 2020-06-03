FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

#need for rabbitmq
RUN docker-php-ext-install bcmath

## Copy scheduler file to the cron.d directory
#COPY scheduler /etc/cron.d/scheduler
#
## Give execution rights on the cron job
#RUN chmod 0644 /etc/cron.d/scheduler
#
## Apply cron job
#RUN crontab /etc/cron.d/scheduler
#
## Create the log file to be able to run tail
#RUN touch /var/log/cron.log
#
## Run the command on container startup
#CMD cron && tail -f /var/log/cron.log

#RUN apk update
#RUN apk add curl nano
#
#ENV EDITOR=/usr/bin/nano
#CMD ["crond", "-f", "-d", "8"]