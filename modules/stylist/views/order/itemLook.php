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
                    <?= Html::img('@web/img/' . $cloth->image_clothes, ['class' => 'd-flex m-auto justify-content-center', 'style' => 'height: 25rem;width: 30rem; object-fit:cover;']) ?>
                    <h3 class="card-title text-center mt-3"><a href="#"><?= Html::encode($cloth->title) ?></a></h3>
                    <div class="d-flex flex-wrap mb-3 justify-content-center">
                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Season::getSeason()[Description::findOne($cloth->description_id)->season_id] ?></span>
                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill m-1"><?= Type::getType()[Description::findOne($cloth->description_id)->type_id] ?></span>
                        <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Age::getAge()[Description::findOne($cloth->description_id)->age_id] ?></span>
                        <span class="badge bg-primary-subtle text-primary-emphasis  rounded-pill m-1"><?= Gender::getGender()[Description::findOne($cloth->description_id)->gender_id] ?></span>
                    </div>
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
    </div>
</div>