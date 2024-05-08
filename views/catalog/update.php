<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Look $model */

$this->title = 'Update Look: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Looks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="look-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
