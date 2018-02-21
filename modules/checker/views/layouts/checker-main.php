<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>

<?php
use app\assets\CheckerAsset;

$this->params['project']['label'] = Yii::$app->params['projects']['checker']['label'];
$this->params['project']['url'] = Yii::$app->params['projects']['checker']['url'];
$this->params['project']['documentation'] = Yii::$app->params['projects']['checker']['documentation'];
//$this->params['project']['navigation'] = Yii::$app->params['projects']['blog']['navigation'];

CheckerAsset::register($this);
?>

<?= $content ?>

<?php $this->endContent(); ?>