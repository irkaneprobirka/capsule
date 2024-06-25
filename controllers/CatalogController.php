<?php

namespace app\controllers;

use app\models\Look;
use app\models\CatalogSearch;
use app\models\Description;
use app\models\LookComment;
use app\models\LookItem;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * CatalogController implements the CRUD actions for Look model.
 */
class CatalogController extends Controller
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
        $searchModel = new CatalogSearch();
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
        $commentModel = new LookComment();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'commentModel' => $commentModel,
        ]);
    }

    public function actionCreateComment($look_id)
    {
        $commentModel = new LookComment();
        $commentModel->look_id = $look_id;

        if ($commentModel->load(Yii::$app->request->post())) {
            $commentModel->user_id = Yii::$app->user->identity->id;
            if ($commentModel->save()) {
                Yii::$app->session->setFlash('success', 'Комментарий добавлен успешно.');
                return $this->redirect(['view', 'id' => $look_id]);
            }
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => LookComment::find()->where(['look_id' => $look_id]),
        ]);

        // Если сохранение не удалось, либо это GET запрос, отобразите форму снова
        return $this->render('create-comment', [
            'model' => $this->findModel($look_id),
            'commentModel' => $commentModel,
            'dataProvider' => $dataProvider,
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


    public function actionPlus($id)
    {
        $modelLook = Look::findOne($id);
        $model = new Look();
        $clothesLook = LookItem::find()->where(['look_id' => $modelLook->id])->all();
        $model->season = Description::findOne($modelLook->description_id)->season_id;
        $model->type = Description::findOne($modelLook->description_id)->type_id;
        $model->age = Description::findOne($modelLook->description_id)->age_id;
        $model->gender = Description::findOne($modelLook->description_id)->gender_id;
        $model->title = $modelLook->title;
        $model->description = $modelLook->description;
        $model->description_id = $modelLook->description_id;
        $model->cost = $modelLook->cost;
        $model->created_at = date('Y-m-d H:i:s', time());
        $model->user_id = Yii::$app->user->id;
        $model->is_copied = 1;
        // VarDumper::dump($model, 10, true);die;
        if ($model->save()) {
            foreach($clothesLook as $val){
                $lookItem = new LookItem();
                $lookItem->look_id = $model->id;
                $lookItem->clothes_id = (int)$val->clothes_id;
                $lookItem->save();
            }
            Yii::$app->session->setFlash('success', 'Образ добавлен!');
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            VarDumper::dump($model->errors, 10, true);
        }
    }
}
