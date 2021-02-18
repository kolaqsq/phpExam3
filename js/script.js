function addQuestion(container, index) {
    let question = document.createElement('div')
    question.innerHTML =
        '<div class="question" id="question' + index + '">' +
        '   <h3>Вопрос №' + index + ':</h3>' +
        '   <button type="button" onclick="deleteQuestion(this.id.substring(15))" id="delete_question' + index + '">Удалить вопрос</button>' +
        '   <input name="question_' + index + '[]" type="text" value="' + 0 + '" style="display: none">' +

        '   <br><label for="question_type' + index + '">Тип вопроса: </label>' +
        '   <select name="question_' + index + '[]" id="question_type' + index + '">' +
        '       <option value="1">с открытым ответом (число)</option>' +
        '       <option value="2">с открытым ответом (положительное число)</option>' +
        '       <option value="3">с открытым ответом (строка)</option>' +
        '       <option value="4">с открытым ответом (текст)</option>' +
        '   </select>' +

        '   <br><label for="question_text' + index + '">Текст вопроса: </label>' +
        '   <textarea name="question_' + index + '[]" id="question_text' + index + '"></textarea>' +
        '</div>';
    document.getElementById(container).appendChild(question)
}

function deleteQuestion(id) {
    document.getElementById('question' + id).remove();
}

// function changeType(id) {
//     let type = document.getElementById('question_type' + id).value;
//     switch (type) {
//         case '5':
//             document.getElementById('add_option' + id).style.display = 'block';
//             document.getElementById('option' + id + '_1').style.display = 'block';
//             document.getElementById('option' + id + '_2').style.display = 'block';
//             break;
//         case '6':
//             document.getElementById('add_option' + id).style.display = 'block';
//             document.getElementById('option' + id + '_1').style.display = 'block';
//             document.getElementById('option' + id + '_2').style.display = 'block';
//             if (j < 3) addOption(id);
//             break;
//         default:
//             break;
//     }
// }

// function addOption(id) {
//     j += 1;
//     let option = document.createElement('div')
//     option.innerHTML =
//         '   <div id="option' + id + '_' + j + '">' +
//         '       <br><label for="option_text' + id + '_' + j + '">Вариант ответа №' + j + ': </label>' +
//         '       <textarea name="option_text' + id + '_' + j + '" id="option_text' + id + '_' + j + '"></textarea>' +
//         '       <br><label for="option_mark' + id + '_' + j + '">Баллы: </label>' +
//         '       <input type="number" min="-100" max="100" name="option_mark' + id + '_' + j + '" id="option_mark' + id + '_' + j + '">' +
//         '       <br><button type="button" onclick="deleteOption(this.id.substring(13))" id="delete_option' + id + '_' + j + '">Удалить</button>' +
//         '   </div>';
//     document.getElementById('question' + id).appendChild(option)
//
// }
//
// function deleteOption(id) {
//     document.getElementById('option' + id).remove();
// }

let i = 0

window.onload = () => {
    i = document.getElementById("questions").childElementCount;
}
