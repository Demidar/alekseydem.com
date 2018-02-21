<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>

<?php
use app\assets\BlogAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use blog\models\Articles;
use blog\models\ArticlesComments;

$this->params['project']['label'] = Yii::$app->params['projects']['blog']['label'];
$this->params['project']['url'] = Yii::$app->params['projects']['blog']['url'];
$this->params['project']['documentation'] = Yii::$app->params['projects']['blog']['documentation'];
$this->params['project']['navigation'] = Yii::$app->params['projects']['blog']['navigation'];

BlogAsset::register($this);
?>
<header class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2>Блог</h2>
                <p>Здесь вы можете создавать посты и комментарии к ним</p>
            </div>
            <div class="col-sm-3 col-xs-offset-1">
                <div class="user-info">
                    <?php if (Yii::$app->user->isGuest): ?>
                    <p>Вы не авторизованы в системе, <a href="<?= Url::to(['/site/login']) ?>">Войти</a></p>
                    <p>Для входа вы можете использовать демонстрационный аккаунт:<br>
                        <b>Логин: demo</b><br>
                        <b>Пароль: demo</b>
                    </p>
                    <?php else: ?>
                    <p>Вы авторизованы как <a href="<?= Url::to(['/blog/account/index']) ?>"><?= Yii::$app->user->identity->username ?></a></p>
                    <p><a href="<?= Url::to(['/blog/article/create']) ?>">(Создать пост)</a>, <a href="<?= Url::to(['/blog/account/posts']) ?>">Постов: <?= Articles::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => Articles::STATUS_ACTIVE])->count() ?></a></p>
                    <p><a href="<?= Url::to(['/blog/account/comments']) ?>">Комментариев: <?= ArticlesComments::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => ArticlesComments::STATUS_ACTIVE])->count() ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container body-template">
    <div class="row">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-default nav-blog',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $this->params['project']['navigation'],
    ]);
    NavBar::end();
    ?>
    </div>
    <?= $content ?>
</div>
<?php $this->endContent(); ?>