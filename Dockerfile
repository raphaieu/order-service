# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões do PHP necessárias para Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . .

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala dependências do Laravel
RUN composer install && chmod -R 777 storage bootstrap/cache

# Cria o banco SQLite
RUN mkdir -p database && touch database/database.sqlite && chmod 777 database/database.sqlite

# Habilitar mod_rewrite no Apache
RUN a2enmod rewrite

# Permitir que .htaccess sobrescreva as configurações do Apache
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expõe a porta do Apache
EXPOSE 80

CMD ["apache2-foreground"]
