# Image-optimize

Микросервис для оптимизации изображений. Сделан на фреймворке laravel
<a href="https://lumen.laravel.com/docs/10.x">https://lumen.laravel.com/docs/10.x</a>

## Установка

### Установка с использованием docker

1. ```cp .env.example .env```

2. Настроить необходимые переменные окружения (подключение к БД, volume для БД).

3. ```docker-compose up -d --build```

4. В контейнере php-fpm выполнить команды
    1. ```composer install```
    2. ```php artisan migrate```
## Тестирование эндпоинтов

1. Оптимизация изображения : [test.http](http-client%2Ftest.http)
   * optimize_level - уровень сжатия избражения
   * image - исходное изображение
   * service-key (header) - межсервисный ключ