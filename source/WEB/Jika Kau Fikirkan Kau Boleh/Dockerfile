FROM php:7.4-apache

RUN apt update && apt install redis-server -y
ENV APACHE_RUN_USER  www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR   /var/log/apache2
ENV APACHE_PID_FILE  /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR   /var/run/apache2
ENV APACHE_LOCK_DIR  /var/lock/apache2
ENV APACHE_LOG_DIR   /var/log/apache2
ENV APACHE_SERVER_NAME localhost

RUN mkdir -p /app
COPY ./code/ /app
RUN chmod 0777 -R /app/uploads/sukahatila

COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD /start.sh

#EXPOSE  80
