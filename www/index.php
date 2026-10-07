<?php
session_start();
require_once 'UserInfo.php';
$info = UserInfo::getInfo();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Регистрация студента</h1>

    <?php if (isset($_SESSION['errors'])): ?>
        <ul style="color:red;">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <p>Данные из сессии:</p>
        <ul>
            <li>Имя: <?= $_SESSION['username'] ?></li>
            <li>Email: <?= $_SESSION['email'] ?></li>
            <li>Возраст: <?= $_SESSION['age'] ?></li>
            <li>Факультет: <?= $_SESSION['faculty'] ?></li>
            <li>Согласен с правилами: <?= $_SESSION['agree'] ?></li>
            <li>Форма обучения: <?= $_SESSION['study_form'] ?></li>
        </ul>
    <?php else: ?>
        <p>Данных пока нет.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['api_data'])): ?>
        <h3>Данные из API:</h3>
        <?php if (isset($_SESSION['api_data']['error'])): ?>
            <p style="color:red;">API недоступно: <?= htmlspecialchars($_SESSION['api_data']['error']) ?></p>
        <?php else: ?>
            <pre><?= htmlspecialchars(print_r($_SESSION['api_data'], true)) ?></pre>
        <?php endif; ?>
    <?php endif; ?>

    <h3>Информация о пользователе:</h3>
    <?php foreach ($info as $key => $val): ?>
        <?= htmlspecialchars($key) ?>: <?= htmlspecialchars($val) ?><br>
    <?php endforeach; ?>
    <?php if (isset($_COOKIE['last_submission'])): ?>
        last_submission (cookie): <?= htmlspecialchars($_COOKIE['last_submission']) ?><br>
    <?php endif; ?>

    <br>
    <a href="form.html">Заполнить форму</a> |
    <a href="view.php">Посмотреть все данные</a>
</body>
</html>
