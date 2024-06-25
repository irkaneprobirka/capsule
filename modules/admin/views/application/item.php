<?php

use app\models\Category;
use app\models\Status;
use yii\bootstrap5\Html;
?>
<div class="card" style="width: 18rem;">
  <?= Html::img('/img/' . $model->image,['class' => 'w-65'])  ?>
  <div class="card-body">
  <h6 class="card-title"><?=$model->title?></h6>
  <p class="card-text">Описание: <?= $model->description?></p>
  <p class="card-text">Категория: <?= Category::getCategory()[$model->category_id]?></p>
  <p class="card-text">Статус: <?= Status::getStatus()[$model->status_id]?></p>
  <p class="card-text">Временная метка: <?= date('d.m.Y H:i:s', strtotime($model->created_at))?></p>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= $model->status_id == 1 
     ?Html::a('Принять в работу', ['confirm', 'id' => $model->id], [
        'class' => 'btn btn-success',
    ]):'' ?> 
      <?= $model->status_id == 1 
     ?Html::a('Выполнить', ['done', 'id' => $model->id], [
        'class' => 'btn btn-warning',
    ]):'' ?> 
  </div>
</div>