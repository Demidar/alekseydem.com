<?php

$this->title = 'Планирование таблиц';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>Для создании таблиц в своем проекте я использую миграции из Yii2.</p>
<p>Создание таблицы, индексов и внешних ключей для статей:</p>
<pre class="plain-code">
<?= htmlspecialchars(file_get_contents( Yii::getAlias('@app/migrations/m170820_143037_create_articles_table.php') )) ; ?>
</pre>
<img src="/img/chronicle/blog/p1-1.jpg">
<hr>

<p>Создание таблицы комментариев к статьям:</p>
<pre class="plain-code">
<?= htmlspecialchars(file_get_contents( Yii::getAlias('@app/migrations/m170820_152520_create_articles_comments_table.php') )) ; ?>
</pre>
<img src="/img/chronicle/blog/p1-2.jpg">
<hr>

<p>Сгенерировать данные для таблиц, используя API различных веб-сервисов:</p>
<img src="/img/chronicle/blog/p1-3.jpg">
<hr>

<p>Позже я произвел изменения в таблице комментариев, удалив столбец `id_user`,
    т.к. его содержание было идентично столбцу `created_by`:</p>
<pre class="plain-code">
<?= htmlspecialchars(file_get_contents( Yii::getAlias('@app/migrations/m170902_120113_alter_indexes_and_fk_in_articles_comments_table.php') )) ; ?>
</pre>