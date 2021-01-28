function addQuestion(container) {
    i += 1;
    let question = document.createElement('div')
    question.innerHTML =
        '<br><div id="question' + i + '">' +
        '   <h3>Вопрос №' + i + ':</h3>' +

        '   <label for="question_type' + i + '">Тип вопроса: </label>\n' +
        '   <select onchange="changeType(i)" name="question_type' + i + '" id="question_type' + i + '">' +
        '       <option value="1">с открытым ответом (число)</option>' +
        '       <option value="2">с открытым ответом (положительное число)</option>' +
        '       <option value="3">с открытым ответом (строка)</option>' +
        '       <option value="4">с открытым ответом (текст)</option>' +
        '       <option value="5">с единственным выбором</option>' +
        '       <option value="6">с множественным выбором</option>' +
        '   </select>' +

        '   <br><label for="question_text' + i + '">Текст вопроса: </label>\n' +
        '   <textarea name="question_text' + i + '" id="question_text' + i + '"></textarea>' +

        '   <br><button id="add_option' + i + '" style="display: none">Добавить вариант ответа</button>' +

        '   <div id="option' + i + '_1" style="display: none">' +
        '       <br><label for="option_text' + i + '_1">Вариант ответа №1: </label>\n' +
        '       <textarea name="option_text' + i + '_1" id="option_text' + i + '_1"></textarea>' +
        '       <br><label for="option_mark' + i + '_1">Баллы: </label>\n' +
        '       <input type="number" min="-100" max="100" name="option_mark' + i + '_1" id="option_mark' + i + '_1">' +
        '   </div>' +

        '   <div id="option' + i + '_2" style="display: none">' +
        '       <br><label for="option_text' + i + '_2">Вариант ответа №2: </label>\n' +
        '       <textarea name="option_text' + i + '_2" id="option_text' + i + '_2"></textarea>' +
        '       <br><label for="option_mark' + i + '_2">Баллы: </label>\n' +
        '       <input type="number" min="-100" max="100" name="option_mark' + i + '_2" id="option_mark' + i + '_2">' +
        '   </div>' +

        '   <div id="option' + i + '_3" style="display: none">' +
        '       <br><label for="option_text' + i + '_3">Вариант ответа №1: </label>\n' +
        '       <textarea name="option_text' + i + '_3" id="option_text' + i + '_3"></textarea>' +
        '       <br><label for="option_mark' + i + '_3">Баллы: </label>\n' +
        '       <input type="number" min="-100" max="100" name="option_mark' + i + '_3" id="option_mark' + i + '_3">' +
        '   </div>' +
        '</div>';
    document.getElementById(container).appendChild(question)
    // document.getElementById(container).innerHTML +=
    // '<br><div id="question' + i + '">' +
    // '   <h3>Вопрос №' + i + ':</h3>' +
    //
    // '   <label for="question_type' + i + '">Тип вопроса: </label>\n' +
    // '   <select onchange="changeType(i)" name="question_type' + i + '" id="question_type' + i + '">' +
    // '       <option value="1">с открытым ответом (число)</option>' +
    // '       <option value="2">с открытым ответом (положительное число)</option>' +
    // '       <option value="3">с открытым ответом (строка)</option>' +
    // '       <option value="4">с открытым ответом (текст)</option>' +
    // '       <option value="5">с единственным выбором</option>' +
    // '       <option value="6">с множественным выбором</option>' +
    // '   </select>' +
    //
    // '   <br><label for="question_text' + i + '">Текст вопроса: </label>\n' +
    // '   <textarea name="question_text' + i + '" id="question_text' + i + '"></textarea>' +
    //
    // '   <br><button id="add_option' + i + '" style="display: none">Добавить вариант ответа</button>' +
    //
    // '   <div id="option' + i + '_1" style="display: none">' +
    // '       <br><label for="option_text' + i + '_1">Вариант ответа №1: </label>\n' +
    // '       <textarea name="option_text' + i + '_1" id="option_text' + i + '_1"></textarea>' +
    // '       <br><label for="option_mark' + i + '_1">Баллы: </label>\n' +
    // '       <input type="number" min="-100" max="100" name="option_mark' + i + '_1" id="option_mark' + i + '_1">' +
    // '   </div>' +
    //
    // '   <div id="option' + i + '_2" style="display: none">' +
    // '       <br><label for="option_text' + i + '_2">Вариант ответа №2: </label>\n' +
    // '       <textarea name="option_text' + i + '_2" id="option_text' + i + '_2"></textarea>' +
    // '       <br><label for="option_mark' + i + '_2">Баллы: </label>\n' +
    // '       <input type="number" min="-100" max="100" name="option_mark' + i + '_2" id="option_mark' + i + '_2">' +
    // '   </div>' +
    //
    // '   <div id="option' + i + '_3" style="display: none">' +
    // '       <br><label for="option_text' + i + '_3">Вариант ответа №1: </label>\n' +
    // '       <textarea name="option_text' + i + '_3" id="option_text' + i + '_3"></textarea>' +
    // '       <br><label for="option_mark' + i + '_3">Баллы: </label>\n' +
    // '       <input type="number" min="-100" max="100" name="option_mark' + i + '_3" id="option_mark' + i + '_3">' +
    // '   </div>' +
    // '</div>';
}

function changeType(id) {
    let type = document.getElementById('question_type' + id).value;
    console.log(type)
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
            document.getElementById('option' + id + '_3').style.display = 'block';
            break;
        default:
            break;
    }
}

let i = 0;
