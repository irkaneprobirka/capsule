<?php

use app\assets\AppAsset;
use app\models\Age;
use app\models\Clothes;
use app\models\Description;
use app\models\Gender;
use app\models\LookItem;
use app\models\Season;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

$this->registerCssFile('@web/css/sliderLook.css', ['depends' => [yii\bootstrap5\BootstrapAsset::class]]);
?>

<div class="card rounded-3 " style="width: 18rem; height: 33rem;">
    <?php
    $lookItems = LookItem::find()->where(['look_id' => $model->id])->all();
    $clothesIds = [];
    foreach ($lookItems as $lookItem) {
        $clothesIds[] = $lookItem->clothes_id;
    }
    $clothes = Clothes::find()->where(['id' => $clothesIds])->all();

    $carouselId = 'carousel-' . uniqid(); // Уникальный идентификатор слайдера

    ?>
    <div class="carousel slide" data-bs-ride="carousel" id="<?= $carouselId ?>" style="height: 18rem;">
        <div class="carousel-inner">
            <?php foreach ($clothes as $key => $cloth) : ?>
                <div class="carousel-item <?= ($key == 0) ? 'active' : '' ?>">
                    <?= Html::img('@web/img/' . $cloth->image_clothes, ['class' => 'd-block w-100 rounded-3']) ?>
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

    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
        <div class="d-flex flex-wrap mb-3">
            <div class="d-flex flex-wrap mb-3">
                <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Season::getSeason()[Description::findOne($model->description_id)->season_id] ?></span>
                <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Type::getType()[Description::findOne($model->description_id)->type_id] ?></span>
                <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Age::getAge()[Description::findOne($model->description_id)->age_id] ?></span>
                <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Gender::getGender()[Description::findOne($model->description_id)->gender_id] ?></span>
            </div>
            <div class="d-flex flex-wrap justify-content-between m-3 w-100">
                <div class='d-inline-block mx-2 like' data-id="<?= $model->id ?>">
                    <span class="count-like"><?= $model->like ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="pink" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                    </svg>
                </div>
                <div class='d-inline-block mx-2 dislike' data-id="<?= $model->id ?>">
                    <span class="count-dislike"><?= $model->dislike ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="pink" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                        <path d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586M7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77" />
                    </svg>
                </div>
            </div>
            <?= Html::a('Подробнее', ['/account/look/view', 'id' => $model->id], ['class' => 'btn btn-outline-primary opacity-50 w-100']) ?>
        </div>
    </div>
</div>

