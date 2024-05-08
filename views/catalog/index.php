<?php

use app\models\Look;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CatalogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Лента образов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Create Look', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => '<div class="d-flex justify-content-center">{items}</div>',
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
