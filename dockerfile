# Use uma imagem oficial do PHP com Apache
FROM php:8.2-apache

# Atualize o sistema e instale dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instale o Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Habilite o módulo Apache mod_rewrite
RUN a2enmod rewrite

# Configure o Apache para usar o diretório public do Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/sites-available/000-default.conf

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos do projeto Laravel para o contêiner
COPY . /var/www/html/

# Ajuste as permissões do diretório database e do arquivo database.sqlite
RUN chmod -R 775 /var/www/html/database && \
    chown -R www-data:www-data /var/www/html/database

# Ajuste as permissões para o diretório de armazenamento e cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instale as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Gere a chave da aplicação Laravel
RUN php artisan key:generate

# Exponha a porta 80
EXPOSE 80

# Use o script de inicialização como comando padrão
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh
CMD ["start.sh"]