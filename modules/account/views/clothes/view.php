<?php


use yii\widgets\DetailView;
use app\models\Age;
use app\models\CategoryClothes;
use app\models\Description;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clothes-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="card mb-3 rounded rounded-3 shadow-lg bg-white rounded" style="max-width: 900px;">
    <div class="row g-0">
      <div class="col">
        <?= Html::img('@web/img/' . Html::encode($model->image_clothes), ['style' => 'width: 450px; height: 450px;', 'class' => 'rounded-start']) ?>
      </div>
      <div class="col">
        <div class="card-body">
          <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
          <div class="d-flex flex-wrap mb-3">
            <span class="badge bg-info rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
            <span class="badge bg-info rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
            <span class="badge bg-info rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
            <span class="badge bg-info rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
          </div>
          <p>
            <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить вещь', ['delete', 'id' => $model->id], [
              'class' => 'btn btn-danger',
              'data' => [
                'confirm' => 'Вы уверены что хотите удалить вещь? Будут удалены также образы, использующие ее',
                'method' => 'post',
              ],
            ]) ?>
          </p>
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