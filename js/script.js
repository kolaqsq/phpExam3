function addQuestion(container, index) {
    j = 2;
    let question = document.createElement('div')
    question.innerHTML =
        '<br><div id="question' + index + '">' +
        '   <h3>Вопрос №' + index + ':</h3>' +
        '   <button type="button" onclick="deleteQuestion(this.id.substring(15))" id="delete_question' + index + '">Удалить вопрос</button>' +

        '   <br><label for="question_type' + index + '">Тип вопроса: </label>' +
        '   <select onchange="changeType(this.id.substring(13))" name="question_type' + index + '" id="question_type' + index + '">' +
        '       <option value="1">с открытым ответом (число)</option>' +
        '       <option value="2">с открытым ответом (положительное число)</option>' +
        '       <option value="3">с открытым ответом (строка)</option>' +
        '       <option value="4">с открытым ответом (текст)</option>' +
        '       <option value="5">с единственным выбором</option>' +
        '       <option value="6">с множественным выбором</option>' +
        '   </select>' +

        '   <br><label for="question_text' + index + '">Текст вопроса: </label>' +
        '   <textarea name="question_text' + index + '" id="question_text' + index + '"></textarea>' +

        '   <br><button type="button" onclick="addOption(this.id.substring(10))" id="add_option' + index + '" style="display: none">Добавить вариант ответа</button>' +

        '   <div id="option' + index + '_1" style="display: none">' +
        '       <br><label for="option_text' + index + '_1">Вариант ответа №1: </label>' +
        '       <textarea name="option_text' + index + '_1" id="option_text' + index + '_1"></textarea>' +
        '       <br><label for="option_mark' + index + '_1">Баллы: </label>' +
        '       <input type="number" min="-100" max="100" name="option_mark' + index + '_1" id="option_mark' + index + '_1">' +
        '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' + index + '_1">Удалить</button>' +
        '   </div>' +

        '   <div id="option' + index + '_2" style="display: none">' +
        '       <br><label for="option_text' + index + '_2">Вариант ответа №2: </label>' +
        '       <textarea name="option_text' + index + '_2" id="option_text' + index + '_2"></textarea>' +
        '       <br><label for="option_mark' + index + '_2">Баллы: </label>' +
        '       <input type="number" min="-100" max="100" name="option_mark' + index + '_2" id="option_mark' + index + '_2">' +
        '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' + index + '_2">Удалить</button>' +
        '   </div>' +
        '</div>';
    document.getElementById(container).appendChild(question)
}

function changeType(id) {
    let type = document.getElementById('question_type' + id).value;
    switch (type) {
        case '5':
            document.getElementById('add_option' + id).style.display = 'block';
            document.getElementById('option' + id + '_1').style.display = 'block';
            document.getElementById('option' + id + '_2').style.display = 'block';
            break;
        case '6':
            document.getElementById('add_option' + id).style.display = 'block';
            document.getElementById('option' + id + '_1').style.display = 'block';
            document.getElementById('option' + id + '_2').style.display = 'block';
            if (j < 3) addOption(id);
            break;
        default:
            break;
    }
}

function addOption(id) {
    j += 1;
    let option = document.createElement('div')
    option.innerHTML =
        '   <div id="option' + id + '_' + j + '">' +
        '       <br><label for="option_text' + id + '_' + j + '">Вариант ответа №' + j + ': </label>' +
        '       <textarea name="option_text' + id + '_' + j + '" id="option_text' + id + '_' + j + '"></textarea>' +
        '       <br><label for="option_mark' + id + '_' + j + '">Баллы: </label>' +
        '       <input type="number" min="-100" max="100" name="option_mark' + id + '_' + j + '" id="option_mark' + id + '_' + j + '">' +
        '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' + id + '_' + j + '">Удалить</button>' +
        '   </div>';
    document.getElementById('question' + id).appendChild(option)

}

function deleteOption(id) {
    document.getElementById('option' + id).remove();
}

function deleteQuestion(id) {
    document.getElementById('question' + id).remove();
}

// let index = 0;
let j = 2;
