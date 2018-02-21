<?php
/* @var $model blog\models\ArticlesComments */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Редактирование комментария';
?>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'text')->textarea() ?>
<div class="form-group">
    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'publish-button']) ?>
</div>
<?php ActiveForm::end() ?>