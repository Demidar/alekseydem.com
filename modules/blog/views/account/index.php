<?php
/* @var $articles blog\models\Articles */
/* @var $comments blog\model\CommentsArticles */

use yii\helpers\Url;
use blog\components\ArticleWidget;
?>

<div class="col-lg-6">
    <h3>Мои последние посты:</h3>
    <?php foreach ($articles as $article): ?>
        <?= ArticleWidget::widget([
            'article' => $article,
            'stringLength' => 300,
            'canBeEdited' => false,
            'canBeDeleted' => false,
        ]) ?>
    <?php endforeach; ?>
</div>
<div class="col-lg-6">
    <h3>Мои последние комментарии:</h3>
    <?php foreach ($comments as $comment): ?>
        <a href="<?= Url::to(['/blog/article/article?id=' . $comment->idArticle->id]) ?>" class="not-link">
            <div class="border-blog-2">
                <h4>Пост: <?= $comment->idArticle->name ?></h4>
                <p> Комментарий: </p>
                <p>
                <?= nl2br($comment->text) ?>
                </p>
                <p class="text-description">
                    Создано: <?= date('d.n.Y, G:i', $comment->created_at) ?>
                <?php if ($comment->created_at != $comment->updated_at): ?>
                    Изменено: <?= date('d.n.Y, G:i', $comment->updated_at) ?>
                <?php endif; ?>
                Создал: <?= $comment->createdBy->username ?>
                <?php if ($comment->created_by != $comment->updated_by): ?>
                    Изменил: <?= $comment->updatedBy->username ?>
                <?php endif; ?>
                </p>
            </div>
        </a>
    <?php endforeach; ?>
</div>