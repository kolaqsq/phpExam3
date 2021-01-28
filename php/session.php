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
$query = $database->prepare("select * from questions where session_id = ?");
$query->execute([$_GET['session_id']]);
$questions = $query->rowCount();
?>
<form action="" id="questions">
    <button type="button" onclick="addQuestion('questions', <?php echo $questions + 1 ?>)">Добавиь вопрос</button>
    <?php
    while ($row = $query->fetch()) {
        echo
            '<br><div id="question' . $row['id'] . '">' .
            '   <h3>Вопрос №' . $row['number_in_session'] . ':</h3>' .
            '   <button type="button" onclick="deleteQuestion(this.id.substring(15))" id="delete_question' . $row['id'] . '">Удалить вопрос</button>' .

            '   <br><label for="question_type' . $row['id'] . '">Тип вопроса: </label>' .
            '   <select onchange="changeType(this.id.substring(13))" name="question_type' . $row['id'] . '" id="question_type' . $row['id'] . '">' .
            '       <option' . ($row['type'] == 1 ? 'checked' : '') . ' value="1">с открытым ответом (число)</option>' .
            '       <option' . ($row['type'] == 2 ? 'checked' : '') . ' value="2">с открытым ответом (положительное число)</option>' .
            '       <option' . ($row['type'] == 3 ? 'checked' : '') . ' value="3">с открытым ответом (строка)</option>' .
            '       <option' . ($row['type'] == 4 ? 'checked' : '') . ' value="4">с открытым ответом (текст)</option>' .
            '       <option' . ($row['type'] == 5 ? 'checked' : '') . ' value="5">с единственным выбором</option>' .
            '       <option' . ($row['type'] == 6 ? 'checked' : '') . ' value="6">с множественным выбором</option>' .
            '   </select>' .

            '   <br><label for="question_text' . $row['id'] . '">Текст вопроса: </label>' .
            '   <textarea name="question_text' . $row['id'] . '" id="question_text' . $row['id'] . '"></textarea>' .
            '</div>';
    }
    ?>
</form>
</body>
</html>

<!--'   <br><button type="button" onclick="addOption(this.id.substring(10))" id="add_option' . i . '" style="display: none">Добавить вариант ответа</button>' .-->
<!---->
<!--'   <div id="option' . i . '_1" style="display: none">' .-->
<!--    '       <br><label for="option_text' . i . '_1">Вариант ответа №1: </label>\n' .-->
<!--    '       <textarea name="option_text' . i . '_1" id="option_text' . i . '_1"></textarea>' .-->
<!--    '       <br><label for="option_mark' . i . '_1">Баллы: </label>\n' .-->
<!--    '       <input type="number" min="-100" max="100" name="option_mark' . i . '_1" id="option_mark' . i . '_1">' .-->
<!--    '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' . i . '_1">Удалить</button>' .-->
<!--    '   </div>' .-->
<!---->
<!--'   <div id="option' . i . '_2" style="display: none">' .-->
<!--    '       <br><label for="option_text' . i . '_2">Вариант ответа №2: </label>\n' .-->
<!--    '       <textarea name="option_text' . i . '_2" id="option_text' . i . '_2"></textarea>' .-->
<!--    '       <br><label for="option_mark' . i . '_2">Баллы: </label>\n' .-->
<!--    '       <input type="number" min="-100" max="100" name="option_mark' . i . '_2" id="option_mark' . i . '_2">' .-->
<!--    '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' . i . '_2">Удалить</button>' .-->
<!--    '   </div>' .-->
<!--'</div>';-->