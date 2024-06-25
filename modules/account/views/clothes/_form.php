<?php

use app\models\Age;
use app\models\CategoryClothes;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clothes-form">

    <div class="row">
        <div class="row">
            <div class="col-md-8 col-lg-6 col-xxl-3 w-50 m-auto">
                <div class="card mb-0">
                    <div class="card-body">
                        <h1 class="d-flex justify-content-center mb-5"><?= Html::encode($this->title) ?></h1>
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'form-label'],
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'category_clothes_id')->dropDownList(CategoryClothes::getCategoryClothes(), ['prompt' => 'Выберите категорию']) ?>

                        <?= $form->field($model, 'season')->dropDownList(Season::getSeason(), ['prompt' => 'Выберите сезон']) ?>

                        <?= $form->field($model, 'age')->dropDownList(Age::getAge(), ['prompt' => 'Выберите возрастную категорию']) ?>

                        <?= $form->field($model, 'gender')->dropDownList(Gender::getGender(), ['prompt' => 'Выберите пол']) ?>

                        <?= $form->field($model, 'type')->dropDownList(Type::getType(), ['prompt' => 'Выберите тип']) ?>

                        <?= $form->field($model, 'cost')->textInput() ?>

                        <?= $form->field($model, 'imageFile')->fileInput() ?>

                        <div class="form-group">
                            <div>
                                <?= Html::submitButton('Добавить вещь', ['class' => 'btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>