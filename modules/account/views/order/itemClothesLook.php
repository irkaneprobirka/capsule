<?php

use app\models\Age;
use app\models\CategoryClothes;
use app\models\Clothes;
use app\models\Description;
use app\models\Gender;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

?>


<div class="form-check mt-3">
  <input class="form-check-input" type="checkbox" name="selectedCards[]" value="<?= $model->id ?>" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
  <div class="card m-3 rounded-3" style="width: 18rem; height: 30rem;">
  <?= Html::img('@web/img/' . $model->image_clothes, ['class' => 'card-img-top rounded-3 h-75']) ?>
  <? Html::a('<svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="#ffffff"  class="icon icon-tabler icons-tabler-filled icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22 .379l.045 .1l.03 .083l.014 .055l.014 .082l.011 .1v.11l-.014 .111a.992 .992 0 0 1 -.026 .11l-.039 .108l-.036 .075l-.016 .03c-2.764 4.836 -6.3 7.38 -10.555 7.499l-.313 .004c-4.396 0 -8.037 -2.549 -10.868 -7.504a1 1 0 0 1 0 -.992c2.831 -4.955 6.472 -7.504 10.868 -7.504zm0 5a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" /></svg>', ['clothes/view', 'id' => $model->id], ['class' => 'bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3 mr-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart']) ?>
  <div class="card-body">
    <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
    <div class="d-flex flex-wrap mb-3">
      <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
      <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
    </div>
    <?= Html::a('Подробнее', ['clothes/view', 'id' => $model->id], ['class' => 'btn text-primary-emphasis btn-primary-subtle border border-primary-subtle w-100']) ?>
  </div>
</div>
  </label>
</div>