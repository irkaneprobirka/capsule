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

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
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
    <tr><th class='border-bottom-0 w-25'>
            <h6 class='fw-semibold mb-0'>Id</h6>
        </th>
        <th class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Стилист</h6>
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