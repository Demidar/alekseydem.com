<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

        <div class="wrap">
            <?php
            // получение списка проектов (label и url)
            $projects = Yii::$app->params['projects'];
            // запись каждого проекта в массив
            foreach ($projects as $project) {
                $navDropdown[] = ['label' => $project['label'], 'url' => $project['url']];
            }
            // верхняя часть Dropdown меню навигации
            $navBegin = [
                ['label' => 'Лист проектов', 'url' => ['/portfolio/default/projects']],
                '<li class="divider"></li>',
            ];
            // готовый Dropdown элемент
            $items = array_merge($navBegin, $navDropdown);

            NavBar::begin([
                'brandLabel' => 'Портфолио',
                'brandUrl' => Url::toRoute('/portfolio/default/index'),
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    isset($this->params['project']) ? ['label' => 'Проект: ' . $this->params['project']['label'], 'url' => $this->params['project']['url'], ['class' => ['active']]] : '',
                    isset($this->params['project']['documentation']) ? ['label' => 'Документация', 'url' => $this->params['project']['documentation']] : '',
                    [
                        'label' => 'Проекты',
                        // элементы сформированы выше
                        'items' => $items,
                    ],
                    !Yii::$app->user->isGuest ?
                    ['label' => 'Аккаунт(' . Yii::$app->user->identity->username . ')', 'url' => ['/site/account']] :
                    ['label' => 'Войти', 'url' => ['/site/login']],
                ],
            ]);
            NavBar::end();
            ?>
            <?php if (Yii::$app->session->allFlashes): ?>
            <div class="container">
                <?php foreach (Yii::$app->session->allFlashes as $key=>$message): ?>
                    <?= Alert::widget([
                        'options' => [
                            'class' => 'alert-danger',
                        ],
                        'body' => '<b>' . $key . '</b><br>' . $message,
                    ]); ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?= $content ?>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">Алексей Ветлугин, <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endContent(); ?>
