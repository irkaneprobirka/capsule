<?php

use app\models\CategoryStylist;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

<?= Html::a('Назад', 'index', ['class' => 'btn btn-primary', 'style' => 'width: 8rem;']) ?>
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xxl-3 w-50 m-auto">
            <div class="card mb-0">
                <div class="card-body">
                    <h3 class="text-center mb-3">Настройка роли</h3>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'rbac_role')->dropDownList($roles, ['prompt' => 'Выберите роль пользователя']) ?>

                    <h4 class="text-center mb-3">Добавьте категорию стилисту</h4>

                    <?= $form->field($modelStylist, 'category_stylist_id')->dropDownList(CategoryStylist::getStylistCategory(), ['prompt' => 'Выберите категорию стилиста']) ?>

                    <?= $form->field($modelStylist, 'description')->textarea() ?>

                    <div class="form-group">
                        <div>
                            <?= Html::submitButton('Добавить стилиста', ['class' => 'btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>