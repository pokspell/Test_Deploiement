FROM nginx:latest
WORKDIR /app

# Ligne pour créer le dossier où mettre le fichier de certificat et clé privée
RUN mkdir /etc/nginx/ssl

# Partie où on rajoute les droits aux dossiers nécessaires pour l'utilisateur nginx
RUN chown -R nginx:nginx /app && chmod -R 755 /app && \
  chown -R nginx:nginx /var/cache/nginx && \
  chown -R nginx:nginx /var/log/nginx && \
  chown -R nginx:nginx /etc/nginx/conf.d
RUN touch /var/run/nginx.pid && \
  chown -R nginx:nginx /var/run/nginx.pid
RUN chown -R nginx:nginx /app
RUN chown root:root /etc/nginx/ssl

# Ligne où on copie le fichier de configuration pour NGINX
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Partie Certificats et droits sur ceux-ci
COPY ./nginx/cert/deploiement-samuel.com.key /etc/nginx/ssl/deploiement-samuel.com.key
COPY ./nginx/cert/deploiement-samuel.com.crt /etc/nginx/ssl/deploiement-samuel.com.crt
RUN chown -R nginx:nginx /etc/nginx/ssl && chmod 755 /etc/nginx/ssl/deploiement-samuel.com.crt
RUN chown nginx:root /etc/nginx/ssl/deploiement-samuel.com.key && chmod 400 /etc/nginx/ssl/deploiement-samuel.com.key

# On enlève les droits sur l'utilisateur nginx qui sont inutiles
RUN chmod -R 750 /usr/bin/

# On change l'utilisateur pour nginx au lieu de root
USER nginx

CMD ["nginx", "-g", "daemon off;"]
