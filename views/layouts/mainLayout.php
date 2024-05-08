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

// if(Yii::$app->user == null){
//     echo 'мяу';
// }else{
//     $userId = Yii::$app->user->identity->id;
//     $userImage = User::findOne($userId)->image_profile;
// }

if (!Yii::$app->user->isGuest) {
    $userId = Yii::$app->user->identity->id;
    $user = User::findOne($userId);
    if ($user) {
        $userImage = $user->image_profile;
    } else {
        // Обработка ситуации, когда пользователь не найден
    }
} else {
    // Обработка ситуации, когда пользователь не аутентифицирован
}

// $arrNotification = [];
// $newNotification = LookComment::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy('id DESC')->one();
// array_push($arrNotification, $newNotification);
// // foreach ($arrNotification as $key => $value){
// //     return VarDumper::dump($value->created_at, 10, true);die;

// // }
// VarDumper::dump($new, 10, true); die;

$navLinks;

if (Yii::$app->user->isGuest) {
    $navLinks = [
        ['label' => '<i class="ti ti-user-plus"></i>Регистрация', 'url' => ['/site/register']]
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('admin')) {
    $navLinks = [
        ['label' => '<i class="ti ti-mood-happy"></i>Административная панель', 'url' => ['/admin-panel']],
        ['label' => 'rbac', 'url' => ['/rbac/run']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('user')) {
    $navLinks = [
        ['label' => '<i class="ti ti-mood-happy"></i>Галерея вещей', 'url' => ['/account/clothes']],
        ['label' => '<i class="ti ti-mood-happy"></i>Галерея образов', 'url' => ['/account/look']],
        ['label' => ' <i class="ti ti-file-description"></i>Мои заказы', 'url' => ['/account/order']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('stylist')) {
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
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>

<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YourWardrobe</title>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet"> -->
    <!-- <link rel="shortcut icon" type="image/png" href="../../web//img/Frame 1.png" /> -->

    <!-- <link rel="stylesheet" href="../../web/src/assets/css/styles.min.css" /> -->
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar rounded-end rounded-3 ">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="../site/" class="text-nowrap logo-img m-auto">
                        <? Html::img('@web/img/Frame 1.png', ['style' => 'width: 150px; height: 150px;', 'class' => 'm-0']) ?>
                        <h3>Shкаф</h3>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar d-flex justify-content-center" data-simplebar="">
                    <ul id="sidebarnav d-flex justify-content-center">
                        <a class="nav-link d-flex justify-content-center" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= !Yii::$app->user->isGuest
                                ? Html::img('@web/img/' . $userImage, ['style' => 'height: 70px; width: 70px;', 'class' => 'user-image rounded-circle'])
                                : '<img src="../../web/src/assets/images/profile/user-1.jpg" alt="" width="70" height="70" class="rounded-circle">';
                            ?>
                        </a>
                        <a class="nav-link d-flex justify-content-center mt-1 " id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= !Yii::$app->user->isGuest
                                ? '<p class="hide-menu">' . $user->login  . '</p>'
                                : '<span class="hide-menu">Войдите в аккаунт</span>';
                            ?>
                        </a>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Главная страница</span>
                        </li>
                        <li class="sidebar-item">
                            <?= Html::a('<i class="ti ti-layout-dashboard"></i>Лента образов', '/catalog', ['class' => 'sidebar-link']) ?>
                            <!-- <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Лента образов</span>
                            </a> -->
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Личный кабинет</span>
                        </li>
                        <?php
                        $getNavLinks = function ($navLinks) {
                            $string = '';
                            if (!is_null($navLinks)) {
                                # code...
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
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
            <!--  Header End -->
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