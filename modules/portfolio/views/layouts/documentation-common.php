<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>

<?php
use app\assets\DocumentationAsset;

DocumentationAsset::register($this);
?>

<?= $content ?>

<?php $this->endContent(); ?>