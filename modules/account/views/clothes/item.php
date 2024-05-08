<?php

use app\models\Age;
use app\models\CategoryClothes;
use app\models\Description;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;

?>

<div class="card m-3 rounded-3 " style="width: 18rem; height: 30rem;">
  <?= Html::img('@web/img/' . $model->image_clothes, ['class' => 'card-img-top rounded-3', 'style' => 'width: 18rem; height: 16rem;']) ?>
  <div class="card-body">
    <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
    <div class="d-flex flex-wrap mb-3">
      <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
    </div>
    <?= Html::a('Подробнее', ['clothes/view', 'id' => $model->id], ['class' => 'btn btn-primary w-100 ']) ?>
  </div>
</div>