<?php

use app\models\Stylist;
use app\models\User;
use yii\bootstrap5\Html;
use yii\web\JqueryAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">


    <div class="row d-flex align-items-center">
        <div class="col-md-8 col-lg-6 col-xxl-3 w-100 m-auto">
            <div class="card mb-0">
                <div class="card-body">
                    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'wish_client')->textarea() ?>


                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'pager' => ['class' => LinkPager::class],
                        'layout' => "{pager}\n<div class='d-flex flex-wrap '>{items}</div>\n{pager}",
                        'itemView' => 'itemStylist',
                    ]) ?>

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