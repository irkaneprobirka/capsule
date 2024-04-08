<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clothes $model */

$this->title = 'Create Clothes';
$this->params['breadcrumbs'][] = ['label' => 'Clothes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clothes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
