services:
app:
build:
context: .
dockerfile: Dockerfile
container_name: laravel_app
restart: unless-stopped
working_dir: /var/www
volumes:
- ./src:/var/www
- ./php/php.ini:/usr/local/etc/php/php.ini
networks:
- laravel-network

webserver:
image: nginx:alpine
container_name: nginx_server
restart: unless-stopped
ports:
- "8000:80"
volumes:
- ./src:/var/www
- ./nginx/default.conf:/etc/nginx/conf.d/default.conf
depends_on:
- app
networks:
- laravel-network

db:
image: mysql:8.0
container_name: mysql_db
restart: unless-stopped
environment:
MYSQL_DATABASE: ${DB_DATABASE:-laravel}
MYSQL_ROOT_PASSWORD: ${DB_PASSWORD:-secret}
MYSQL_PASSWORD: ${DB_PASSWORD:-secret}
MYSQL_USER: ${DB_USERNAME:-laravel}
volumes:
- dbdata:/var/lib/mysql
- ./mysql/init.sql:/docker-entrypoint-initdb.d/init.sql
ports:
- "3306:3306"
networks:
- laravel-network

phpmyadmin:
image: phpmyadmin/phpmyadmin
container_name: pma
links:
- db
environment:
PMA_HOST: db
PMA_PORT: 3306
PMA_ARBITRARY: 1
restart: always
ports:
- 8081:80
networks:
- laravel-network

volumes:
dbdata:
driver: local

networks:
laravel-network:
driver: bridge