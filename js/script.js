function addQuestion(container) {
    i += 1;
    document.getElementById(container).innerHTML +=
        '<br><div>' +
        '   <label for="element' + i + '">Вопрос №' + i + ':</label>\n' +
        '   <select name="element' + i + '" id="element' + i + '">' +
        '       ' +
        '   </select>' +
        '</div>' +
        '<label for="element' + i + '">Элемент №' + i + ':</label>\n' +
        '<input type="text" name="element' + i + '" id="element' + i + '">';
}

let i = 0;

// function addOneElement(container, counter) {
//     i += 1;
//     document.getElementById(counter).setAttribute('value', i + 1);
//     document.getElementById(container).innerHTML += '<label for="element' + i + '">Элемент №' + i + ':</label>\n' +
//         '<input type="text" name="element' + i + '" id="element' + i + '">';
// }