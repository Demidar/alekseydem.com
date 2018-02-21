<?php

return [
    'blog' => [
        'label' => '<span class="fa fa-newspaper-o"></span> Блог',
        'description' => 'Сайт с возможностью ведения блога',
        'url' => ['/blog/default/index'],
        'documentation' => ['/blog/documentation/index'],
        'documentationNavigation' => [
            ['label' => '<b>О проекте "Блог"</b>', 'url' => ['/blog/documentation/index']],
            //['label' => '1. Планирование таблиц', 'url' => ['/blog/documentation/create-tables']],
            //['label' => '2. Внешний вид сайта', 'url' => ['/blog/documentation/view-site']],
            //['label' => '3. Комментарий к постам', 'url' => ['/blog/documentation/comments']]
        ],
        'navigation' => [
            ['label' => 'Главная', 'url' => ['/blog/default/index']],
            ['label' => 'Посты', 'url' => ['/blog/article/index']],
        ],
        'tools' => ['Yii2 framework', 'JQuery', 'MySQL', 'PHP', 'JavaScript', 'HTML/CSS'],
    ],
    /*'checkerdb' => [
        'label' => '<span class="fa fa-check-circle-o"></span> Тесты',
        'description' => 'Регистрируйте свои тесты и проходите другие',
        'url' => ['/checkerdb/default/index'],
        'documentation' => ['/checkerdb/documentation/index'],
        'documentationNavigation' => [
            ['label' => '<b>О проекте "Тесты"</b>', 'url' => ['/checkerdb/documentation/index']],
        ],
        'tools' => ['Yii2 framework', 'JQuery', 'MongoDB', 'MySQL', 'PHP', 'JavaScript', 'HTML/CSS'],
    ],*/
    'checker' => [
        'label' => '<span class="fa fa-check-circle-o"></span> Тесты (клиентская версия)',
        'description' => 'Клиентское приложение для прохождения тестов',
        'url' => ['/checker/default/index'],
        'documentation' => ['/checker/documentation/index'],
        'documentationNavigation' => [
            ['label' => '<b>О проекте "Тесты (клиентская версия)"</b>', 'url' => ['/checker/documentation/index']],
            ['label' => 'Структура приложения', 'url' => ['/checker/documentation/structure-app']]
        ],
        'tools' => ['JQuery', 'JavaScript', 'HTML/CSS'],
    ],
    'capability' => [
        'label' => '<span class="fa fa-wrench"></span> Разработки',
        'description' => 'Здесь размещены различные копоненты из своих проектов',
        'url' => ['/portfolio/capability/index'],
        'navigation' => [
            ['label' => 'Разработки', 'url' => '#nav-begin', ['class' => ['not-link']], 'id' => 'nav-begin'],
            ['label' => '1. Регистрация и авторизация', 'url' => ['capability/registration']],
        ],
        'tools' => ['Yii2 framework', 'HTML/CSS'],
    ],
    'chronicle' => [
        'label' => '<span class="fa fa-pencil"></span> Дневник портфолио',
        'description' => 'Ведение разработки портфолио в хронологическом порядке',
        'url' => ['/portfolio/chronicle/index'],
        'navigation' => [
            ['label' => '<b>1. Дневник портфолио</b>', 'url' => ['chronicle/index']],
            ['label' => '1.1. Планирование', 'url' => ['chronicle/planning']],
            ['label' => '1.2. Загрузка и конфигурация приложения', 'url' => ['chronicle/application-configuration']],
            ['label' => '<b>2. Фундамент сайта</b>', 'url' => ['chronicle/create-foundation']],
            ['label' => '2.1. Создание шаблона и вида', 'url' => ['chronicle/create-template-and-view']],
            ['label' => '2.2. Модуль portfolio', 'url' => ['chronicle/module-portfolio']],
            ['label' => '2.3. Модуль blog', 'url' => ['chronicle/module-blog']],
            ['label' => '<b>3. Авторизация и регистрация</b>', 'url' => ['chronicle/auth-and-reg']],
            ['label' => '<b>4. Проект "Блог"</b>', 'url' => ['chronicle/project-blog']],
            ['label' => '4.1. Планирование таблиц', 'url' => ['chronicle/blog-create-tables']],
            ['label' => '4.2. Внешний вид сайта', 'url' => ['chronicle/blog-view-site']],
            ['label' => '4.3. Комментарий к постам', 'url' => ['chronicle/blog-comments']],
            
            ['label' => '<b>5. Проект "тесты (клиентская версия)"</b>', 'url' => ['chronicle/project-checker']],
            
            ['label' => '<b>6. Проект "тесты"</b>', 'url' => ['chronicle/project-checkerdb']],
            ['label' => '6.1. Подготовка MongoDB', 'url' => ['chronicle/checkerdb-preparing-mongodb']]
        ],
        'tools' => ['Yii2 framework', 'HTML/CSS'],
    ],
];