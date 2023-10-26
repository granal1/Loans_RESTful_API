
# О приложении

RESTful API  для управления заявками от дилеров на выдачу кредитов в автомобильной корпорации. API предоставляет следующий функционал:

1. Создание, просмотр, редактирование и удаление заявок от дилеров на выдачу кредитов.
2. Каждая заявка содержит следующие атрибуты: 
    - дилер (название дилера), 
    - контактное лицо (сотрудник дилера), 
    - сумма кредита, 
    - срок кредита, 
    - процентная ставка, 
    - описание причины кредита, 
    - статус заявки (например, новая, в процессе, одобрена, отклонена), 
    - банк, одобривший заявку,
    - дата создания,
    - дата обновления.
3. Сотрудники головной организации могут просматривать список всех заявок, с пагинацией.
4.  Для хранения информации API использует PostgreSQL.
5. Развертывание проекта производится с помощью Docker контейнеров. Используются следующие контейнеры:
    - nginx: Веб-сервер Nginx для обслуживания RESTful API.
    - php-fpm: PHP-FPM для выполнения PHP-скриптов.
    - postgresql: Контейнер с PostgreSQL для хранения данных о заявках и других сущностей.

## Форматы ответов
Приложение возвращает ответ как в формате json, так и в формате html.
Для получения ответа в формате json необходимо в заголовке указать Accept: 'application/json'.

## Выполнение запросов
Приложение обрабатывает следующие запросы:

|МЕТОД|ПУТЬ|ДЕЙСТВИЕ|
|:-|:--------|:---|
|GET\|HEAD|api/v1/(сущность)|получение списка сущности|
|GET\|HEAD|api/v1/(сущность)/{id}|получение сущности указанного id|
|GET\|HEAD|api/v1/(сущность)/create|получение html формы для добавления сущности (не используется для json)|
|GET\|HEAD|api/v1/(сущность)/{id}/edit|получение html формы для редактирования сущности указанного id (не используется для json)|
|POST|api/v1/(сущность)|добавдение сущности|
|PUT\|PATCH|api/v1/(сущность)/{id}|Сохранение изменений сущности указанного id|
|DELETE|api/v1/(сущность)/{id}|удаление сущности указанного id|

Выполнение запросов возможно по следующим сущностям:

- banks - Банки;
- dealerships - Дилерские автоцентры;
- statuses - Статусы состояния рассмотрения заявок на предоставление автокредитов;
- employees - Сотрудники дилерских автоцентров;
- loans - Заявки на автокредиты;

# Описание сущностей:

## banks:

Список банков. Не имеет внешних ключей.

|поле|Тип|
|:-|:-|
|id|bigint Автоматическое приращение [nextval('banks_id_seq')]|
|name|character varying(256)|	
|created_at|timestamp(0) NULL|	
|updated_at|timestamp(0) NULL|	
|deleted_at|timestamp(0) NULL|

Пример запроса на добавление нового банка: 

` api/v1/banks?name=АО Банк `

Запрос на получение записи id=1: `/api/v1/banks/1`

Пример ответа в формате json:

```
{
    "id": 1,
    "name": "АО Банк",
    "created_at": "2023-10-01 00:00:00",
    "updated_at": "2023-10-01 00:00:00",
    "deleted_at": null
}
```

## dealerships:

Список дилерских центров. Не имеет внешних ключей.

|поле|Тип|
|:-|:-|
|id|bigint Автоматическое приращение [nextval('dealerships_id_seq')]|
|name|character varying(128)|
|address|character varying(256) NULL|
|created_at|timestamp(0) NULL|
|updated_at|timestamp(0) NULL|
|deleted_at|timestamp(0) NULL|

Пример запроса на добавление нового дилерского центра: 

` api/v1/dealerships?name=Дилерский центр №1&address=ул. Улица, д.1 `

Запрос на получение записи id=1: `api/v1/dealerships/1`

Пример ответа в формате json:

```
{
    "id": 1,
    "name": "Дилерский центр №1",
    "address": "ул. Улица, д.1",
    "created_at": "2023-10-01 00:00:00",
    "updated_at": "2023-10-01 00:00:00",
    "deleted_at": null
}
```


## statuses:

Список статусов состояния рассмотрения заявок на предоставление автокредитов. Не имеет внешних ключей.

|поле|Тип|
|:-|:-|
|id|bigint Автоматическое приращение [nextval('statuses_id_seq')]|
|name|character varying(128)|
|created_at|timestamp(0) NULL|
|updated_at|timestamp(0) NULL|
|deleted_at|timestamp(0) NULL|

Пример запроса на добавление нового статуса: 

` api/v1/dealerships?name=Новый `

Запрос на получение записи id=1: `api/v1/statuses/1`

Пример ответа в формате json:

```
{
    "id": 1,
    "name": "Новый",
    "created_at": "2023-10-01 00:00:00",
    "updated_at": "2023-10-01 00:00:00",
    "deleted_at": null
}
```


## employees:

Список сотрудников дилерских центров. Имеет внешний ключ:

