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

  <div class="card mb-3 rounded rounded-3 shadow-lg bg-white rounded" style="max-width: 900px;">
    <div class="row g-0">
      <div class="col">
        <?= Html::img('@web/img/' . Html::encode($model->image_clothes), ['style' => 'width: 450px; height: 450px;', 'class' => 'rounded-start']) ?>
      </div>
      <div class="col">
        <div class="card-body">
          <h4 class="card-titlec text-center"><?= Html::encode($model->title) ?></h4>
          <div class="d-flex flex-wrap justify-content-center mb-3">
            <span class="badge bg-primary rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
            <span class="badge bg-primary rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
            <span class="badge bg-primary rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
            <span class="badge bg-primary rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
          </div>
          <p class="p-3" style="font-size: 18px;">Стоимость вещи - <?= $model->cost . ' рублей' ?></p>
          <p class="p-3" style="font-size: 18px;">Можно купить в магазинах бренда - <?= $model->brand ?></p>
          <p class="d-flex justify-content-center mt-5">
            <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary rounded-pill']) ?>
            <?= Html::a('Удалить вещь', ['delete', 'id' => $model->id], [
              'class' => 'btn btn-danger rounded-pill',
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

</div>