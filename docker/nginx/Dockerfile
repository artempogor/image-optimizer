FROM nginx

RUN touch /var/log/nginx/error.log
RUN mkdir /etc/nginx/sites-enabled
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf
