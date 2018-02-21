<?php
/* @var $this yii\web\View */
/* @var $articles app\models\Articles */
/* @var $features app\models\Articles */
use blog\components\ArticleWidget;
$this->title = 'Блог';
?>
<div class="row">
    <div class="col-lg-6">
        <p>Последние статьи:</p>
        <?php foreach ($articles as $article): ?>
        <?= ArticleWidget::widget([
            'article' => $article,
            'stringLength' => 500,
            'canBeEdited' => false,
            'canBeDeleted' => false,
        ]) ?>
        <?php endforeach; ?>
    </div>
    <div class="col-lg-6">
        <p>Последние фичи:</p>
        <?php foreach ($features as $feature): ?>
        <?= ArticleWidget::widget([
            'article' => $feature,
            'stringLength' => 500,
            'canBeEdited' => false,
            'canBeDeleted' => false,
        ]) ?>
        <?php endforeach; ?>
        <?= Yii::$app->getSecurity()->generateRandomString(32) ?>
    </div>
</div>
