<?php

use app\models\Look;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CatalogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Лента образов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-index">

<div class="d-flex flex-wrap justify-content-center mb-3">
    <p>
        <?= Html::a('Вернуться на главную', ['/site/index'], ['class' => 'btn btn-success rounded-pill']) ?>
    </p>
    <h2 class="mx-5"><?= Html::encode($this->title) ?></h2>
    </div>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => '<div class="d-flex justify-content-center mt-3 flex-column">{items}</div>',
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
