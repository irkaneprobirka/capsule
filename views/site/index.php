<?php

/** @var yii\web\View $this */

use app\models\User;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php $users = User::find()->count(); ?>

    <div class="jumbotron text-center bg-transparent mt-3 mb-5">

        <div class="brand-logo d-flex align-items-center justify-content-center mb-3">
            <a href="/site/index" class="text-nowrap logo-img">
                <?= Html::img('@web/img/cloth.png', ['style' => 'width: 100px; height: 100px;']) ?>
            </a>
            <h1 class="display-4">StyleFriend</h1>
        </div>

        <p class="lead">Наше приложение используют <?= $users ?> пользователей!</p>

        <p><a class="btn btn-lg btn-primary rounded-pill" href="/site/register">Присоединяйтесь к нашей команде</a></p>
    </div>




    <div class="row g-0 bg-body-secondary position-relative">
        <div class="col-md-6 mb-md-0 p-md-4">
            <?= Html::img('@web/img/info.jpg', ['class' => 'w-100', 'style' => 'width: 30rem;height:30rem; ']) ?>
        </div>
        <div class="col-md-6 p-4 ps-md-0">
            <h4 class="mt-0">
                StyleFriend: Ваш Персональный Гид в Мире Моды</h4>
            <p class="w-75 m-auto mt-5" style="font-size: 20px;">Добро пожаловать на StyleFriend – уникальную платформу, где мода встречается с инновациями. Наш сайт предлагает пользователям возможность загружать свои любимые вещи, указывать их описание, бренд и цену, а затем создавать из них стильные образы. Эти образы можно делиться в нашей ленте, получая вдохновение и восхищение от других участников сообщества.</p>
            <p class="d-flex m-auto justify-content-center mt-3"><a class="btn btn-lg btn-primary rounded-pill" href="/catalog/index">Посмотреть образы участников</a></p>
        </div>
    </div>


    <div class="row g-0 bg-body-secondary position-relative mt-5 m-auto" style="width: 40rem;;">
        <div class="col-md-12 p-4 ps-md-0">
            <h4 class="mt-0 text-center">
                Что предлагает StyleFriend?</h4>
            <ol class="m-auto" style="font-size: 18px;">
                <li class="list-group-item mb-1"><b>Загрузка одежды:</b> Делитесь своими любимыми вещами, добавляя их фотографии, описание, бренд и цену.</li>
                <li class="list-group-item mb-1"><b>Создание образов:</b> Комбинируйте свои вещи, создавая уникальные и стильные образы, которыми можно гордиться.</li>
                <li class="list-group-item mb-1"><b>Общение с сообществом:</b> Публикуйте свои образы в ленту, получайте отзывы, лайки и комментарии от других модных энтузиастов.</li>
                <li class="list-group-item mb-1"><b>Услуги стилиста:</b> Заказывайте профессиональные услуги стилиста, который поможет вам создать идеальные образы из ваших вещей, подчеркивающие вашу индивидуальность и стиль.</li>
            </ol>
        </div>
    </div>

    <div class="jumbotron text-center d-flex flex-row bg-transparent mt-5 mb-5">

        <div class="brand-logo d-flex align-items-center justify-content-center mb-3">
            <a href="/site/index" class="text-nowrap logo-img">
                <?= Html::img('@web/img/cloth.png', ['style' => 'width: 100px; height: 100px;']) ?>
            </a>
            <p class="display-6">StyleFriend</p>
        </div>

        <p style="font-size: 20px;"><a class="" href="/site/register">Присоединяйтесь к StyleFriend и станьте частью сообщества, где каждый может поделиться своим стилем, вдохновить других и получить профессиональные советы от лучших стилистов. Ваш стиль – ваша индивидуальность, покажите его миру с помощью StyleFriend!</a></p>
    </div>


</div>