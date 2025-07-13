# Use official PHP runtime as base image
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    nginx \
    supervisor \
    curl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application files
COPY . .

# Run setup script
RUN php setup.php

# Create nginx configuration
RUN echo 'worker_processes auto;\n\
error_log /var/log/nginx/error.log warn;\n\
pid /var/run/nginx.pid;\n\
\n\
events {\n\
    worker_connections 1024;\n\
}\n\
\n\
http {\n\
    include /etc/nginx/mime.types;\n\
    default_type application/octet-stream;\n\
    \n\
    sendfile on;\n\
    tcp_nopush on;\n\
    tcp_nodelay on;\n\
    keepalive_timeout 65;\n\
    \n\
    server {\n\
        listen 8080;\n\
        server_name localhost;\n\
        root /app;\n\
        index index.php index.html;\n\
        \n\
        add_header X-Frame-Options "SAMEORIGIN" always;\n\
        add_header X-Content-Type-Options "nosniff" always;\n\
        \n\
        location / {\n\
            try_files $uri $uri/ /index.php?$query_string;\n\
        }\n\
        \n\
        location ~ \.php$ {\n\
            fastcgi_pass 127.0.0.1:9000;\n\
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
            include fastcgi_params;\n\
        }\n\
        \n\
        location ~ /\.(ht|env|git) {\n\
            deny all;\n\
        }\n\
    }\n\
}' > /etc/nginx/nginx.conf

# Create supervisor configuration
RUN mkdir -p /etc/supervisor/conf.d && \
    echo '[supervisord]\n\
nodaemon=true\n\
user=root\n\
\n\
[program:php-fpm]\n\
command=php-fpm --nodaemonize\n\
autostart=true\n\
autorestart=true\n\
\n\
[program:nginx]\n\
command=nginx -g "daemon off;"\n\
autostart=true\n\
autorestart=true' > /etc/supervisor/conf.d/supervisord.conf

# Set proper permissions
RUN chown -R www-data:www-data /app && \
    chmod 755 /app/members /app/logs /app/public/uploads

# Expose port
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/health.php || exit 1

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
