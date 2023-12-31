# Тестовое задание

Описание проекта и его назначение.

## Инструкции по установке

1. Клонируйте репозиторий: `git clone <URL_репозитория>`
2. Откройте терминал и перейдите в папку `infra`
3. Выполните команду: `docker-compose up -d --build`
4. Войти в Docker-контейнер: `docker exec -it php-fpm81 /bin/bash`
5. Выполнить команду `Composer install`
6. Применить миграции `bin/console doctrine:migrations:migrate`  
7. Создать файл `cat> .env.local` и вставить `OPEN_WEATHER_MAP_API_KEY=35a6039ba01ce5a3244aff78206b27a6`
8. СRUD пользователей по адресу http://localhost:8080/user/
9. Экспорт пользователей http://localhost:8080/user/export

## Описание

Возьмите пустой symfony 5 или 6, создайте таблицы: Пользователей, Роли пользователей. Создайте CRUD для Пользователей, с возможностью  выгрузки данных в файл .xlsx
При выводе данных о пользователе на странице, для каждого пользователя должна выводиться актульная погода в его городе. Можно использовать любой сервис для отображения погоды.
Ответы от сервиса, должны кэшироваться на 1 час.

### Приветствуется:
- Использование Docker.
- Реализация возможности импорта пользователей и команды по выгрузке пользователей в .xlsx с плановым выполнением.

Итоговую работу необходимо выложить на GitHub и в README написать инструкцию по запуску приложения.

### Примечание
    - Папка ипорта пользователей public/upload/users.xlsx 
    - Команда для экспорта bin/console app:export-user
