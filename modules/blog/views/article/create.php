<?php
/* @var $model blog\models\article */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Создать пост';
?>
<h3><?= $this->title ?></h3>

<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'name') ?>
    <!-- Туда загружается Summernote -->
    <?= $form->field($model, 'text')->textarea() ?>
    <div class="form-group">
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary', 'name' => 'publish-button']) ?>
    </div>
<?php ActiveForm::end() ?>