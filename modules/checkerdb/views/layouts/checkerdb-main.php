<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>

<?php
use app\assets\CheckerdbAsset;

$this->params['project']['label'] = Yii::$app->params['projects']['checkerdb']['label'];
$this->params['project']['url'] = Yii::$app->params['projects']['checkerdb']['url'];
$this->params['project']['documentation'] = Yii::$app->params['projects']['checkerdb']['documentation'];
//$this->params['project']['navigation'] = Yii::$app->params['projects']['blog']['navigation'];

CheckerdbAsset::register($this);
?>
<div class="container">
<?= $content ?>
</div>
<?php $this->endContent(); ?>