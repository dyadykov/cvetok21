service cron start && \
service rsyslog start && \
cp /cron /var/spool/cron/crontabs/root && \
chmod -R 600 /var/spool/cron/crontabs/ && \
php-fpm