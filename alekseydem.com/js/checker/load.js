$(document).ready(function() {
	// перебор всех разделов
	for(var numSection = 0; numSection < tests.sections.length; numSection++) {

		// запись текущего раздела
		var section = tests.sections[numSection];

		// формирование панели bootstrap
		$('.list').append('<div class="panel panel-default" id="section'+numSection+'"></div>');
		$('#section'+numSection).append('<div class="panel-heading"></div>');
		$('#section'+numSection).append('<div class="panel-body"></div>');

		// вставка текста в панель
		// вставка названия раздела
		$('#section'+numSection+'>.panel-heading').append(section.name);
		// вставка описания раздела
		$('#section'+numSection+'>.panel-body').append('<p>' + section.description + '</p>');

		// перебор задач раздела
		for(var numTask = 0; numTask < section.tasks.length; numTask++) {
			var question_answer = section.tasks[numTask];
			// генерация кнопки для вызова окна задачи
			answersFromCookie = localStorage.getItem('a-'+numSection+'-'+numTask);
			if (answersFromCookie !== null) {
				answersFromCookie = 'Результат: '+answersFromCookie;
			} else {
				answersFromCookie = '';
			}
			$('#section'+numSection+'>.panel-body').append('<p><button class="btn btn-default" onclick="showTask('+numSection+', '+numTask+')">Задача '+(numTask+1)+'</button> Тип задания: '+question_answer.type+'; <span id="result-'+numSection+'-'+numTask+'" class="label label-info">'+answersFromCookie+'</span></p>');
		}
	};
});

// определение типа задачи
function showTask(numSection, numTask) {
	// запись текущей секции (раздела)
	current.section = tests.sections[numSection];
	// запись текущей задачи
	current.task = current.section.tasks[numTask];
	// запись номера секции
	current.numSection = numSection;
	// запись номера задачи
	current.numTask = numTask;

	switch (current.task.type) {
		// если тип задачи - "тест"
		case 'тест':
			// если имеются ответы - очистить их
			var collectionNull = current.task.questionAnswer;
			// подсчет правильных ответов
			for (var i = 0; i < collectionNull.length; i++) {
				if (typeof collectionNull[i].correct !== "undefined") {
					collectionNull[i].correct = undefined;
				}
			}
			// начать вывод теста
			showTaskTest();
			break;
		// если тип задачи - "вставить слова"
		case 'вставить слова':
			showTaskInsertWords();
			break;
	}
}

// отобразить задачу с вставкой пропущенных слов
function showTaskInsertWords() {
	// если есть модальное окно - удалить его
	if ($('.modalTask')) {
		$('.modalTask').remove();
	}
	// записать ответы в в массив в виде нумерованных кнопок
	var words = [];
	for (var i = 0; i < current.task.words.length; i++) {
		words.push('<button class="btn btn-default word" id="task-word-'+i+'" onclick="putThisWordTo('+i+')">'+current.task.words[i]+'</button>');
	}
	// перемешать массив с ответами
	words.sort(compareRandom);
	words.unshift('<button class="btn btn-warning word" onclick="putThisWordTo(\'clear\')">Очистить</button>');
	words = words.join('', words);
	// записать текст задачи, сделать переносы строк и вставить нумерованные кнопки-окошки для пропущенных слов
	var text = current.task.text;
	text = text.replace(/\n/g, '<br>');
	current.countWordPlaces = 0;
	for (var i = 0; text.search( /\*\$\*/i ) != -1; i++) {
		text = text.replace(/\*\$\*/, '<button class="btn btn-default inner-text" id="task-put-word-'+i+'" data-num-word="" onclick="putWordHere('+i+')">&nbsp</button>');
		current.countWordPlaces++;
	}
	text += '<br><button class="btn btn-primary btn-lg" id="checkButton" onclick="checkTaskInsertWords()">Проверить</button><p id="check-info-correct" style="font-size: 2rem; color: darkgreen"></p><p id="check-info-incorrect" style="font-size: 2rem; color: darkred"></p>';
	// вызов модального окна с задачей
	$('body').append('<div class="modalTask"><div class="modal-window"><div class="plain-text"><button class="btn btn-danger destroy" onclick="destroyModal()">Выйти</button><br><h2>Вставьте пропущенные слова:</h2><p style="font-size: 2rem">'+text+'</p></div><div class="plain-words">'+words+'</div></div></div>');
}

