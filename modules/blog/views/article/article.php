<?php
/* @var $this yii\web\View */
/* @var $article blog\models\Articles */
/* @var $comments blog\models\ArticlesComments */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use blog\components\ArticleWidget;
use blog\components\CommentWidget;

$this->title = $article->name;
?>

<?= ArticleWidget::widget([
    'article' => $article,
    'hasLink' => false,
]) ?>
<?php if (empty($comments)): ?>

    <p>Комментариев нет.</p>
    
<?php else: ?>
    
<?php foreach ($comments as $comment): ?>
    <?= CommentWidget::widget([
        'comment' => $comment,
    ]) ?>
<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $commentsPagination,
]) ?>
    
<?php endif; ?>

<?php if (!Yii::$app->user->isGuest): ?>

    <?php $form = ActiveForm::begin(['id' => 'leave-comment-form', 'action' => ['/blog/article/article']]); ?>
    
    <?= $form->field($leaveCommentForm, 'text')->textarea() ?>
    <?= $form->field($leaveCommentForm, 'articleid')->hiddenInput(['value' => $article->id])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Оставить комментарий', ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
    </div>
    
    <?php ActiveForm::end() ?>
    
<?php endif; ?>