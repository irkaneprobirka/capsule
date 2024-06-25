<?php

use app\models\Category;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\application $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'title',
                'filter' => false, 
                'value' => $model->title
            ],
            [
                'attribute' => 'description',
                'filter' => false, 
                'value' => $model->description
            ],
            [
                'attribute' => 'image',
                'filter' => false, 
                'format' => 'html',
                'value' => Html::img('/img/' . $model->image, ['class' => 'w-25'])
            ],
            [
                'attribute' => 'description',
                'filter' => false, 
                'value' => $model->description
            ],
            [
                'attribute' => 'category_id',
                'filter' => Category::getCategory(),
                'value' => Category::getCategory()[$model->category_id],
            ],
            [
                'attribute' => 'user_id',
                'filter' => User::getUser(),
                'value' => User::getUser()[$model->user_id],
            ],
            [
                'attribute' => 'status_id',
                'filter' => Status::getStatus(),
                'value' => Status::getStatus()[$model->status_id],
            ],
            [
                'attribute' =>  'created_at',
                'filter' => false,
                'value' => date('d.m.Y h:i:s', strtotime($model->created_at))
            ],
            [
                'attribute' => 'reason',
                'filter' => false,
                'visible' => (bool) $model->reason,
                'value' => $model->reason,
            ],
            [
                'attribute' => 'image_admin',
                'filter' => false,
                'visible' => (bool) $model->image_admin,
                'format' => 'html',
                'value' => Html::img('/img/' . $model->image_admin),
            ],
            
        ],
    ]) ?>

</div>
