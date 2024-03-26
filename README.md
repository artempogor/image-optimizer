# Image-optimize

На момент 19.03.2024 залит на хост http://185.87.150.75:8876

Микросервис для оптимизации изображений. Сделан на фреймворке lumen
<a href="https://lumen.laravel.com/docs/10.x">https://lumen.laravel.com/docs/10.x</a>. В сервисе установленно два расширения для обработки изображений : GD и Imagick (см [OptimizeInterface.php](app%2FServices%2FOptimize%2FOptimizeInterface.php))

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
