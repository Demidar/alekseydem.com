<?php
/* @var $this yii\web\View */
/* @var $data array */
use yii\helpers\Html;
use yii\helpers\Url;
app\assets\AppAsset::register($this);
$this->title = 'Ветлугин Алексей';
?>

<div class="wrap">
    <div class="index-header">
        <div class="index-header-text">
            <h2>Приветствую.</h2>
            <h3> Я - Ветлугин Алексей</h3>
            <h3>Веб-разработчик</h3>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?=
                        Html::a(Html::tag('span', '', ['class' => ['glyphicon', 'glyphicon-file']]) . ' Резюме', Url::toRoute('/site/resume'), ['class' => ['btn', 'btn-lg', 'btn-primary', 'btn-resume']])
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?=
                        Html::a(Html::tag('span', '', ['class' => ['fa', 'fa-briefcase']]) . ' Портфолио', Url::toRoute('/portfolio/default/index'), ['class' => ['btn', 'btn-lg', 'btn-primary', 'btn-portfolio']])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-index">
        <div class="container">
            <h2>Специализирован на работу с языком PHP и фреймворком Yii 2</h2>
            <h3>Мои контакты:</h3>
            <ul class="fa-ul" style="font-size: 1.2em">
                <li><span class="fa-li fa fa-chevron-right"></span><a href="https://vk.com/id47792312" target="_blank">ВКонтакте</a></li>
                <li><span class="fa-li fa fa-chevron-right"></span><a href="mailto:aleksey.dem6@gmail.com">E-mail <span class="fa fa-envelope"></span></a>: aleksey.dem6@gmail.com </li>
                <li><span class="fa-li fa fa-chevron-right"></span><a href="https://www.facebook.com/aleksey.vetlygin">Facebook</a></li>
            </ul>
            <div class="row">
                <div class="col-md-6">
                    <?php foreach ($data as $name => $value): ?>
                        <div class="label-border">
                            <div class="label-img" style="background-image: url('<?= $value['img'] ?>')"></div>
                            <h4><?= $name ?></h4>
                            <ul class="fa-ul myskills">
                                <?php foreach ($value['list'] as $title): ?>
                                    <li><span class="fa-li fa fa-chevron-right"></span><?= $title ?></li>
                                    <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <p>Часто используемые книги:</p>
                    <div class="index-book label-border">
                        <img src="https://www.packtpub.com/sites/default/files/C06125_MockupCover.jpg" alt="">
                        <p><a href="https://www.packtpub.com/application-development/php-7-real-world-application-development">PHP 7: Real World Application Development</a></p>
                    </div>
                    <div class="index-book label-border">
                        <img src="https://www.packtpub.com/sites/default/files/1761OS_4270_Yii%20Application%20Development%20Cookbook%20Third%20Edition.png" alt="">
                        <p><a href="https://www.packtpub.com/web-development/yii2-application-development-cookbook-third-edition">Yii2 Application Development Cookbook - Third Edition</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

