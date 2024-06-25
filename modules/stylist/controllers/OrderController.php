<?php

namespace app\modules\stylist\controllers;

use app\models\Clothes;
use app\models\Description;
use app\models\Look;
use app\models\LookItem;
use app\models\Order;
use app\modules\account\models\ClothesSearch;
use app\modules\stylist\models\OrderSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDeny($id)
    {
        $model = Order::findOne($id);

        $model->status_id = 2;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Заявка успешно принята в работу');
            return $this->redirect(['index', 'id' => $model->id]);
        }
    }

    public function actionApply($id)
    {
        $model = new Look();
        $modelOrder = Order::findOne($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $description = new Description();
                $description->season_id = $model->season;
                $description->age_id = $model->age;
                $description->gender_id = $model->gender;
                $description->type_id = $model->type;
                if ($description->save()) {
                    $descId = $description->primaryKey;
                } else {
                    VarDumper::dump($description->errors, 10, true);
                    die;
                }
                $model->user_id = $modelOrder->user_id;
                $model->description_id = $descId;
                $clothesIdArray = Yii::$app->request->post('selectedCards');

                if ($model->save()) {
                    $costLook = 0;
                    foreach ($clothesIdArray as $value) {
                        $costLook += Clothes::findOne(['id' => (int)$value])->cost;
                        $lookItem = new LookItem();
                        $lookItem->look_id = $model->id;
                        $lookItem->clothes_id = (int)$value;
                        $lookItem->save();
                    }
                    $model->cost = $costLook;
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Образ создан');
                } else {
                    VarDumper::dump($model->errors, 10, true);
                    die;
                }
                if ($modelOrder->load($this->request->post())) {
                    $modelOrder->status_id = 3;
                    $modelOrder->look_id = $model->primaryKey;
                    VarDumper::dump($modelOrder->answer_stylist, 10, true);
                    if ($modelOrder->save()) {
                        return $this->redirect(['view', 'id' => $modelOrder->id]);
                    } else {
                        VarDumper::dump($modelOrder->errors, 10, true);
                        die;
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('apply', [
            'model' => $model,
            'modelOrder' => $modelOrder,
        ]);
    }



    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
