<?php

use app\assets\AppAsset;
use app\models\Look;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\account\models\LookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои образы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-index">

    <h1 class="d-flex justify-content-center"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создайте свой образ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'catalog-pjax']); ?>
    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "<div class='d-flex flex-wrap justify-content-center'>{items}</div>",
        'itemView' => 'itemLook',
    ]) ?>

    <?php Pjax::end(); ?>

</div>

<?php

$this->registerCssFile('/css/catalog.css', ['depends' => [
    AppAsset::class,
]]); 

$this->registerJsFile('/js/catalog.js', ['depends' => [
    AppAsset::class,
]]);

?>
