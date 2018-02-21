<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if ($hasLink): ?>
<a href="<?= Url::to(['/blog/article/article', 'id' => $article->id]) ?>" class="not-link">
<?php endif; ?>
    <div class="border-blog-2">
        <h3><?= $article->name ?></h3>
        <p><?= $article->text ?></p>
        <p class="text-description">
            <?php if ($description): ?>
                Создано: <?= date('d.n.Y, G:i', $article->created_at) ?>
                <?php if ($article->created_at != $article->updated_at): ?>
                Изменено: <?= date('d.n.Y, G:i', $article->updated_at) ?>
                <?php endif; ?>
                <br>
                Создал: <?= $article->createdBy->username ?>
                <?php if ($article->created_by != $article->updated_by): ?>
                    Изменил: <?= $article->updatedBy->username ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($canBeEdited): ?>
                <?php if (Yii::$app->user->can('blog@updatePostPermission', ['article' => $article])): ?>
                    <?= Html::a('Редактировать пост', ['/blog/article/update', 'id' => $article->id], ['style' => 'margin-left: 30px;']) ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($canBeDeleted): ?>
                <?php if (Yii::$app->user->can('blog@deletePostPermission', ['article' => $article])): ?>
                    <?= Html::a('Удалить пост', ['/blog/article/delete', 'id' => $article->id], ['style' => 'margin-left: 30px;']) ?>
                <?php endif; ?>
            <?php endif; ?>
        </p>
    </div>
<?php if ($hasLink): ?>
</a>
<?php endif; ?>