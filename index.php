<?php
function passCheck($password, $data)
{
    if ($password <> '') {
        $query = $data->query("select password from admin where password = '$password'");
        $row = $query->fetch();
        if (isset($row['password']))
            if (($password === $row['password'])) {
                header("Location: php/admin.php", true, 301);
                exit();
            } else return null;
    } else return null;
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Цифровые сессии. Вход</title>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
require 'php/database.php';

try {
    $database = connect();
    if (!isset($_POST['password']))
        $_POST['password'] = '';

    echo '<form action="' . passCheck($_POST['password'], $database) . '" method="post">
    <h1>Вход</h1>
    <label for="password">Пароль: </label>
    <input type="text" name="password" id="password" required placeholder="Введите пароль">
    <input type="submit" value="Войти">
</form>';
} catch (PDOException $e) {
    echo '<br><span>Ошибка подключения к базе данных: ' . $e->getMessage() . '</span>';
}
$database = null;
?>
</body>
</html>
