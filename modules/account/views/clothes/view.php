<?php

use app\models\CategoryClothes;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clothes-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) ?>
  </p>
  <div class="card mb-3 rounded rounded-3 shadow-lg bg-white rounded" style="max-width: 900px;">
    <div class="row g-0">
      <div class="col">
        <?= Html::img('@web/img/' . Html::encode($model->image_clothes), ['style' => 'width: 450px; height: 450px;', 'class' => 'rounded-start']) ?>
      </div>
      <div class="col">
        <div class="card-body">
          <h5 class="card-title fs-6 fw-bold">Название: <?= Html::encode($model->title) ?></h5>
          <p class="card-text"><?= Html::encode(CategoryClothes::getCategoryClothes()[$model->category_clothes_id]) ?></p>
          <p class="card-text"><small class="text-muted">Дата создания: <?= date('Y.m.d H:i:s', strtotime(Html::encode($model->created_at))) ?></small></p>
        </div>
      </div>
    </div>
  </div>
  
  <? DetailView::widget([
    'model' => $model,
    'attributes' => [
      'id',
      'title',
      'user_id',
      'image_clothes',
      'category_clothes_id',
      'created_at',
      'cost',
      'description_id',
      'brand',
    ],
  ]) ?>

</div>