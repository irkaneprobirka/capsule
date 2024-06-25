<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */

$this->title = 'Добавить вещь';
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clothes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
