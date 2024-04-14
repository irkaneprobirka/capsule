<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
?>

<div class="site-login">



    <div class="row">
        <div class="col-md-8 col-lg-6 col-xxl-3 w-50 m-auto">
            <div class="card mb-0">
                <div class="card-body">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <div class="form-group">
                        <div>
                            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <p class="fs-4 mb-0 fw-bold">Еще нет аккаунта?</p>
                        <?= Html::a('Создайте аккаунт', '/site/register', ['class' => 'text-primary fw-bold ms-2']) ?>
                        <!-- <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Создайте аккаунт</a> -->
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>