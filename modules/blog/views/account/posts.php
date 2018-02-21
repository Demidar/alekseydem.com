<?php
/* @var $articles blog\models\Articles */

use yii\helpers\Url;

$this->title = 'Мои статьи';
?>

<h2>Мои посты:</h2>
<?php foreach ($articles as $article): ?>

<a href="<?= Url::to(['/blog/article/article', 'id' => $article->id]) ?>" class="not-link">
    <div class="border-blog-2">
        <h3><?= $article->name ?></h3>
        <p>
        <?= nl2br(mb_strlen($article->text) > 400 
            ? mb_substr($article->text, 0, 380) . ' ...'
            : $article->text) 
        ?>
        </p>
        <p class="text-description">
            Создано: <?= date('d.n.Y, G:i', $article->created_at) ?>
        <?php if ($article->created_at != $article->updated_at): ?>
            Изменено: <?= date('d.n.Y, G:i', $article->updated_at) ?>
        <?php endif; ?>
        Создал: <?= $article->createdBy->username ?>
        <?php if ($article->created_by != $article->updated_by): ?>
            Изменил: <?= $article->updatedBy->username ?>
        <?php endif; ?>
        </p>
    </div>
</a>

<?php endforeach; ?>
