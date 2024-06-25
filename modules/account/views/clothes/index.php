<?php

use app\models\Clothes;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\ClothesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Галерея вещей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex flex-wrap justify-content-center mb-3">
    <p>
        <?= Html::a('Добавить вещь', ['create'], ['class' => 'btn btn-success rounded-pill']) ?>
    </p>
    <h3 class="mx-5"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'pager' => ['class' => LinkPager::class],
        'layout' => "{pager}\n<div class='d-flex flex-wrap justify-content-center'>{items}</div>\n{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
