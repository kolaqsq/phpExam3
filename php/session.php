<?php
function saveSession($id, $data)
{
    $insert = $data->prepare("insert into questions
                              values (?, ?, ?, ?, ?)");
    $update = $data->prepare("update questions
                              set type          = ?,
                                  question_text = ?
                              where id = ?");

    foreach ($_POST as $answer) {
        if ($answer[0] != 0) {
            $update->execute([$answer[1], $answer[2], $answer[0]]);
        } else {
            $max_id = $data->query("select max(id) from questions")->fetch();
            $max_number = $data->query("select max(number_in_session) from questions")->fetch();
            $insert->execute([$max_id['max(id)'] + 1, $id, $max_number['max(number_in_session)'] + 1, $answer[1], $answer[2]]);
        }
    }

    header("Location: session.php?save=false&session_id=" . $id, true, 301);
    exit();

}

function deleteQuestion($session, $question, $data)
{
    $query = $data->prepare("delete
                             from questions
                             where id = ?");
    $query->execute([$question]);

    header("Location: session.php?save=false&session_id=" . $session, true, 301);
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
    <title>Цифровые сессии. Редактирование</title>
    <script src="../js/script.js"></script>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php
require 'database.php';
$database = connect();
$query_questions = $database->prepare("select * from questions where session_id = ?");
$query_questions->execute([$_GET['session_id']]);

if (isset($_GET['session_id']) && $_GET['save'] == 'true')
    saveSession($_GET['session_id'], $database);

if (isset($_GET['session_id']) && isset($_GET['delete_id']))
    deleteQuestion($_GET['session_id'], $_GET['delete_id'], $database);
?>
<form action="session.php?session_id=<?php echo $_GET['session_id'] ?>&save=true" method="post" id="session_form">
    <button type="button" onclick="i++; addQuestion('questions', i)">Добавиь вопрос</button>
    <input type="submit" value="Сохранить">
    <div id="questions">
        <?php
        while ($question = $query_questions->fetch()) {
            echo
                '<div class="question" id="question' . $question['id'] . '">' .
                '   <h3>Вопрос №' . $question['number_in_session'] . ':</h3>' .
                '   <button type="button" onclick="window.location.replace(\'session.php?save=false&session_id=' . $_GET['session_id'] . '&delete=true&delete_id=' . $question['id'] . '\')" id="delete_question' . $question['id'] . '">Удалить вопрос</button>' .
                '   <input name="question_' . $question['id'] . '[]" type="text" value="' . $question['id'] . '" style="display: none">' .

                '   <br><label for="question_type' . $question['id'] . '">Тип вопроса: </label>' .
                '   <select name="question_' . $question['id'] . '[]" id="question_type' . $question['id'] . '">' .
                '       <option' . ($question['type'] == 1 ? 'checked' : '') . ' value="1">с открытым ответом (число)</option>' .
                '       <option' . ($question['type'] == 2 ? 'checked' : '') . ' value="2">с открытым ответом (положительное число)</option>' .
                '       <option' . ($question['type'] == 3 ? 'checked' : '') . ' value="3">с открытым ответом (строка)</option>' .
                '       <option' . ($question['type'] == 4 ? 'checked' : '') . ' value="4">с открытым ответом (текст)</option>' .
                '   </select>' .

                '   <br><label for="question_text' . $question['id'] . '">Текст вопроса: </label>' .
                '   <textarea name="question_' . $question['id'] . '[]" id="question_text' . $question['id'] . '"' .
                '        >' . $question['question_text'] . '</textarea></div>';
        }
        ?>
    </div>
</form>
</body>
</html>
