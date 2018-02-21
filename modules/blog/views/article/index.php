<?php
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
use blog\components\ArticleWidget;

$this->title = 'Статьи';
?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
<?= Alert::widget([
    'options' => ['class' => 'alert-warning'],
    'body' => Yii::$app->session->getFlash('error'),
]) ?>
<?php endif; ?>
<?php foreach ($articles as $article): ?>
<?= ArticleWidget::widget([
    'article' => $article,
    'stringLength' => 500,
    'canBeEdited' => false,
    'canBeDeleted' => false,
]); ?>
<?php endforeach; ?>
<?= LinkPager::widget([
    'pagination' => $pagination,
])
?>