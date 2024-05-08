<?php

use app\models\CategoryStylist;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_stylist_id')->dropDownList(CategoryStylist::getStylistCategory(), ['prompt' => 'Выберите категорию стилиста']) ?>

    <div class="form-group">
        <?= Html::submitButton('Назначить категорию', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>