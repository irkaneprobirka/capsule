<?php

use app\assets\AppAsset;
use app\models\Order;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\helpers\VarDumper;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\stylist\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => 'Заказов нет',
        'emptyTextOptions' => ['class' => "fw-italic text-center", 'style' => 'font-size: 36px;'],
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='card w-100 justify-content-center'><div class='card-body p-4'><div class='table-responsive'>
    <table class='table text-nowrap mb-0 align-middle'><thead class='text-dark fs-4'>
    <tr><th class='border-bottom-0' style='width: 5rem;'>
            <h6 class='fw-semibold mb-0'>Номер заявки</h6>
        </th>
        <th class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Логин пользователя</h6>
        </th>
        <th  class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Статус заказа</h6>
        </th>
        <th  class='border-bottom-0'>
        <h6 class='fw-semibold mb-0'>Приоритет выполнения</h6>
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