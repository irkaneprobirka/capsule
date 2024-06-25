<?php

namespace app\modules\stylist;

use Yii;
use yii\filters\AccessControl;

/**
 * stylist module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\stylist\controllers';

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
                        'roles' => ['@'],
                        'matchCallback' => fn() => Yii::$app->user->can('canStylist')
                    ],
                ],
                'denyCallback' => fn() => Yii::$app->response->redirect('/')
            ],
        ];
    }
}
