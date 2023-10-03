FROM mysql:latest
COPY base.sql /mysql/base.sql

WORKDIR /mysql
RUN ls
CMD mysql -u user -p secret wbd-db < base.sql
