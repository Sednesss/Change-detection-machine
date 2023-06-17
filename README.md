# ПО необходимое для запуска приложения:

Наименование | Ссылка
------------ | ------------
Docker для linux | https://timeweb.cloud/tutorials/docker/kak-ustanovit-docker-na-ubuntu-22-04
Docker для Windows | https://www.docker.com/products/docker-desktop/
Yandex Object Storage| https://cloud.yandex.ru/services/storage
Git | https://git-scm.com/downloads
Ubuntu on WSL | https://ubuntu.com/wsl

# Установка на Ubuntu/Debain:

## Клонирование репозитория:
### 
    1. git clone <repositpry-link>
### 
    2. sudo chmod 777 -R ./
## Запуск laravel приложения:
###
    1. cd laravel
    2. docker-compose up -d --build
### 
    3. Добавление переменных окружения:
        3.1 cp .env.example .env
        3.2 Необходимо вставить свои значения для соединения с yandex.cloud:
            YANDEX_CLOUD_KEY=
            YANDEX_CLOUD_SECRET=
            YANDEX_CLOUD_ENDPOINT=
            YANDEX_CLOUD_REGION=
            YANDEX_CLOUD_BUCKET=
            YANDEX_CLOUD_URL= 
###
    4. docker exec app composer i
    5. docker exec app php artisan migrate
    6. docker exec app php artisan key:generate
    7. docker exec app npm run build
###
    8. Запуск отслеживания заданий:
        docker exec app php artisan queue:work

## Запуск python приложения:
###
    1. cd python
###
    2. Добавление переменных окружения:
        2.1 cp .env.example .env
        2.2 Необходимо вставить свои значения для соединения с yandex.cloud:
            YANDEX_CLOUD_KEY=
            YANDEX_CLOUD_SECRET=
            YANDEX_CLOUD_ENDPOINT=
            YANDEX_CLOUD_REGION=
            YANDEX_CLOUD_BUCKET=
###
    3. docker-compose up -d --build

# Установка на Windows:
1. Включить поддержку WSL:

    Панель управления --> Программы --> Программы и компоненты --> Включение и отключение компонентов Windows: 
    - (вкл) Родсистема Windows для Linux
    - (вкл) Платформа виртуальной машины
    #

2. Выполнить установкувку Docker Descktop
3. Выполнить установку WSL Ubuntu
4. Разрешить использование Docker в WSL:
    Docker Desctop --> Settings --> Resources --> WSL Integration:
    - (вкл) Ubuntu 
    #
5. Запуск WSL Ubuntu и выполнение команд из раздела **__Установка на Ubuntu/Debain__**