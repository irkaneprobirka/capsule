<?php

namespace app\modules\account\controllers;

use app\models\Clothes;
use app\models\Description;
use app\modules\account\models\ClothesSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * ClothesController implements the CRUD actions for Clothes model.
 */
class ClothesController extends Controller
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
     * Lists all Clothes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClothesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clothes model.
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
     * Creates a new Clothes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Clothes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
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
                if ($model->upload()) {
                    $model->user_id = Yii::$app->user->id;
                    $model->description_id = $descId;
                    if ($model->save(false)) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        VarDumper::dump($model->errors, 10, true);die;
                    }
                }
                else {
                    VarDumper::dump($model->errors, 10, true);die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clothes model.
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
     * Deletes an existing Clothes model.
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
     * Finds the Clothes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Clothes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clothes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
