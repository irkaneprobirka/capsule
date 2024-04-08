<?php

namespace app\modules\admin;

use yii\filters\AccessControl;

/**
 * admin-panel module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                        // 'matchCallback' => fn () => Yii::$app->user->identity->isAdmin
                    ],
                ],
                // 'denyCallback' => fn () => $this->goHome(),
            ],
        ];
    }
}
