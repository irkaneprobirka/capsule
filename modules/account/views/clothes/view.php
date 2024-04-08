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
  <div class="card mb-3" style="max-width: 1200px;">
    <div class="row g-0">
      <div class="col-md-4">
        <?= Html::img('@web/img/' . Html::encode($model->image_clothes), ['style' => 'width: 400px; height: 400px;']) ?>
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Название: <?= Html::encode($model->title) ?></h5>
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