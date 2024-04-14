<?php

namespace app\modules\account\controllers;

use app\models\Clothes;
use app\models\Description;
use app\models\Look;
use app\models\LookItem;
use app\modules\account\models\ClothesSearch;
use app\modules\account\models\LookSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * LookController implements the CRUD actions for Look model.
 */
class LookController extends Controller
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
     * Lists all Look models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Look model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Look model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Look();
        $searchModel = new LookSearch();
        $searchModelClothes = new ClothesSearch();
        $dataProvider = $searchModelClothes->search($this->request->queryParams);

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
                $model->user_id = Yii::$app->user->id;
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
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    VarDumper::dump($model->errors, 10, true);
                    die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Look model.
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
     * Deletes an existing Look model.
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
     * Finds the Look model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Look the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Look::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
