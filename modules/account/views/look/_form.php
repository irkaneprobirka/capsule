<?php

use app\models\Age;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Look $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="look-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'season')->dropDownList(Season::getSeason(), ['prompt' => 'Выберите сезон']) ?>

    <?= $form->field($model, 'age')->dropDownList(Age::getAge(), ['prompt' => 'Выберите возрастную категорию']) ?>

    <?= $form->field($model, 'gender')->dropDownList(Gender::getGender(), ['prompt' => 'Выберите пол']) ?>

    <?= $form->field($model, 'type')->dropDownList(Type::getType(), ['prompt' => 'Выберите тип']) ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='d-flex flex-wrap '>{items}</div>",
        'itemView' => 'item',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
