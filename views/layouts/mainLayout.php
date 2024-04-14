<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\Role;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\VarDumper;

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

$navLinks;

if (Yii::$app->user->isGuest) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">Регистрация</p>', 'url' => ['/site/register']]
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('admin')) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">Административная панель</p>', 'url' => ['/admin-panel']],
        ['label' => 'rbac', 'url' => ['/rbac/run']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('user')) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">Личный кабинет</p>', 'url' => ['/account']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('stylist')) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">Какая-то неготовая хрень</p>', 'url' => ['/account']],
    ];
}

AppAsset::register($this);

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
    <link rel="shortcut icon" type="image/png" href="../../web/src/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../web/src/assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar rounded-end rounded-3">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="../site/" class="text-nowrap logo-img">
                        <h2>My Wardrobe</h2>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <?=
                        Yii::$app->user->isGuest
                            ? Html::a(
                                'Авторизация',
                                '/site/login',
                                ['class' => 'btn btn-outline-primary mx-3 mt-2 d-block']
                            )
                            : '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                'Выход (' . Yii::$app->user->identity->login  . ')',
                                ['class' => 'btn btn-outline-primary mx-3 mt-2 d-block']
                            )
                            . Html::endForm()
                            . '</li>'
                        ?>
                        <?php
                        $getNavLinks = function ($navLinks) {
                            $string = '';
                            if (!is_null($navLinks)) {
                                # code...
                                foreach ($navLinks as $value) {
                                    $string .=  "<li class='nav-item'>
                                    <a class='nav-link' href=" . $value['url'][0] . ">" . $value['label'] . "</a>
                                    </li>";
                                }
                            }
                            return $string;
                        };
                        ?>
                        <?= $getNavLinks($navLinks) ?>
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
                <nav class="navbar navbar-expand-lg navbar-light">
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
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= !Yii::$app->user->isGuest
                                        ? Html::img('@web/img/' . $userImage, ['style' => 'height: 45px; width: 45px;', 'class' => 'rounded-circle'])
                                        : '<img src="../../web/src/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">';
                                    ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Галерея вещей</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Галерея образов</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <?=
                                        Yii::$app->user->isGuest
                                            ? Html::a(
                                                'Авторизация',
                                                '/site/login',
                                                ['class' => 'btn btn-outline-primary mx-3 mt-2 d-block']
                                            )
                                            :  Html::beginForm(['/site/logout'])
                                            . Html::submitButton(
                                                'Выход (' . Yii::$app->user->identity->login  . ')',
                                                ['class' => 'btn btn-outline-primary mx-3 mt-2 d-block']
                                            )
                                            . Html::endForm()
                                        ?>
                                        <!-- <a href="../../web/src/html/authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Выход</a> -->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
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
    <script src="../../web/src/assets/js/dashboard.js"></script>
</body>

</html>