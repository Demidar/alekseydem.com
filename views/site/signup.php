<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Регистрация';
$this->context->layout = 'auth-common';
?>
<div class="container">
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']) ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                
                    <?= $form->field($model, 'password')->passwordInput() ?>
                
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                    <?= $form->field($model, 'name') ?>

                    <?= $form->field($model, 'surname') ?>

                    <?= $form->field($model, 'email') ?>

                    <?php if (Captcha::checkRequirements()): ?>
                    <div class="control-group">
                        <?= Captcha::widget([
                            'model' => $model,
                            'attribute' => 'verifyCode',
                        ]); ?>
                        <?= Html::error($model, 'verifyCode') ?>
                    </div>
                    <?php endif; ?>
                
                    <div class="form-group">
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>