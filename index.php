<?php
function passCheck($password, $data)
{
    if ($password <> '') {
        $result = mysqli_query($data, "select passwords from admins where passwords = '$password'");
        $row = mysqli_fetch_assoc($result);
        if (isset($row['passwords']))
            if (($password === $row['passwords'])) {
                header("Location: admin.php", true, 301);
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
