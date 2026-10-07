# Лабораторная работа №4: Composer, классы и работа с публичным API

## 👩‍💻 Автор

ФИО: Янина Анастасия Алексеевна  
Группа: <указать группу>  
Вариант: 1 — Регистрация студента (API: `https://api.hh.ru/areas`)

---

## 📌 Описание задания

Подключить внешнюю библиотеку через Composer (Guzzle), создать класс `ApiClient` для запросов к публичному API, вывести полученные данные, добавить класс `UserInfo` и установку cookie после отправки формы.

---

## ⚙️ Как запустить проект

```
git clone <ссылка на репозиторий>
cd lab4
docker compose up -d --build
docker compose run --rm composer install
```

Последняя команда запускает Composer в контейнере и создаёт папку `www/vendor`.

- `http://localhost:8080/index.php` — главная
- `http://localhost:8080/form.html` — форма (после отправки выполняется запрос к API)
- `http://localhost:8080/view.php` — все данные

Если на Linux не создаётся `data.txt`: `chmod 777 www`.

---

## 📂 Содержимое проекта

- `docker-compose.yml` — сервисы `nginx`, `php` и инструментальный `composer`
- `nginx/default.conf` — конфиг Nginx с PHP-FPM
- `www/composer.json` — зависимости (`guzzlehttp/guzzle`), `www/vendor/` создаётся Composer
- `www/ApiClient.php` — класс для запросов к API на Guzzle
- `www/UserInfo.php` — класс с информацией о пользователе (IP, User-Agent, время)
- `www/process.php` — валидация, сессия, файл, cookie `last_submission`, запрос к API
- `www/index.php` — вывод данных сессии, данных API, информации о пользователе
- `www/form.html`, `www/script.js`, `www/view.php` — из ЛР-3

---

## 🧪 Ход работы

1. **Composer.** Подключён пакет `guzzlehttp/guzzle` (`composer.json`, папка `vendor`, автозагрузка `vendor/autoload.php`).
2. **Класс `ApiClient`.** Метод `request($url)` выполняет GET-запрос через Guzzle, декодирует JSON, при ошибке возвращает `['error' => ...]`.
3. **Интеграция API.** После успешной валидации формы `process.php` запрашивает `https://api.hh.ru/areas` (список регионов), сохраняет в `$_SESSION['api_data']` первые 10 регионов России. `index.php` выводит данные или сообщение об ошибке.
4. **Класс `UserInfo` и cookie.** `UserInfo::getInfo()` возвращает IP, User-Agent и время, данные выводятся на главной. После отправки формы устанавливается cookie `last_submission` на 1 час.

---

## ✅ Результат

Composer и Guzzle подключены, данные из публичного API hh.ru получаются через класс `ApiClient` и отображаются на главной странице вместе с информацией о пользователе, cookie устанавливается после отправки формы.
