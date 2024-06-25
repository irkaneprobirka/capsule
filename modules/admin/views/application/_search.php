<?php

use app\models\Category;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\account\models\AccountSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'category_id')->dropDownList(Category::getCategory(),['prompt' => 'Выберите категорию']) ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php  echo $form->field($model, 'status_id')->dropDownList(Status::getStatus(),['prompt' =>'Выберите статус']) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'image_admin') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', './', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
