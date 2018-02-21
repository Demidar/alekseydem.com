<?php
use yii\helpers\Url;
use app\assets\PortfolioAsset;

PortfolioAsset::register($this);
$this->title = 'Портфолио';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="<?= Url::toRoute('/site/index') ?>" type="button" class="btn btn-default btn-lg btn-block">
                <h4>&lt;&lt;&lt; Вернуться на главную страницу</h4>
            </a>
        </div>
    </div>
    
    <div class="portfolio-border center">
        <h2><span class="fa fa-briefcase"></span> Портфолио</h2>
        <p>На данной странице представлены различные разработки с использованием 
            веб-технологии.</p>
        <ul style="list-style: none;">
            <li><strong>Проекты</strong>: Список рабочих проектов определенной направленности.</li>
            <li><strong>Дневник портфолио</strong>: проект, в котором описано 
                составление портфолио в хронологическом порядке.</li>
            <li><strong>Разработки</strong>: проект, в котором представлены различные разработки, 
                использованные в собственных проектах.</li>
        </ul>
    </div>
    <div class="portfolio-border">
                
        <div class="panel panel-default">
            <div class="panel-heading">
                Список проектов
            </div>
            <div class="list-group portfolio-scroll">

            <?php
                // получение списка проектов (label, url и description)
                $projects = Yii::$app->params['projects'];

                foreach ($projects as $project):?>
                    <a href="<?= Url::to($project['url']) ?>" class="list-group-item">
                        <h4><?= $project['label'] ?></h4>
                        <p>
                        <?= $project['description'] ?>
                        <?php foreach ($project['tools'] as $tool): ?>
                            <span class="label label-default"><?= $tool ?></span>
                        <?php endforeach; ?>
                        </p>
                    </a>
            <?php endforeach; ?>

            </div>
        </div>
        
        <a href="<?= Url::toRoute('default/projects') ?>" type="button" class="btn btn-default btn-lg btn-block center">
            <h2><span class="fa fa-cogs"></span> Проекты</h2>
            <p>Лист всех проектов</p>
        </a>
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <a href="<?= Url::toRoute('chronicle/index') ?>" type="button" class="btn btn-default btn-lg btn-block center">
                <h3><span class="fa fa-pencil"></span> Дневник портфолио</h3>
                <p>Ведение разработки портфолио в хронологическом порядке</p>
            </a>
        </div>
        <div class="col-sm-6">
            <a href="<?= Url::toRoute('capability/index') ?>" type="button" class="btn btn-default btn-lg btn-block">
                <h3><span class="fa fa-wrench"></span> Разработки</h3>
                <p>Здесь размещены различные копоненты из своих проектов</p>
            </a>
        </div>
    </div>
</div>