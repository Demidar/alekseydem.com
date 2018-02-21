<?php

?>

<div class="checkerdb-default-index">
    <div class="page-header">
        <div class="container">
                <h1>Тесты</h1>
        </div>
    </div>
    <div class="container">
        <div>
                <h3>КОНТРОЛЬ ЗНАНИЙ ПО ТЕМАМ</h3>
                <p>Для самопроверки знаний по разделам выполните задания, представленные ниже. Для этого перейдите по ссылке нужного задания и выполните его в соответствии с инструкцией. Задания можно выполнять повторно, поэтому при наличии ошибок, вернитесь в начало и исправьте их.</p>
        </div>
        <div class="list">
            <?php foreach ($model as $section): ?>
            <div class="panel panel-default" id="section<?=$section['_id']?>">
                <div class="panel-heading"><?= $section['name'] ?></div>
                <div class="panel-body">
                    <p>id: <?= $section['_id'] ?></p>
                    <p><?= $section['description'] ?></p>
                    <?php foreach ($section['tasks'] as $numTask=>$task): ?>
                    <p>
                        <button class="btn btn-default" onclick="showTask('<?= $section['_id'] ?>', <?= $numTask ?>, 0)">Задача <?= $numTask + 1 ?></button>
                        Тип задания: <?= $task['type'] ?>; 
                        <span id="result-<?= $section['_id'] ?>-<?= $numTask ?>" class="label label-info">not implemented</span></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
