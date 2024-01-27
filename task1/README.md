# Название проекта

Описание вашего проекта и его основные функции.

## Начало работы

### Требования

- PHP >= 7.3
- Composer
- СУБД (например, MySQL или PostgreSQL)
- Web сервер (например, Apache, Nginx)

### Установка

1. **Клонирование репозитория**

   ```shell
   git clone url_репозитория
   cd имя_папки_проекта
   ```
2. **Установите все зависимости Composer**
   Установите все зависимости Composer.
    ```shell
   composer install
   ```

3. **Конфигурация приложения**

   Скопируйте файл .env.example в .env.
    ```shell
    cp .env.example .env
   ```
   Откройте файл .env и настройте параметры окружения (база данных, почта, и т.д.):

   ```shell
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=имя_базы_данных
    DB_USERNAME=пользователь_базы_данных
    DB_PASSWORD=пароль_базы_данных
   ```

3. **Генерация ключа приложения**

   Сгенерируйте уникальный ключ приложения для обеспечения безопасности сессий и зашифрованных данных.

   ```shell
    php artisan key:generate
   ```
4. **Миграции и начальное заполнение базы данных**

   Запустите миграции и, если необходимо, начальное заполнение базы данных.

   ```shell
    php artisan migrate
    php artisan db:seed
   ```

## Использование

### Консольные команды

1. **Добавление новых карт**

   ```shell
    php artisan card:add {number} {expiry_month} {expiry_year} {csv} {owner_name} {balance}
   ```

   Пример
   ```shell
    php artisan card:add 1234567812345678 12 25 123 JohnDoe 1000.00
   ```
2. **Обновление баланса карты**

   ```shell
    php artisan card:balance-update {number} {amount}
   ```

   Пример
   ```shell
    php artisan card:balance-update 1234567812345678 500.00
    php artisan card:balance-update 1234567812345678 -- -500.00
   ```

3. **Создание клиента CardCenterClient**

   ```shell
    php artisan client:create {name} {email} {password}
   ```

   Пример
   ```shell
    php artisan client:create JohnDoe johndoe@example.com password
   ```


