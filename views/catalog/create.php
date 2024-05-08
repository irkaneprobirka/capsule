<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Look $model */

$this->title = 'Create Look';
$this->params['breadcrumbs'][] = ['label' => 'Looks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
