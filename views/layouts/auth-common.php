<?php $this->beginContent('@pf/views/layouts/portfolio-common.php'); ?>

<?php 
use app\assets\PortfolioAsset;

PortfolioAsset::register($this);
?>

    <?= $content ?>

<?php $this->endContent(); ?>