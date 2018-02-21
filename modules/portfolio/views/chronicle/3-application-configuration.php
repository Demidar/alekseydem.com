<?php
use yii\helpers\Html;
$this->title = 'Загрузка и конфигурация приложения';
$this->params['breadcrumbs'][] = ['label' => 'Дневник портфолио', 'url' => ['chronicle/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Первые шаги в для разработки сайта - загрузка локального веб-сервера и
    установка менеджера зависимостей <?= Html::a('Composer', 'https://getcomposer.org/', ['target' => '_label']) ?>. В качестве локального веб-сервера 
    использую <?= Html::a('XAMPP', 'https://www.apachefriends.org/ru/index.html', ['target' => '_label']) ?>. 
    Моя среда разработки - <?= Html::a('NetBeans', 'https://netbeans.org/', ['target' => '_label']) ?>, 
    браузер - <?= Html::a('Google Chrome', 'https://www.google.ru/chrome/browser/desktop/index.html', ['target' => '_label']) ?>.</p>
<p>Следуя инструкции по загрузке на сайте <?= Html::a('yiiframework.com', 'http://www.yiiframework.com/download/', ['target' => '_label']) ?>,
    Устанавливаю базовый шаблон приложения yii2-app-basic.</p>
<p>Настраиваю соединение с базой данных в файле <code>/config/db.php</code>, 
    предварительно создав базу данных и пользователя в СУБД MySQL</p>
<p>Измения язык приложения в <code>/config/web.php</code> на <code>ru-RU</code></p>
<p>Настрайваю компонент приложения <code>urlManager</code> для активации 
    формата ЧПУ ссылок, затем конфигурирую Apache на роутинг запроса.</p>