// вставить слово
function putWordHere(numButton) {
	// стиль подсветки выделенной кнопки:
	var currentButton = {
		backgroundColor: '#ccffee',
		borderColor: '#00ffaa',
	};
	// стиль подсветки обычной кнопки
	var defaultButton = {
		backgroundColor: '#fff',
		borderColor: '#ccc',
	};
	// если второй раз нажата одна и та же кнопка
	if (numButton == current.numWordPlace) {
		// переключить панель выбора слова
		if ($('.plain-words').is(':visible')) {
			current.numWordPlace = null;
			$('.plain-words').hide();
			$('#task-put-word-'+numButton).css(defaultButton);
		} else {
			current.numWordPlace = numButton;
			$('.plain-words').show();
			$('#task-put-word-'+numButton).css(currentButton);
		}
		return;
	}
	// если это первое нажатие
	if (current.numWordPlace === null) {
		current.numWordPlace = numButton;
		// отобразить панель выбора слова
		$('.plain-words').show();
			$('#task-put-word-'+numButton).css(currentButton);
		return;
	}
	// если переключились на другую кнопку
	if (numButton !== current.numWordPlace) {
		$('#task-put-word-'+current.numWordPlace).css(defaultButton);
		current.numWordPlace = numButton;
		// отобразить панель выбора слова
		$('.plain-words').show();
		$('#task-put-word-'+numButton).css(currentButton);
		return;
	}
}

// поместить выбранное слово в окошко
function putThisWordTo(numWord) {
	// если окошко уже заполнено каким-нибудь ответом, то убрать класс .selected у такого ответа
	for (var i = 0; i < current.task.words.length; i++) {
		if ($('#task-put-word-'+current.numWordPlace).text() == current.task.words[i]) {
			if ($('#task-word-'+i).hasClass('selected')) {
				$('#task-word-'+i).removeClass('selected');
				break;
			}
		}
	}
	// если нажата кнопка очистки, очистить текущее окошко
	if (numWord === 'clear') {
		$('#task-put-word-'+current.numWordPlace).html('&nbsp');
		return;
	}
	// записать текущий (или новый) ответ в окошко, если текущий ответ не выбран
	if (!$('#task-word-'+numWord).hasClass('selected')) {
		$('#task-word-'+numWord).addClass('selected');
		$('#task-put-word-'+current.numWordPlace).text(current.task.words[numWord]);
	}
}
// проверить задачу
function checkTaskInsertWords() {
	$('.plain-words').hide();
	var correct = 0;
	var incorrect = 0;
	for (var i = 0; i < current.countWordPlaces; i++) {
		if ($('#task-put-word-'+i).text() == current.task.words[i]) {
			$('#task-put-word-'+i).css('background-color', '#99ff33');
			correct++;
		} else {
			$('#task-put-word-'+i).css('background-color', '#ff8080');
			incorrect++;
		}
	}
	$('#check-info-correct').text('Верно: '+correct);
	$('#check-info-incorrect').text('Неверно: '+incorrect);

	var count = current.countWordPlaces;
	/*var resultColor;
	if (correct == count) {
		resultColor = '#99ff33';	//lightgreen
	} else if (correct > count/2) {
		resultColor = '#ffff66';	// lightyellow
	} else {
		resultColor = '#ff8080';	// lightred
	}
	$('#result-'+current.numSection+'-'+current.numTask).css('background-color', resultColor);*/
	$('#result-'+current.numSection+'-'+current.numTask).text('Результат: '+correct+'/'+count);
	// занесение в локальное хранилище
	localStorage.setItem('a-'+current.numSection+'-'+current.numTask, correct+'/'+count);
	$('#checkButton + .destroy').remove();
	$('#checkButton').after('<button class="btn btn-danger btn-lg destroy" onclick="destroyModal()">Выйти</button>');
	$('#checkButton').remove();
}

// подготовка к генерации модального окна
function showTaskTest(numQuestion) {
	// если есть модальное окно - удалить его
	if ($('.modalTask')) {
		$('.modalTask').remove();
	}
	if (numQuestion === undefined) {
		numQuestion = 0;
	}
	// если отвечено на все вопросы, сгенерировать итоговое окно
	if (numQuestion > current.task.questionAnswer.length-1) {
		generateResultModal();
		return;
	}
	// запись текущего вопроса
	current.question = current.task.questionAnswer[numQuestion];
	// запись номера вопроса
	current.numQuestion = numQuestion;
	generateModal();
}

