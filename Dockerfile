FROM php:8.2-apache

# Cài đặt các dependencies cần thiết cho hệ thống
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Cài đặt Node.js (phiên bản 20.x)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Xóa cache apt để giảm kích thước image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài đặt các extension PHP cần thiết cho Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Kích hoạt module rewrite của Apache (cần cho routing của Laravel)
RUN a2enmod rewrite

# Đổi DocumentRoot của Apache trỏ vào thư mục public của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Tải Composer mới nhất
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ mã nguồn vào container
COPY . .

# Cài đặt các thư viện PHP thông qua Composer (bỏ qua dev dependencies)
RUN composer install --optimize-autoloader --no-dev

# Cài đặt các thư viện Node.js và build frontend (Vite/TailwindCSS)
RUN npm install
RUN npm run build

# Phân quyền cho các thư mục storage và bootstrap/cache để Laravel có thể ghi file (logs, cache, views...)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 cho web server
EXPOSE 80

# Chạy Apache trên foreground
CMD ["apache2-foreground"]
