<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Цифровые сессии. Редактирование</title>
    <script src="../js/script.js"></script>
</head>
<body>
<?php
require 'database.php';
$database = connect();
?>
<form action="" id="questions">
    <button type="button" onclick="addQuestion('questions')">Добавиь вопрос</button>
</form>
</body>
</html>