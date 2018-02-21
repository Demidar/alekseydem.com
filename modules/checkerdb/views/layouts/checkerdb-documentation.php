<?php $this->beginContent('@pf/views/layouts/documentation-common.php'); ?>

<?php
use app\assets\DocumentationAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->params['project']['label'] = Yii::$app->params['projects']['checkerdb']['label'];
$this->params['project']['url'] = Yii::$app->params['projects']['checkerdb']['url'];
$this->params['project']['documentation'] = Yii::$app->params['projects']['checkerdb']['documentation'];
$this->params['project']['navigation'] = Yii::$app->params['projects']['checkerdb']['documentationNavigation'];
DocumentationAsset::register($this);
?>

<div class="container content">
    <div class="row">
        <div class="col-sm-4 sidebar">
            <div class="list-group">
                <?php foreach ($this->params['project']['navigation'] as $item) {
                    echo Html::a($item['label'], $item['url'], ['class' => ['list-group-item']]);
                } ?>
            </div>
        </div>
        <div class="col-sm-8 main-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Тесты', 'url' => ['/checkerdb/default/index']],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
                <div class="panel-body">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>