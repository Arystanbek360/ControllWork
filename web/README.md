# Название проекта

Описание вашего проекта и его основные функции.

## Начало работы

### Требования

- PHP >= 8.0
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

1. **Вся документация по апи находятся тут**

   ```shell
    http://localhost:8082/api/documentation#/
   ```