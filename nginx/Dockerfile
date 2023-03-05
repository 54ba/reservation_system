FROM nginx

# copy nginx configuration

RUN rm /etc/nginx/conf.d/default.conf
COPY ./sites-available /etc/nginx/sites-available/
COPY nginx.conf /etc/nginx/nginx.conf
COPY ./ssl /etc/nginx/conf.d/ssl/




# install nginx


# ENV NGINX_VERSION 1.20.2
# ENV NJS_VERSION   0.7.0
# ENV PKG_RELEASE   1
# RUN set -x \
#     && nginxPackages=" \
#         nginx=${NGINX_VERSION}-r${PKG_RELEASE} \
#         nginx-module-xslt=${NGINX_VERSION}-r${PKG_RELEASE} \
#         nginx-module-geoip=${NGINX_VERSION}-r${PKG_RELEASE} \
#         nginx-module-image-filter=${NGINX_VERSION}-r${PKG_RELEASE} \
#         nginx-module-njs=${NGINX_VERSION}.${NJS_VERSION}-r${PKG_RELEASE} \
#     " \
#     set -x \
#     && KEY_SHA512="e7fa8303923d9b95db37a77ad46c68fd4755ff935d0a534d26eba83de193c76166c68bfe7f65471bf8881004ef4aa6df3e34689c305662750c0172fca5d8552a *stdin" \
#     && apk add --no-cache --virtual .cert-deps \
#         openssl \
#     && wget -O /tmp/nginx_signing.rsa.pub https://nginx.org/keys/nginx_signing.rsa.pub \
#     && if [ "$(openssl rsa -pubin -in /tmp/nginx_signing.rsa.pub -text -noout | openssl sha512 -r)" = "$KEY_SHA512" ]; then \
#         echo "key verification succeeded!"; \
#         mv /tmp/nginx_signing.rsa.pub /etc/apk/keys/; \
#     else \
#         echo "key verification failed!"; \
#         exit 1; \
#     fi \
#     && apk del .cert-deps \
#     && apk add -X "https://nginx.org/packages/alpine/v$(egrep -o '^[0-9]+\.[0-9]+' /etc/alpine-release)/main" --no-cache $nginxPackages
    
# RUN ln -sf /dev/stdout /var/log/nginx/access.log \
#     && ln -sf /dev/stderr /var/log/nginx/error.log
    