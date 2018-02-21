<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\DocumentationAsset;

DocumentationAsset::register($this);
$this->params['project']['label'] = Yii::$app->params['projects']['capability']['label'];
$this->params['project']['url'] = Yii::$app->params['projects']['capability']['url'];
$this->params['project']['navigation'] = Yii::$app->params['projects']['capability']['navigation'];
?>
<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>
<div class="container content">
    <div class="row">
        <div class="col-sm-4 sidebar">
            <div class="list-group">
                <?php foreach ($this->params['project']['navigation'] as $item) {
                    $defaultClass = ['class' => ['list-group-item']];
                    $classes = isset($item[0]['class']) ? array_merge_recursive($defaultClass, $item[0]) : $defaultClass;
                    
                    echo Html::a($item['label'], $item['url'], $classes, $item['id'] ?? null);
                } ?>
            </div>
        </div>
        <div class="col-sm-8 main-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Проекты', 'url' => ['/portfolio/default/index']],
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