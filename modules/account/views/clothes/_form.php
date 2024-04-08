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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_clothes_id')->dropDownList(CategoryClothes::getCategoryClothes(), ['prompt' => 'Выберите категорию'])?>
    
    <?= $form->field($model, 'season')->dropDownList(Season::getSeason(), ['prompt' => 'Выберите сезон']) ?>

    <?= $form->field($model, 'age')->dropDownList(Age::getAge(), ['prompt' => 'Выберите возрастную категорию']) ?>

    <?= $form->field($model, 'gender')->dropDownList(Gender::getGender(), ['prompt' => 'Выберите пол']) ?>

    <?= $form->field($model, 'type')->dropDownList(Type::getType(), ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
