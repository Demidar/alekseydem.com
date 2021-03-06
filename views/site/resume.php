<?php
use yii\helpers\Html;
use yii\helpers\Url;
app\assets\AppAsset::register($this);
$this->title = 'Ветлугин Алексей';
?>
<div class="site-resume">
    <div class="jumbotron">
        <div class="container">
            <p>Резюме веб-разработчика: Ветлугин Алексей Сергеевич</p>
        </div>
    </div>
    <div class="container">
        <?= Html::a(Html::tag('span', '', ['class' => ['glyphicon', 'glyphicon-chevron-left']]) . ' На главную страницу', 
                            Url::toRoute('/site/index'), 
                ['class' => ['btn', 'btn-primary', 'btn-return']]) ?><hr>
        <p><b>Ф.И.О. :</b> Ветлугин Алексей Сергеевич.</p>
        <p><b>Возраст:</b> 22 года (19.02.1996г).</p>
        <p><b>Проживаю</b> в г. Екатеринбург, Орджоникидзевский район.</p>
        <p><b>Мои контактные данные:</b></p>
        <ul>
            <!--<li>Телефон: +7(923)171-26-36</li>-->
            <li>Электронная почта: aleksey.dem6@gmail.com</li>
        </ul>
        <p><b>Цель:</b> претендую на место Junior (Джуниор) PHP разработчика на полный рабочий день.</p>
        <p><b>Знание языков программирования:</b> PHP7, HTML5, CSS3 с Bootstrap3, JavaScript с JQuery, язык запросов SQL с MySQL, система контроля версии Git.</p>
        <p><b>Общие навыки:</b> хорошо разбираюсь в ООП, фреимворке Yii2, достаточно хорошо владею английским языком на уровне чтения технической документации и восприятия на слух. Быстро осваиваю новые технологии, методы и приемы для дальнейшего их использования в различных проектах.</p>
        <p><b>Образование:</b> в настоящее время обучаюсь на последнем 5 курсе среднего профессионального образования по специальности "Программирование в компьютерных системах" в Новосибирском Государственном Техническом Университете.</p>
        <p><b>Личные и деловые качества:</b> увлеченно занимаюсь программированием как веб-разработчик полного профиля (Full stack web-developer) и с интересом изучаю область "Data Science". Нравится проектировать сайты, возлагая на себя все задачи его реализации и доведения до желаемого результата. При работе в команде готов принимать участие в обсуждении развития проекта.</p>
        <p><b>Опыт работы:</b> производственная практика в процессе обучения, имеется отзыв.</p>
        <p><b>Претендуемая месячная зарплата:</b> от 30 000 руб после испытательного срока или иных проверочных задании.</p>
        <p><b>Ссылки на собственные разработки:</b></p>
        <ul>
            <li><a href="<?= Url::to(['/portfolio/default/projects']) ?>" target="_blank">Лист различных разработок</a></li>
            <li><a href="<?= Url::to(['/blog/default/index']) ?>" target="_blank">Проект "Блог"</a></li>
            <li><a href="<?= Url::to(['/checker/default/index']) ?>" target="_blank">Проект "тесты" (написан на JavaScript)</a></li>
            <li><a href="<?= Url::to(['/portfolio/chronicle/index']) ?>" target="_blank">Подробное ведение процесса разработки проектов</a></li>
        </ul>
    </div>
</div>
