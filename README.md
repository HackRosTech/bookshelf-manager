# Качаем зависимости
$ composer install

# Поднимаем контейнеры
$ ./vendor/bin/sail up

# Установка ключа приложения
$ php ./vendor/bin/sail artisan key:generate

# Запускаем миграции
$ ./vendor/bin/sail artisan migrate

# Создаём админа
$ ./vendor/bin/sail artisan user:create-admin
