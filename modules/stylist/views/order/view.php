<?php

use app\assets\AppAsset;
use app\models\Look;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <?php Pjax::begin([
        'id' => 'catalog-view-pjax',
    ]) ?>
    <?php
    $lookProvider = new \yii\data\ActiveDataProvider([
        'query' => Look::find()->where(['id' => $model->look_id]),
    ]);
    ?>

    <div class="neom-class border border-1" style="display: flex; flex-direction: row;">
        <div class="d-flex flex-column m-3">
            <?= ListView::widget([
                'dataProvider' => $lookProvider,
                'itemOptions' => ['class' => 'item'],
                'layout' => "<div class='d-flex flex-wrap'>{items}</div>",
                'itemView' => 'itemLook',
            ]) ?>
            <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-primary mx-4', 'style' => 'width:228px;']) ?>
        </div>
        <div class="card w-100 mt-3 mx-3">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold fs-6">Детали заказа</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Номер заказа</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fs-5"><?= Html::encode($model->id) ?></div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Логин пользователя</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold fs-5"><?= Html::encode(User::findOne($model->user_id)->login) ?>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Статус</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fs-5"><?= Html::encode(Status::getStatus()[$model->status_id]) ?></div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Стоимость</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold fs-5"><?= Html::encode($model->cost) . ' руб.' ?>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Дата создания</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold fs-5"><?= date('d.m.Y H:i', strtotime($model->created_at)) ?>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Пожелание клиента</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fs-5"><?= Html::encode($model->wish_client) ?></div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end fs-5" style="width: 10rem;">Обратная связь</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fs-5"><?= Html::encode($model->answer_stylist) ?></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>



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

<?php $this->registerCssFile('@web/css/neom.css', ['depends' => [
    AppAsset::class,
]]);
?>