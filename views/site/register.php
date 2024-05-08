<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';
/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-login">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]
            ); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'patronymic')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'imageFile')->fileInput() ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            <?= $form->field($model, 'rules')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div><!-- site-register -->