FROM php:7.2
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpq-dev nodejs pngquant libpng-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring pdo_pgsql 
ADD . /testnewsauthors
WORKDIR /testnewsauthors
RUN composer update
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash
RUN curl -sS https://nodejs.org/dist/v8.11.2/node-v8.11.2-linux-x64.tar.xz > ~/nodejs.tar.xz
RUN cd ~ && tar xf nodejs.tar.xz
RUN mv ~/node-v8.11.2-linux-x64/bin/* /usr/bin
RUN mv ~/node-v8.11.2-linux-x64/include/* /usr/include
RUN mv ~/node-v8.11.2-linux-x64/lib/* /usr/lib
RUN npm install
RUN npm run dev
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181
