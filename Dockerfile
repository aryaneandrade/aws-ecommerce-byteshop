# Usa imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões necessárias para MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Habilita mod_rewrite do Apache (útil para URLs amigáveis se for expandir o MVC)
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Ajusta permissões (o Apache roda como www-data)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expõe a porta 80
EXPOSE 80