// сгенерировать модальное окно
function generateModal() {
	// строка вопроса
	var insertQuestion = '<h2 style="text-align: center">' + current.question.question + '</h2><br>';
	// инициализация строки ответов
	var insertAnswers = '';

	// определить, один верный ответ в тесте или несколько
	var countAnswer = 0;
	var oneAnswer = true;
	for (var i = 0; i < current.question.answers.length; i++) {
		if (current.question.answers[i][1] === true) {
			countAnswer++;
		}
		if (countAnswer == 2) {
			oneAnswer = false;
			break;
		}
	}

	// если верный ответ один, сгенерировать кнопки
	if (oneAnswer) {
		// запись вариантов ответа
		for (var i = 0; i < current.question.answers.length; i++) {
			insertAnswers += '<button class="btn btn-default btn-lg answer-modal" id="answerModal'+i+'" onclick="checkButton('+i+')"><b>'+ current.question.answers[i][0] +'</b></button>';
		}
	// если несколько, сгенерировать переключаемые кнопки
	} else {
		insertAnswers += '<h3 style="text-align: center">Выберите несколько вариантов ответа</h3>';
		// запись вариантов ответа
		for (var i = 0; i < current.question.answers.length; i++) {
			insertAnswers += '<button type="button" class="btn btn-default btn-lg answers-modal" data-toggle="button" aria-pressed="false" id="answerModal'+i+'">'+current.question.answers[i][0]+'</button>';
		}
		insertAnswers += '<br><button class="btn btn-primary" id="checkingButton" onclick="checkGroupButtons()">Проверить</button>';
	}
	$('body').append('<div class="modalTask"><div class="modal-window"><button class="btn btn-danger destroy" onclick="destroyModal()">Выйти</button><br>'+insertQuestion+'<div>'+insertAnswers+'</div></div></div>');
}

// генерация итогового модального окна
function generateResultModal() {
	var correct = 0;
	var uncorrect = 0;
	var collection = current.task.questionAnswer;
	// подсчет правильных ответов
	for (var i = 0; i < collection.length; i++) {
		if (collection[i].correct === 'wrong') {
			uncorrect++;
		} else {
			correct++;
		}
	}

	$('body').append('<div class="modalTask"><div class="modal-window"><button class="btn btn-success destroy" onclick="destroyModal()">Закончить</button><br>Вы прошли тест<p style="color: darkgreen">верно: '+correct+'</p><p style="color: brown">неверно: '+uncorrect+'</p></div></div>');
	var resultColor;
	/*if (correct == collection.length) {
		resultColor = '#99ff33';	//lightgreen
	} else if (correct > collection.length/2) {
		resultColor = '#ffff66';	// lightyellow
	} else {
		resultColor = '#ff8080';	// lightred
	}
	$('#result-'+current.numSection+'-'+current.numTask).css('background-color', resultColor);*/
	$('#result-'+current.numSection+'-'+current.numTask).text('Результат: '+correct+'/'+collection.length);
	// занесение в локальное хранилище
	localStorage.setItem('a-'+current.numSection+'-'+current.numTask, correct+'/'+collection.length);
}

function destroyModal() {
	$('.modalTask').remove();
}
// секция - раздел с задачами
// задача - задача с вопросами
// вопрос - вопрос с вариантами ответов
// вариант - вариант ответа

// проверка в случае единственного правильного ответа
function checkButton(numVariety) {
	current.variety = current.question.answers[numVariety];
	current.numVariety = numVariety;
	if (current.variety[1] === true) {
		$('#answerModal'+numVariety).removeClass('btn-default').addClass('btn-success');
		$('.modal-window .destroy').after('<button class="btn btn-primary pull-right" onclick="showTaskTest('+(current.numQuestion+1)+')">Следующий</button>');
	} else {
		$('#answerModal'+numVariety).removeClass('btn-default').addClass('btn-danger');
		current.question.correct = 'wrong';
	}
}

function checkGroupButtons() {
	// сбор всех ответов:
	// true - кнопка нажата
	// false - кнопка не нажата
	var allAnswers = Array();
	for (var i = 0; i < current.question.answers.length; i++) {
		// если кнопка нажата
		if ($('#answerModal'+i).hasClass('active')) {
			// и этот ответ верный
			if (current.question.answers[i][1] === true) {
				// покрасить в зеленый цвет.
				$('#answerModal'+i).removeClass('btn-default').addClass('btn-success');
			// а если ответ неверный
			} else {
				// покрасить в красный цвет.
				$('#answerModal'+i).removeClass('btn-default').addClass('btn-danger');
				// и засчитать ответ на вопрос ошибочным
				current.question.correct = 'wrong';
			}
		// а если кнопка не нажата
		} else {
			// а ее ответ верный
			if (current.question.answers[i][1] === true) {
				// закрасить в зеленый цвет
				$('#answerModal'+i).removeClass('btn-default').addClass('btn-success');
				// и засчитать ответ на вопрос ошибочным
				current.question.correct = 'wrong';
			} else {
				// иначе в красный цвет
				$('#answerModal'+i).removeClass('btn-default').addClass('btn-danger');
			}
		}
	}
	// кнопка перехода на следующий тест
	$('#checkingButton').after('<button class="btn btn-primary" onclick="showTaskTest('+(current.numQuestion+1)+')">Следующий</button>');
	$('#checkingButton').remove();

}

// используется для перемешивания содержимого массива
function compareRandom(a, b) {
	return Math.random() - 0.5;
}

// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}