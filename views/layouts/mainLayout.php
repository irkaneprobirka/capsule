<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\MainAppAsset;
use app\models\LookComment;
use app\models\Role;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\JqueryAsset;

if (!Yii::$app->user->isGuest) {
    $userId = Yii::$app->user->identity->id;
    $user = User::findOne($userId);
    if ($user) {
        $userImage = $user->image_profile;
    }
}
// VarDumper::dump($user->rbac_role, 10, true);die;

$navLinks = [];

if (Yii::$app->user->isGuest) {
    $navLinks = [
        ['label' => '<i class="ti ti-user-plus"></i>Регистрация', 'url' => ['/site/register']]
    ];
} elseif (Yii::$app->user->can('canAdmin')) {
    $navLinks = [
        ['label' => '<i class="ti ti-settings"></i>Административная панель', 'url' => ['/admin-panel']],
        // ['label' => 'rbac', 'url' => ['/rbac/run']],
    ];
} elseif (Yii::$app->user->can('canClient')) {
    $navLinks = [
        ['label' => '<i class="ti ti-mood-happy"></i>Галерея вещей', 'url' => ['/account/clothes']],
        ['label' => '<i class="ti ti-album"></i>Галерея образов', 'url' => ['/account/look']],
        ['label' => ' <i class="ti ti-file-description"></i>Мои заказы', 'url' => ['/account/order']],
    ];
} elseif (Yii::$app->user->can('canStylist')) {
    $navLinks = [
        ['label' => '<i class="ti ti-file-description"></i>Управление заказами', 'url' => ['/stylist/order']],
    ];
}

MainAppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/img/fav.ico')]);
?>
<?php $this->beginPage() ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StyleFriend</title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-center border-bottom mb-3">
                    <a href="/site/index" class="text-nowrap logo-img">
                        <?= Html::img('@web/img/cloth.png', ['style' => 'width: 60px; height: 60px;']) ?>
                    </a>
                    <h4 class="mx-2 fw-bold">StyleFriend</h4>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar d-flex justify-content-center" data-simplebar="">
                    <ul id="sidebarnav d-flex justify-content-center">
                        <a class="nav-link d-flex justify-content-center" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= !Yii::$app->user->isGuest
                                ? Html::img('@web/img/' . $userImage, ['style' => 'height: 70px; width: 70px;', 'class' => 'user-image rounded-circle'])
                                : '<img src="../../web/src/assets/images/profile/user-1.jpg" alt="" width="70" height="70" class="rounded-circle user-image">';
                            ?>
                        </a>
                        <a class="nav-link d-flex justify-content-center mt-1 " id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= !Yii::$app->user->isGuest
                                ? '<p class="badge rounded-pill d-flex justify-content-center m-auto" style="width:6rem; color:white; background: #88a2ea;">' . $user->login  . '</p>'
                                : '<a href="/site/login" class="badge rounded-pill d-flex justify-content-center m-auto" style="width:8rem; color:white; background: #88a2ea;">Войти в аккаунт</a>';
                            ?>
                        </a>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Главная страница</span>
                        </li>
                        <li class="sidebar-item">
                            <?= Html::a('<i class="ti ti-home-star"></i>О проекте', '/site/index', ['class' => 'sidebar-link']) ?>
                        </li>
                        <li class="sidebar-item">
                            <?= Html::a('<i class="ti ti-layout-dashboard"></i>Лента образов', '/catalog', ['class' => 'sidebar-link']) ?>
                        </li>
                        
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Личный кабинет</span>
                        </li>
                        <?php
                        $getNavLinks = function ($navLinks) {
                            $string = '';
                            if (!is_null($navLinks)) {
                                foreach ($navLinks as $value) {
                                    $string .=  "<li class='sidebar-item'>
                                    <a class='sidebar-link' aria-expanded='false' href=" . $value['url'][0] . ">" . $value['label'] . "</a>
                                    </li>";
                                }
                            }
                            return $string;
                        };
                        ?>
                        <?= $getNavLinks($navLinks) ?>
                        <?=
                        Yii::$app->user->isGuest
                            ? '<li class="sidebar-item">'
                            . Html::a(
                                '<i class="ti ti-login"></i>Авторизация',
                                '/site/login',
                                ['class' => 'sidebar-link']
                            ) . '</li>'
                            : '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                'Выход (' . Yii::$app->user->identity->login  . ')',
                                ['class' => 'btn btn-primary mx-3 mt-2 d-block w-75']
                            )
                            . Html::endForm()
                            . '</li>'
                        ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="body-wrapper">
            <header class="app-header border-bottom">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between">
                    <div class="brand-logo d-none align-items-center justify-content-center mobile-only">
                        <a href="/site/index" class="text-nowrap logo-img">
                            <?= Html::img('@web/img/cloth.png', ['style' => 'width: 60px; height: 60px;']) ?>
                        </a>
                        <h4 class="mx-2 fw-bold">StyleFriend</h4>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="container-xl">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
    <script src="../../web/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../web/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../web/src/assets/js/sidebarmenu.js"></script>
    <script src="../../web/src/assets/js/app.min.js"></script>
    <script src="../../web/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../web/src/assets/libs/simplebar/dist/simplebar.js"></script>
    <?php $this->registerCssFile('@web/css/nav.css', ['depends' => [JqueryAsset::class]]) ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
