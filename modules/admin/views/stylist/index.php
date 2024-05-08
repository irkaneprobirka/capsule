<?php

use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\widgets\ListView;
use yii\widgets\Pjax;

use function PHPSTORM_META\type;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\StylistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1 class="d-flex justify-content-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <? Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='card w-100 justify-content-center'><div class='card-body p-4'><div class='table-responsive'>
    <table class='table text-nowrap mb-0 align-middle'><thead class='text-dark fs-4'>
    <tr><th class='border-bottom-0 w-25'>
            <h6 class='fw-semibold mb-0'>Id</h6>
        </th>
        <th class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Роль пользователя</h6>
        </th>
        <th class='border-bottom-0'>
            <h6 class='fw-semibold mb-0'>Действия</h6>
        </th>
        <th class='border-bottom-0'>
        <h6 class='fw-semibold mb-0'>Категория</h6>
    </th>
    </tr>
</thead>
<tbody>{items}</tbody></table></div></div></div>{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>