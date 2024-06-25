<?php

use app\assets\AppAsset;
use app\models\Look;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view m-auto">
    <?= Html::a('Назад', 'index', ['class' => 'btn btn-primary mb-3', 'style' => 'width: 8rem;'] ) ?>
    <?php Pjax::begin([
        'id' => 'catalog-view-pjax',
    ]) ?>
    <?php
    $lookProvider = new \yii\data\ActiveDataProvider([
        'query' => Look::find()->where(['id' => $model->look_id]),
    ]);
    ?>

    <div class="neom-class border border-1" style="display: flex; flex-direction: column;">

        <div class="d-flex flex-column m-3">
            <h5 class="card-title fw-semibold text-center m-5">Ваш образ</h5>
            <?= ListView::widget([
                'dataProvider' => $lookProvider,
                'emptyText' => 'Заказ еще не выполнен',
                'emptyTextOptions' => ['class' => "fw-italic text-center", 'style' => 'font-size: 36px;'],
                'itemOptions' => ['class' => 'item'],
                'layout' => "<div class='d-flex flex-wrap justify-content-center'>{items}</div>",
                'itemView' => 'itemLook',
            ]) ?>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 h-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold text-center">Информация о заказе</h5>
                    </div>
                    <table class="table">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Параметр</th>
                                <th scope="col">Информация</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Номер заказа</th>
                                <td><?= $model->id ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Логин пользователя</th>
                                <td><?= User::findOne($model->user_id)->login ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Статус</th>
                                <td><?= Status::getStatus()[$model->status_id] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Стоимость</th>
                                <td><?= $model->cost . ' рублей' ?></td>

                            </tr>
                            <tr>
                                <th scope="row">Пожелание клиента</th>
                                <td style="word-wrap: break-word;white-space: normal;"><?= $model->wish_client ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Ответ стилиста</th>
                                <?php if ($model->answer_stylist == null) : ?>
                                    <td>-</td>
                                <? endif; ?>
                                <?php if ($model->answer_stylist) : ?>
                                    <td style="word-wrap: break-word;white-space: normal;"><?= $model->answer_stylist ?></td>
                                <? endif; ?>
                            </tr>
                            <tr>
                                <th scope="row">Дата создания</th>
                                <td><?= date('d.m.Y H:i', strtotime($model->created_at)) ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>

    </div>
    <?php

    $this->registerCssFile('/css/catalog.css', ['depends' => [
        AppAsset::class,
    ]]);

    $this->registerJsFile('/js/catalog.js', ['depends' => [
        AppAsset::class,
    ]]);

    ?>

    <?php $this->registerCssFile('@web/css/neom.css', ['depends' => [
        AppAsset::class,
    ]]);
    ?>