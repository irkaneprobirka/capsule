<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */

$this->title = 'Update Clothes: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clothes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
