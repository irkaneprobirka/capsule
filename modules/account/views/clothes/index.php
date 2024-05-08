<?php

use app\models\Clothes;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\ClothesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Галерея вещей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clothes-index">
    <div class="d-flex flex-wrap justify-content-between">
    <p>
    <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg>', ['create'], ['class' => 'bg-primary rounded-circle p-2 text-white d-inline-flex bottom-0 end-0 mb-n3 me-3 mr-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?php Pjax::begin(); ?>
    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'pager' => ['class' => LinkPager::class],
        'layout' => "{pager}\n<div class='d-flex flex-wrap justify-content-center'>{items}</div>\n{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
