<?php
/* @var $comments blog\models\ArticlesComments */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Мои комментарии';
?>

<h2>Мои комментарии:</h2>
<?php foreach ($comments as $comment): ?>

<a href="<?= Url::to(['/blog/article/article', 'id' => $comment->idArticle->id]) ?>" class="not-link">
    <div class="border-blog-2">
        <h3>Пост: <?= $comment->idArticle->name ?></h3>
        <p> Комментарий: <br>
            <?= nl2br($comment->text) ?>
        </p>
        <p class="text-description">
            Создано: <?= date('d.n.Y, G:i', $comment->created_at) ?>
            <?php if ($comment->created_at != $comment->updated_at): ?>
                Изменено: <?= date('d.n.Y, G:i', $comment->updated_at) ?>
            <?php endif; ?>
            <br>Создал: <?= $comment->createdBy->username ?>
            <?php if ($comment->created_by != $comment->updated_by): ?>
                Изменил: <?= $comment->updatedBy->username ?>
            <?php endif; ?>
        </p>
    </div>
</a>
<?php if (Yii::$app->user->identity->id == $comment->created_by): ?>
    <?= Html::a('Редактировать', ['/blog/article/comment-update', 'id' => $comment->id]) ?>, 
    <?= Html::a('Удалить', ['/blog/article/comment-delete', 'id' => $comment->id]) ?>
<hr>
<?php endif; ?>
<?php endforeach; ?>
