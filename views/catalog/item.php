<?php

use app\assets\AppAsset;
use app\models\Age;
use app\models\Clothes;
use app\models\Description;
use app\models\Gender;
use app\models\LookComment;
use app\models\LookItem;
use app\models\Season;
use app\models\Type;
use app\models\User;
use yii\bootstrap5\Html;
use yii\widgets\ListView;

?>


<div class="card d-flex flex-row post-card" style="height: 34rem; width: 60rem;">
    <?php
    $lookItems = LookItem::find()->where(['look_id' => $model->id])->all();
    $clothesIds = [];
    foreach ($lookItems as $lookItem) {
        $clothesIds[] = $lookItem->clothes_id;
    }
    $clothes = Clothes::find()->where(['id' => $clothesIds])->all();

    $carouselId = 'carousel-' . $model->id; // Уникальный идентификатор слайдера

    ?>
    <div class="carousel slide" data-bs-ride="carousel" id="<?= $carouselId ?>" style="height: 30rem; width: 30rem;">
        <div class="carousel-inner">
            <?php foreach ($clothes as $key => $cloth) : ?>
                <div class="carousel-item <?= ($key == 0) ? 'active' : '' ?>">
                    <?= Html::img('@web/img/' . $cloth->image_clothes, ['class' => 'card-img-top', 'style' => 'height: 30rem;']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="card-body d-flex flex-column" style="width: 30rem;">
        <h3 class="card-title"><a href="#"><?= Html::encode($model->title) ?></a></h3>
        <div class="d-flex flex-wrap mb-3">
            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
            <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
            <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
            <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
        </div>
        <p class="card-text p-3" style="font-size:medium;"><?= Html::encode($model->description) ?></p>
        <p class="card-text p-3"><?= Html::encode($model->cost) . ' рублей' ?></p>
        <?php if(!Yii::$app->user->isGuest && $model->user_id != Yii::$app->user->id):?>
        <p class="card-text" style="font-size:medium;">Вам понравился образ? Добавьте его в свою коллекцию!</p>
        <?php endif;?>
        <div class="d-flex flex-row">
            <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-primary w-50 m-1']) ?>
            <?= !Yii::$app->user->isGuest  && $model->user_id != Yii::$app->user->id
                ? Html::a('Добавить образ', ['plus', 'id' => $model->id], ['class' => 'btn btn-primary w-50 m-1'])
                : '' ?>
        </div>
        <div class="d-flex flex-wrap justify-content-between p-3 w-100">
            <div class='d-inline-block like' data-id="<?= $model->id ?>">
                <span class="count-like"><?= $model->like ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="pink" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                </svg>
            </div>
            <div class='d-inline-block dislike' data-id="<?= $model->id ?>">
                <span class="count-dislike"><?= $model->dislike ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="pink" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                    <path d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586M7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77" />
                </svg>
            </div>
        </div>
        <?php
        $query = LookComment::find()
            ->where(['look_id' => $model->id]) // Критерий поиска
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(1);

        $commentdataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        ?>
        <div class="d-flex align-items-center pt-4 mt-auto">
            <?= Html::img('@web/img/' . User::findOne($model->user_id)->image_profile, ['class' => 'avatar rounded-5', 'style' => 'width: 3rem; height: 3rem;']) ?>
            <!-- <span class="avatar" style="background-image: url(...)"></span> -->
            <div class="ms-3">
                <a href="#" class="text-body"><?= User::findOne($model->user_id)->login ?></a>
                <div class="text-secondary"><?= Html::encode(date('m.d.Y H:i', strtotime($model->created_at))) ?></div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->registerCssFile('/css/index.css', ['depends' => [
    AppAsset::class,
]]);
?>