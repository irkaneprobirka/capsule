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
        ['label' => 'Регистрация', 'url' => ['/site/register']]
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('admin')) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">Административная панель</p>', 'url' => ['/admin-panel']],
        ['label' => 'rbac', 'url' => ['/rbac/run']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('user')) {
    $navLinks = [
        ['label' => 'Личный кабинет', 'url' => ['/account']],
    ];
} elseif (Yii::$app->user->identity->role_id == Role::getRoleId('stylist')) {
    $navLinks = [
        ['label' => '<p class="btn btn-outline-primary mx-3 mt-2 d-block">стилист</p>', 'url' => ['/stylist']],
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
    <!-- <link rel="shortcut icon" type="image/png" href="../../web//img/Frame 1.png" /> -->

    <!-- <link rel="stylesheet" href="../../web/src/assets/css/styles.min.css" /> -->
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <!--  Body Wrapper -->
    <div class="page">
        <div class="container-xl">
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
                        <?=
                        Yii::$app->user->isGuest
                            ? '<li class="nav-item">' . Html::a(
                                'Авторизация',
                                '/site/login',
                                ['class' => 'nav-link']
                            ) . '</li>'
                            : '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                'Выход (' . Yii::$app->user->identity->login  . ')',
                                ['class' => 'nav-link']
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
                                        <?= Html::a('<i class="ti ti-user fs-6"></i>Галерея вещей', '/account/clothes', ['class' => 'd-flex align-items-center gap-2 dropdown-item']) ?>

                                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hanger"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M14 6a2 2 0 1 0 -4 0c0 1.667 .67 3 2 4h-.008l7.971 4.428a2 2 0 0 1 1.029 1.749v.823a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-.823a2 2 0 0 1 1.029 -1.749l7.971 -4.428" /></svg>
                                        Галерея образов', '/account/look', ['class' => 'd-flex align-items-center gap-2 dropdown-item']) ?>

                                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-box2-heart fs-6" viewBox="0 0 16 16"><path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982Z"/><path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4h-8.5Zm0 1H7.5v3h-6l2.25-3ZM8.5 4V1h3.75l2.25 3h-6ZM15 5v10H1V5h14Z"/></svg> Мои заказы', '/account/order', ['class' => 'd-flex align-items-center gap-2 dropdown-item']) ?>
                                        <!-- 
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Галерея образов</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a> -->
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
        </div>
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
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
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>