`employees.dealership_id -> dealerships.id`

|поле|Тип|
|:-|:-|
|id|bigint Автоматическое приращение [nextval('employees_id_seq')]|
|dealership_id|bigint|
|name|character varying(256)|
|key|character varying(64) NULL|
|created_at|timestamp(0) NULL|
|updated_at|timestamp(0) NULL|
|deleted_at|timestamp(0) NULL|

Поле `key` является персональным "ключем" сотрудника, в настоящее время не используется.

Пример запроса на добавление нового сотрудника: 

` api/v1/employees?dealership_id=1&name=Фамилия ИО&key=111www `

Запрос на получение записи id=1: `api/v1/employees/1`

Пример ответа в формате json:

```
{
    "id": 1,
    "dealership_id": 1,
    "name": "Фамилия ИО",
    "key": "111www",
    "created_at": "2023-10-01 00:00:00",
    "updated_at": "2023-10-01 00:00:00",
    "deleted_at": null,
    "dealership_name": "Дилерский центр №1"
}
```


## loans:

Список заявок от дилеров на выдачу кредитов. Имеет внешние ключи:

- `loans.dealership_id -> dealerships.id`
- `loans.employees_id -> employees.id`
- `loans.statuses_id -> statuses.id`
- `loans.banks_id -> banks.id`


|поле|Тип|
|-|-|
|id|bigint Автоматическое приращение [nextval('loans_id_seq')]|
|dealership_id|bigint|
|employee_id|bigint|
|amount|numeric(10,2)|
|months|smallint|
|interest|numeric(3,2)|
|reason|text|
|status_id|bigint NULL|
|bank_id|bigint NULL|
|created_at|timestamp(0) NULL|
|updated_at|timestamp(0) NULL|
|deleted_at|timestamp(0) NULL|

- Поле `amount` - Размер запрашиваемого кредита;
- Поле `months` - Срок кредила в месяцах;
- Поле `interest` - Процент по кредиту;
- Поле `reason` - Описание причины кредита;

Пример запроса на добавление новой заявки: 

` api/v1/loans?dealership_id=1&employee_id=1&amount=999999.99&months=99&interest=9.99&reason=Приобретение автомобиля под залог недвижимости `

Запрос на получение записи id=1: `api/v1/loans/1`

Пример ответа в формате json:

```
{
    "id": 1,
    "dealership_id": 1,
    "employee_id": 1,
    "amount": "999999.99",
    "months": 99,
    "interest": "9.99",
    "reason": "Приобретение автомобиля под залог недвижимости",
    "status_id": 2,
    "bank_id": 1,
    "created_at": "2023-10-01 00:00:00",
    "updated_at": "2023-10-01 00:00:00",
    "deleted_at": null,
    "dealership_name": "Дилерский центр №1",
    "employee_name": "Фамилия ИО",
    "status_name": "На рассмотрении",
    "bank_name": "АО Банк"
}
```
# <u>Безопасность</u>

<u>Вопрос безопасности данных и несанкционированного доступа к данным не прорабатывался и не реализовывался!</u>

# Установка и настройка

Для работы может использоваться Docker.

- [Docker CE](https://docs.docker.com/engine/installation/)
- [Docker Compose](https://docs.docker.com/compose/install)
- [Adminer](https://www.adminer.org/)
- Git (опционально)

Работа проверена на наборе из репозитория `https://github.com/granal1/docker-php-nginx-postgres-adminer-composer-laravel`.  
1. Установка Docker из указанного репозитория выполняется командой - `git clone https://github.com/granal1/docker-php-nginx-postgres-adminer-composer-laravel.git project`  
2. Клонирование данного приложения выполняется командой - `mkdir -m 777 html && git clone https://github.com/granal1/Loans_RESTful_API.git html`  
3. В директории html создать .env по примеру .env.example. Внести в .env настройки работы с БД из .env, находящегося в корне
проекта.
4. Обновление указанных в composer.json библиотек - `make composer-update` (`docker-compose run --rm php composer update`)  
5. Команда запуска контейнера - `make start-dev` (`docker-compose up -d`)  
6. Сгенерировать ключ безопасности - `make generate-app-key` (`docker-compose run --rm php php artisan key:generate`)  
7. Создание рабочих таблиц в БД - `make database-migrate` (`docker-compose run --rm php php artisan migrate --force`)  
8. Сброс БД к первичному состоянию - `make database-seed` (`docker-compose run --rm php php artisan migrate:fresh --seed`)  

Использование Docker при работе с приложением с соответствии с документацией.

## Первый запуск

Как сказано выше, отправка запроса и получение ответа может осуществляться как в формате json, так и html.  

Проверить работу формате json можно сформировав запрос используя различные  приложения, например Postman.  

Протестировать работу приложения в формате html можно используя любой браузер, отправив запрос например: `http://localhost/api/v1/banks`. Или любой другой, как указано выше.  

Для очистки БД от информации можно использовать команду:

`docker-compose exec php php artisan migrate:refresh --seed`
