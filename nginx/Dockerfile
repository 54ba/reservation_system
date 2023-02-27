FROM nginx

RUN rm /etc/nginx/conf.d/default.conf
COPY ./sites-available /etc/nginx/sites-available/
COPY nginx.conf /etc/nginx/nginx.conf
COPY ./ssl /etc/nginx/conf.d/ssl/

