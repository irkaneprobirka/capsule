<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1>Пользователь: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? Html::a('Delete', ['delete', 'id' => $model->id], [
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
                'label' => 'Номер',
                'value' => fn ($model) => Html::encode($model->id),
            ],
            [
                'label' => 'Логин',
                'value' => fn ($model) => Html::encode($model->login),
            ],
            [
                'label' => 'Роль в системе',
                'value' => function ($user){
                    if(!empty($userRole = $user->getRoless()[0])){
                        return $userRole;
                    }
                }
            ],
            [
                'label' => 'Имя',
                'value' => fn ($model) => Html::encode($model->name),
            ],
            [
                'label' => 'Фамилия',
                'value' => fn ($model) => Html::encode($model->surname),
            ],
            [
                'label' => 'Отчество',
                'value' => fn ($model) => Html::encode($model->patronymic),
            ],
            [
                'label' => 'email',
                'value' => fn ($model) => Html::encode($model->email),
            ],
            [
                'label' => 'phone',
                'value' => fn ($model) => Html::encode($model->phone),
            ],
            [
                'label' => 'Изображение профиля',
                'format' => 'raw',
                'value' => fn ($model) => 
                Html::img('/img/'. Html::encode($model->image_profile), ['style' => 'width: 400px; height: 300px;']),
            ],
            // [
            //     'label' => 'Пароль',
            //     'value' => fn ($model) => Html::encode($model->password),
            // ],
            // [
            //     'label' => 'Пароль',
            //     'value' => fn ($model) => Html::encode($model->auth_key),
            // ],
            // 'auth_key',
        ],
    ]) ?>

</div>