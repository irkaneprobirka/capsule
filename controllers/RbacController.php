<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class RbacController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['run'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn () => Yii::$app->user->identity->isAdmin
                    ],
                ],
                'denyCallback' => fn () => $this->goHome(),
            ],
        ];
    }

    public function actionRun()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $admin->description = 'Роль администратора';
        $auth->add($admin);

        $stylist = $auth->createRole('stylist');
        $stylist->description = 'Роль стилиста';
        $auth->add($stylist);

        $client = $auth->createRole('client');
        $client->description = 'Роль пользователя';
        $auth->add($client);

        $canAdmin = $auth->createPermission('canAdmin');
        $canAdmin->description = 'Админ может все';
        $auth->add($canAdmin);

        $canStylist = $auth->createPermission('canStylist');
        $canStylist->description = 'Стилист может почти все';
        $auth->add($canStylist);
        
        $canClient = $auth->createPermission('canClient');
        $canClient->description = 'Клиент может не все';
        $auth->add($canClient);

        $auth->addChild($admin, $canAdmin);
        $auth->addChild($client, $canClient);
        $auth->addChild($stylist, $canStylist);

        $auth->assign($admin, User::findByUsername('admin')->id);
        $auth->assign($client, User::findByUsername('123')->id);
        $auth->assign($stylist, User::findByUsername('stylist')->id);

        echo 'ok';
        die;
    }
}
