#!/bin/bash

# Verifique se o arquivo database.sqlite existe
if [ ! -f /var/www/html/database/database.sqlite ]; then
  echo "Criando o arquivo database.sqlite..."
  touch /var/www/html/database/database.sqlite
  chmod 664 /var/www/html/database/database.sqlite
fi

# Execute as migrações
echo "Executando as migrações..."
php artisan migrate --force

# Inicie o Apache
echo "Iniciando o servidor Apache..."
apache2-foreground