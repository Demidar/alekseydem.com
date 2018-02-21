<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Аккаунт';
$this->context->layout = 'auth-common';
?>
<div class="container">
    <h2>Информация о аккаунте:</h2>
    <p>Псевдоним: <?= $model->username ?></p>
    <p>Имя: <?= $model->name ?? 'null' ?></p>
    <p>Фамилия: <?= $model->surname ?? 'null' ?></p>
    <p>E-mail: <?= $model->email ?? 'null' ?></p>
    <p>Дата создания: <?= date('d.n.Y G:i:s', $model->created_at) ?></p>
    <p>Текущая дата: <?= date('d.n.Y G:i:s') ?></p>
    <p>Текущая временная зона: <?= date_default_timezone_get() ?></p>
    <hr>
    <p>Статус: <?= $model->status ?? 'null' ?> (<?php 
        switch($model->status){
            case(10): 
                echo 'активен'; 
                break; 
            case(0):
                echo 'удален';
                break;
            case(1):
                echo 'заблокирован';
                break;
        }
        ?>)</p>
    <hr>
    <?php 
    // показать информацию о присоединенных ролях и разрешениях
    $roles = Yii::$app->authManager->getRolesByUser($model->id);
    $permissions = Yii::$app->authManager->getPermissionsByUser($model->id);
    $assignments = Yii::$app->authManager->getAssignments($model->id);
    
    
    $roleNamesOutput = [];
    $permissionNamesOutput = [];
    $assignmentNamesOutput = [];
    
    if ($roles) {
        foreach ($roles as $role) {
            $roleNamesOutput[] = $role->name . ($role->description ? (' (' . $role->description . ')') : null);
        }
        echo '<p>Роли: <ul><li>' . implode('</li><li>', $roleNamesOutput) . '</li></ul></p>';
    } else {
        echo '<p>У вас нет ролей</p>';
    }
    
    if ($permissions) {
        foreach ($permissions as $permission) {
            $permissionNamesOutput[] = $permission->name . ($permission->description ? (' (' . $permission->description . ')') : null);
        }
        echo '<p>Разрешения: <ul><li>' . implode('</li><li>', $permissionNamesOutput) . '</li></ul></p>';
    } else {
        echo '<p>У вас нет разрешении</p>';
    }
    
    /*
    if ($assignments) {
        echo 'Разрешения:<ul>';
        // перебор ролей
        foreach ($assignments as $roles) {
            //$permissions = Yii::$app->authManager->getPermissionsByRole($roles->roleName);
            $children = Yii::$app->authManager->getChildren($roles->roleName);
            // перебор возможностей
            foreach ($children as $permission) {
                if (Yii::$app->user->can($permission->name)) {
                   echo '<li>' . $permission->name . ($permission->description ? (' (' . $permission->description . ')') : null) . '</li>';
                }
                echo '<li>' . $permission->name . ($permission->description ? (' (' . $permission->description . ')') : null) . '</li>';
            }
        }
        echo '</ul>';
    }*/
    ?>
    </p>
    <a href="<?= Url::toRoute('/site/logout') ?>" type="button" class="btn btn-danger" data-method="post">
        Выйти из аккаунта
    </a>
</div>
