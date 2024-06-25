<?php

use app\models\Age;
use app\models\Clothes;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Look $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="look-form">


    <div class="row d-flex align-items-center">
        <div class="col-md-8 col-lg-6 col-xxl-3 w-100 m-auto">
            <div class="card mb-0">
                <div class="card-body">
                    <h3 class="text-center">Выполнение заказа</h3>
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

                    <?= $form->field($model, 'description')->textarea() ?>

                    <?= $form->field($model, 'season')->dropDownList(Season::getSeason(), ['prompt' => 'Выберите сезон']) ?>

                    <?= $form->field($model, 'age')->dropDownList(Age::getAge(), ['prompt' => 'Выберите возрастную категорию']) ?>

                    <?= $form->field($model, 'gender')->dropDownList(Gender::getGender(), ['prompt' => 'Выберите пол']) ?>

                    <?= $form->field($model, 'type')->dropDownList(Type::getType(), ['prompt' => 'Выберите тип']) ?>
                    <?php
                    $clothesProvider = new \yii\data\ActiveDataProvider([
                        'query' => Clothes::find()->where(['user_id' => $modelOrder->user_id]),
                        'pagination' => [
                            'pageSize' => 6,
                        ],
                        'sort' => [
                            'defaultOrder' => [
                                'created_at' => SORT_DESC,
                            ]
                        ],
                    ]);
                    ?>

                    <?= ListView::widget([
                        'dataProvider' => $clothesProvider,
                        'itemOptions' => ['class' => 'item'],
                        'pager' => ['class' => LinkPager::class],
                        'layout' => "{pager}\n<div class='d-flex mt-3 flex-wrap'>{items}</div>\n{pager}",
                        'itemView' => 'itemClothesLook', // Представление для каждого комментария
                    ]) ?>

                    <?= $form->field($modelOrder, 'answer_stylist')->textarea() ?>

                    <div class="form-group">
                        <div>
                            <?= Html::submitButton('Заказать', ['class' => 'btn btn-primary w-50 d-flex m-auto justify-content-center py-8 fs-4 mb-4 rounded-2 mt-3', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>