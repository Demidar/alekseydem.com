<?php

use yii\helpers\Html;
?>
<div class="container">
    <h2>Управление ролями и правами:</h2>
    <table class="table">
        <tr>
            <td rowspan="2">Пользователь:</td>
            <td colspan="<?= count($permissionsAvailable) ?>" style="background-color: #eee">Права:</td>
            <td colspan="<?= count($rolesAvailable) ?>" style="background-color: #dfd">Роли:</td>
        </tr>
        <tr>
            
            <?php foreach ($permissionsAvailable as $p): ?>
            <td style="background-color: #eee"><?= $p->name ?><?= $p->description ? '<br>(' . $p->description . ')' : null ?></td>
            <?php endforeach; ?>
            <?php foreach ($rolesAvailable as $r): ?>
            <td style="background-color: #dfd"><?= $r->name ?><?= $r->description ? '<br>(' . $r->description . ')' : null ?></td>
            <?php endforeach; ?>
        </tr>

        <?php foreach ($users as $u): ?>
            <tr>
                <td><?php echo $u->username ?></td>
                <?php foreach ($permissionsAvailable as $p): ?>
                    <td style="background-color: #eee">
                        <?php
                        if (in_array($p->name, $permissionsNamesByUser[$u->id])) {
                            echo Html::a('Yes', ['remove-permission', 'userId' => $u->id, 'permissionName' => $p->name]);
                        } else {
                            echo Html::a('No', ['add-permission', 'userId' => $u->id, 'permissionName' => $p->name]);
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
                <?php foreach ($rolesAvailable as $r): ?>
                    <td style="background-color: #dfd">
                        <?php
                        if (in_array($r->name, $rolesNamesByUser[$u->id])) {
                            echo Html::a('Yes', ['remove-role', 'userId' => $u->id, 'roleName' => $r->name]);
                        } else {
                            echo Html::a('No', ['add-role', 'userId' => $u->id, 'roleName' => $r->name]);
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>