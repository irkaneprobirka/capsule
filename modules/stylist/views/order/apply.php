
<?php

use app\models\Age;
use app\models\Clothes;
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
    <?php
    $clothesProvider = new \yii\data\ActiveDataProvider([
        'query' => Clothes::find()->where(['user_id' => $modelOrder->user_id]),
    ]);
    ?>

    <?= ListView::widget([
        'dataProvider' => $clothesProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='d-flex mt-3 flex-wrap'>{items}</div>",
        'itemView' => 'itemClothesLook', // Представление для каждого комментария
    ]) ?>

    <?= $form->field($modelOrder, 'answer_stylist')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохарнить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
