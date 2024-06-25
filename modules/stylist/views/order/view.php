<?php

use app\assets\AppAsset;
use app\models\Age;
use app\models\Description;
use app\models\Look;
use app\models\Season;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\VarDumper;
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
    <?= Html::a('Назад', 'index', ['class' => 'btn btn-primary mb-3', 'style' => 'width: 8rem;']) ?>
    <?php Pjax::begin([
        'id' => 'catalog-view-pjax',
    ]) ?>
    <?php
    $lookProvider = new \yii\data\ActiveDataProvider([
        'query' => Look::find()->where(['id' => $model->look_id]),
    ]);
    ?>

    <div class="neom-class border border-1" style="display: flex; flex-direction: row;">
        <div class="col-lg-4 d-flex align-items-stretch justify-content-center">
            <div class="card w-100 h-100 d-flex justify-content-center m-auto">
                <div class="card-body p-4">
                    <div class="mb-5">
                        <h5 class="card-title fw-semibold">Прогресс выполнения заказа</h5>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        <?= $model->status_id == 3
                        ? '<li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">Статус</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Выполнен</div>
                        </li>'
                        : '' ?>
                        <?php
                        $lookModel = Look::find()->where(['id' => $model->look_id])->one();

                        if ($lookModel) {
                            foreach ($lookModel->attributes as $attr => $value) {
                                if ($value !== null && $value !== 0 && $value !== 1 && $attr != 'id' && $attr != 'user_id') {
                                    echo '<li class="timeline-item d-flex position-relative overflow-hidden w-100">
                                        <div class="timeline-time text-dark flex-shrink-0 text-end">' . $lookModel->getAttributeLabel($attr) . '</div>
                                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                            <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                        </div>
                                        <div class="timeline-desc fs-3 text-dark mt-n1">Заполнено <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#589d44"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.333 2c1.96 0 3.56 1.537 3.662 3.472l.005 .195v12.666c0 1.96 -1.537 3.56 -3.472 3.662l-.195 .005h-12.666a3.667 3.667 0 0 1 -3.662 -3.472l-.005 -.195v-12.666c0 -1.96 1.537 -3.56 3.472 -3.662l.195 -.005h12.666zm-2.626 7.293a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg></div>
                                    </li>';
                                }
                            }
                        }
                        ?>
                        <?= $model->status_id == 2
                        ? '<li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">Статус</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Принят в работу</div>
                        </li>'
                        : '' ?>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">Статус</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Новый</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
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

    <div class="d-flex flex-column m-3">
        <h5 class="card-title fw-semibold text-center m-5">Информация о заказе</h5>
        <?= ListView::widget([
            'dataProvider' => $lookProvider,
            'emptyText' => 'Заказ еще не выполнен',
            'emptyTextOptions' => ['class' => "fw-italic text-center", 'style' => 'font-size: 36px;'],
            'itemOptions' => ['class' => 'item'],
            'layout' => "<div class='d-flex flex-wrap justify-content-center'>{items}</div>",
            'itemView' => 'itemLook',
        ]) ?>
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