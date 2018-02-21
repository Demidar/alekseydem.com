<?php
$this->title = 'Создание шаблона и вида';
$this->params['breadcrumbs'][] = ['label' => 'Фундамент сайта', 'url' => ['chronicle/create-foundation']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Создаю шаблон <code>/views/layouts/main.php</code>, в котором будут размещены
    основные стартовые теги HTML, шапка сайта с двумя кнопками - резюме и 
    портфолио. Контент страницы будет размещаться ниже в <code>.container</code>
    bootstrap. В самом низу сайта размещен <code>footer</code>. К шаблону
    составлен файл стилей <code>main.css</code>, подключаемый с помощью 
    <code>/assets/AppAsset.php</code> вместе с файлами bootstrap и JQuery.</p>
<p>Создаю вид <code>/views/site/index.php</code>, в который занесу основную 
    информацию о себе.</p>