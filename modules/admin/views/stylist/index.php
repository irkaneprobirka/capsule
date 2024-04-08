<?php

use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\widgets\Pjax;

use function PHPSTORM_META\type;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\StylistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Номер',
                'value' => fn ($model) => Html::encode($model->id),
            ],
            [
                'label' => 'Логин',
                'value' => fn ($model) => Html::encode($model->login),
            ],
            // [
            //     'label' => 'Роль в системе',
            //     'value' => function ($user){
            //         if(!empty($userRole = $user->getRoless()[0])){
            //             return $userRole;
            //         }else{
            //             VarDumper::dump($userRole, 10, true);
            //         }
            //     }
            // ],
            // 'name',
            // 'surname',
            // 'patronymic',
            // 'login',
            //'email:email',
            //'phone',
            //'image_profile',
            //'password',
            //'role_id',
            //'auth_key',
            [
                'label' => 'Действия',
                'format' => 'raw',
                'value' => fn ($model) =>
                Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-info m-1'])
                    .
                Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary m-1'])
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>