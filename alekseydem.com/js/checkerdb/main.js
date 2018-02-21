// Отправить AJAX и с ответом отобразить окно теста
function showTask(numSection, numTask, numQuestion) {
    $.get('/checkerdb/ajax/show-task', {section_id: numSection, task: numTask}, function (data) {
        var dataJson = $.parseJSON(data);
        renderTaskTest(dataJson, numSection, numTask, numQuestion);
    });
}

// отправить AJAX и с ответом отобразить следующий шаг теста
function checkButton(numSection, numTask, numQuestion, numVariety) {
    $.get('/checkerdb/ajax/check-variety', {section_id: numSection, task: numTask, question: numQuestion, variety: numVariety}, function(data) {
        var dataJson = $.parseJSON(data);
    });
}

// Сбор данных о нажатых кнопках, отправить по AJAX для проверки, 
function checkGroupButton() {
    
}

// показать окно с тестом
function renderTaskTest(dataJson, numSection, numTask, numQuestion) {
    $('.modal-task').remove();
    var insertQuestion = dataJson.question;
    var insertAnswers = '';
    if (dataJson.options.oneAnswer === true) {
        for (var i=0; i < dataJson.answers.length; i++) {
            insertAnswers += '<button class="btn btn-default btn-lg answer-modal" id="answerModal'+i+'" onclick="checkButton('+numSection+', '+numTask+', '+numQuestion+', '+i+')"><b>'+ dataJson.answers[i] +'</b></button>';
        }
    } else {
        insertAnswers += '<h3 style="text-align: center">Выберите несколько вариантов ответа</h3>';
        for (var i=0; i < dataJson.answers.length; i++) {
            insertAnswers += '<button type="button" class="btn btn-default btn-lg answers-modal" data-toggle="button" aria-pressed="false" id="answerModal'+i+'">'+dataJson.answers[i]+'</button>';
        }
        insertAnswers += '<br><button class="btn btn-primary" id="checkingButton" onclick="checkGroupButtons()">Проверить</button>';
    }
    
    var mt =
    '<div class="modal-task">'+
        '<div class="modal-window">'+
            '<button class="btn btn-danger destroy" onclick="destroyModal()">'+
                'Выйти'+
            '</button>'+
            '<br>'+
            insertQuestion+
            '<div>'+
                insertAnswers+
            '</div>'+
        '</div>'+
    '</div>';

    $('body').append(mt);
}