<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\account\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

<div class="d-flex flex-wrap justify-content-center">
    <p>
        <?= Html::a('Заказать образ', ['create'], ['class' => 'btn btn-success rounded-pill']) ?>
    </p>
    <h3 class="mx-5"><?= Html::encode($this->title) ?></h3>
    </div>


    <?php Pjax::begin(); ?>
    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => '
        <div class="d-flex flex-column m-auto justify-content-center">
        <a href="/account/order/create" class="text-center fs-4">У вас пока нет заказов... Оформите заказ у наших стилистов!</a>
        <img src="/img/order.jpg" class="m-auto" style="width: 50rem;height:30rem;">
        </div>',
        // 'emptyTextOptions' => ['class' => "fw-italic text-center", 'style' => 'font-size: 36px;'],
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='card w-100 justify-content-center'><div class='card-body p-4'><div class='table-responsive'>
    <table class='table text-nowrap mb-0 align-middle'><thead class='text-dark fs-4'>
    <tr><th class='border-bottom-0' style='width: 5rem;'>
            <h6 class='fw-semibold mb-0'>Номер заявки</h6>
        </th>
        <th class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Стилист</h6>
        </th>
        <th  class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Статус заказа</h6>
        </th>
        <th class='border-bottom-0'>
        <h6 class='fw-semibold mb-0'>Действия</h6>
    </th>
    </tr>
</thead>
<tbody>{items}</tbody></table></div></div></div>{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>