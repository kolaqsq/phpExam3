<?php
function close($id, $data)
{
    $query = $data->prepare("update session set is_open=false WHERE id=?");
    $query->execute([$id]);
    header("Location: admin.php", true, 301);
    exit();
}

function open($id, $data)
{
    $query = $data->prepare("update session set is_open=true WHERE id=?");
    $query->execute([$id]);
    header("Location: admin.php", true, 301);
    exit();
}

function delete($id, $data)
{
    $query = $data->prepare("delete from session where id=?");
    $query->execute([$id]);
    header("Location: admin.php", true, 301);
    exit();
}

function addSession($id, $data)
{
    $query = $data->prepare("insert into session(id, is_open, url) values (?, ?, ?)");
    $query->execute([$id, true, 'form.php?session_id=' . $id]);
    header("Location: admin.php", true, 301);
    exit();
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Цифровые сессии. Администрирование</title>
</head>
<body>
<table>
    <h1>Сессии</h1>
    <?php
    require 'database.php';
    $database = connect();
    $sessions = $database->query("select * from session");
    $current_max = $database->query("select max(id) from session")->fetch();

    if (isset($_GET['session_id']) && $_GET['close'] == 'true')
        close($_GET['session_id'], $database);

    if (isset($_GET['session_id']) && $_GET['open'] == 'true')
        open($_GET['session_id'], $database);

    if (isset($_GET['session_id']) && $_GET['delete'] == 'true')
        delete($_GET['session_id'], $database);

    if (isset($_GET['session_id']) && $_GET['add'] == 'true')
        addSession($_GET['session_id'], $database);

    if ($sessions->rowCount() > 0) {
        echo '<tr>
        <th>ID</th>
        <th>Ссылка</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>';
        while ($row = $sessions->fetch())
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td><a href="' . $row['url'] . '">' . $row['url'] . '</a></td>
                    <td>' . ($row['is_open'] ? 'Открыто' : 'Закрыто') . '</td>
                    <td>
                        <a href="session.php?save=false&session_id=' .
                $row['id'] .
                '">Редактировать</a><span>  </span>
                        <a href="admin.php?session_id=' . $row['id'] .
                ($row['is_open'] ? '&close=true">Закрыть' : '&open=true">Открыть') .
                '</a><span>  </span><a href="admin.php?session_id=' .
                $row['id'] .
                '&delete=true">Удалить</a><span>  </span>
                    </td>
                </tr>';
    } else {
        echo "<h2>Сессии отсутсвуют. Добавьте сессии.</h2>";

    }
    echo '<a href="admin.php?session_id=' .
        ($current_max['max(id)'] + 1) .
        '&add=true"><h3>Добавить</h3></a>';
    ?>
</table>
</body>
</html>