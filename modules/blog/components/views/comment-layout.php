<?php
use yii\helpers\Html;
?>
<div class="media">
    <div class="media-left">
        <a href="#">
            <div style="width: 100px; height: 100px; border: 1px solid black"></div>
        </a>
    </div>
    <div class="media-body">
        <p><?= $comment->createdBy->username ?>
            <?= $comment->created_by != $comment->updated_by ? ', (изменен ' . $comment->updatedBy->username . ')' : null ?>
        </p>
        <p><?= nl2br($comment->text) ?></p>
        <p><?= date('d.n.Y, G:i', $comment->created_at) ?>
            <?= $comment->created_at != $comment->updated_at ? ', (изменен ' . date('d.n.Y, G:i', $comment->updated_at) . ')' : null ?>
        </p>
        <p>
        <?php if ($canBeEdited): ?>
            <?php if (Yii::$app->user->can('blog@updateCommentPermission', ['comment' => $comment])): ?>
                <?= Html::a('Редактировать комментарий', ['/blog/article/comment-update', 'id' => $comment->id]) ?>, 
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($canBeDeleted): ?>
            <?php if (Yii::$app->user->can('blog@deleteCommentPermission', ['comment' => $comment])): ?>
                <?= Html::a('Удалить комментарий', ['/blog/article/comment-delete', 'id' => $comment->id]) ?>
            <?php endif; ?>
        <?php endif; ?>
        </p>
    </div>
</div>