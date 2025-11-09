# AgencyOrderSystem

## Инструкция по запуску

### Клонирование проекта

```bash
git clone <url-репозитория>
cd <имя-папки-проекта>
```

### Создать .env файл используя .env.example

### ЗАпустить докер контейнеры

```bash
docker-compose up -d
```

### Установка зависимостей

```bash
docker-compose exec app composer install
```

### Генерация ключа приложения

```bash
docker-compose exec app php artisan key:generate
```

### Выполнить миграции

```bash
docker-compose exec app php artisan migrate
```

### Запустить сидеры

```bash
docker-compose exec app php artisan db:seed
```
