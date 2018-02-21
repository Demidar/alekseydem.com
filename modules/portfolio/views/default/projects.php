<?php
$this->title = 'Проекты';

use app\assets\PortfolioAsset;
use yii\helpers\Url;

PortfolioAsset::register($this);
?>
<div class="container">
    <p>Проекты</p>
    <?php
    $projects = Yii::$app->params['projects'];
    foreach ($projects as $project):
        ?>
        <a href="<?= Url::to($project['url']) ?>" type="button" class="btn btn-default btn-lg btn-block center">
                <h3><?= $project['label'] ?></h3>
                <p><?= $project['description'] ?></p>
                <p>
                <?php foreach ($project['tools'] as $tool): ?>
                    <span class="label label-primary"><?= $tool ?></span>
                <?php endforeach; ?>
                </p>
            </a>
<?php endforeach; ?>
</div>