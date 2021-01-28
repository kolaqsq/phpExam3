<?php
function saveSession($id, $data)
{
    echo 'сохрание не работает';
//    header("Location: session.php?save=false&session_id=" . $_GET['session_id'], true, 301);

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
</head>
<body>
<?php
require 'database.php';
$database = connect();
$query_questions = $database->prepare("select * from questions where session_id = ?");
$query_questions->execute([$_GET['session_id']]);
$questions = $query_questions->rowCount();

if (isset($_GET['session_id']) && $_GET['save'] == 'true')
    saveSession($_GET['session_id'], $database);
?>
<form action="session.php?session_id=<?php echo $_GET['session_id'] ?>&save=true" method="post" id="questions">
    <button type="button" onclick="addQuestion('questions', <?php echo $questions + 1 ?>)">Добавиь вопрос</button>
    <?php
    while ($question = $query_questions->fetch()) {
        echo
            '<br><div id="question' . $question['id'] . '">' .
            '   <h3>Вопрос №' . $question['number_in_session'] . ':</h3>' .
            '   <button type="button" onclick="deleteQuestion(this.id.substring(15))" id="delete_question' . $question['id'] . '">Удалить вопрос</button>' .

            '   <br><label for="question_type' . $question['id'] . '">Тип вопроса: </label>' .
            '   <select onchange="changeType(this.id.substring(13))" name="question_type' . $question['id'] . '" id="question_type' . $question['id'] . '">' .
            '       <option' . ($question['type'] == 1 ? 'checked' : '') . ' value="1">с открытым ответом (число)</option>' .
            '       <option' . ($question['type'] == 2 ? 'checked' : '') . ' value="2">с открытым ответом (положительное число)</option>' .
            '       <option' . ($question['type'] == 3 ? 'checked' : '') . ' value="3">с открытым ответом (строка)</option>' .
            '       <option' . ($question['type'] == 4 ? 'checked' : '') . ' value="4">с открытым ответом (текст)</option>' .
            '       <option' . ($question['type'] == 5 ? 'checked' : '') . ' value="5">с единственным выбором</option>' .
            '       <option' . ($question['type'] == 6 ? 'checked' : '') . ' value="6">с множественным выбором</option>' .
            '   </select>' .

            '   <br><label for="question_text' . $question['id'] . '">Текст вопроса: </label>' .
            '   <textarea name="question_text' . $question['id'] . '" id="question_text' . $question['id'] . '"' .
            '        >' . $question['question_text'] . '</textarea>' .
            '   <br><button type="button" onclick="addOption(this.id.substring(10))" id="add_option' . $question['id'] . '" style="display: none">Добавить вариант ответа</button>';

        $query_options = $database->prepare("select * from options where question_id = ?");
        $query_options->execute([$question['id']]);
        while ($option = $query_options->fetch()) {
            echo
                '<div id="option' . $option['id'] . '_1">' .
                '    <br><label for="option_text' . $option['id'] . '_' . $option['number_in_question'] .
                '">Вариант ответа №' . $option['number_in_question'] . ': </label>' .

                '    <textarea name="option_text' . $option['id'] . '_' . $option['number_in_question'] .
                '" id="option_text' . $option['id'] . '_' . $option['number_in_question'] . '"' .
                '          >' . $option['option_text'] . '</textarea>' .

                '    <br><label for="option_mark' . $option['id'] . '_' . $option['number_in_question'] . '">Баллы: </label>' .
                '    <input type="number" min="-100" max="100" name="option_mark' . $option['id'] . '_' .
                $option['number_in_question'] . '" id="option_mark' . $option['id'] . '_' . $option['number_in_question'] . '"' .
                '           value="' . $option['option_mark'] . '">' .

                '    <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' .
                $option['id'] . '_' . $option['number_in_question'] . '">Удалить</button>' .
                '</div>';
        }
        echo '</div>';
    }
    ?>
    <input type="submit" value="Сохранить">
</form>
</body>
</html>
