FROM mysql/mysql-server:8.0.23

# Copy the my.cnf file into the Docker image

COPY /my.cnf /etc/mysql/conf.d/

# Set the environment variables for the MySQL server

ENV MYSQL_DATABASE=ticketposs \
    MYSQL_ALLOW_EMPTY_PASSWORD=yes \
    MYSQL_ROOT_PASSWORD=secret

# Expose the default MySQL port

EXPOSE 3306
