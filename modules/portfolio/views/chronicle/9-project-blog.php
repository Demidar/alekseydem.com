<?php
$this->title = 'Проект blog';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
?>
<p>Начинаю работу с проектом "блог"</p>
<p>Детальное описание разработки находится в <?= Html::a('Документации проекта', ['/blog/documentation/index']) ?>.</p>