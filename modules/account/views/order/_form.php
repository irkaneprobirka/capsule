<?php

use app\models\Stylist;
use app\models\User;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stylist_id')->dropDownList(Stylist::getStylistLogin(), ['prompt' => 'Выберите стилиста']) ?>

    <?= $form->field($model, 'wish_client')->textarea() ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
