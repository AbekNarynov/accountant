<?php

namespace app\controllers;

use app\models\Location;
use app\models\Reason;
use app\models\ReasonLocation;
use app\models\ReasonLocationSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ReasonLocationController implements the CRUD actions for ReasonLocation model.
 */
class ReasonLocationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReasonLocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReasonLocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReasonLocation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReasonLocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReasonLocation();

        $reason = Reason::find()->asArray()->all();
        $reason = ArrayHelper::map($reason, 'id', 'name');

        $busyLocations = ReasonLocation::find()->select('location_id')->distinct()->asArray()->all();
        $locations = [];
        foreach ($busyLocations as $busyLocation) {
            $locations[] = $busyLocation['location_id'];
        }
        $location = Location::find()->where(['not in', 'id', $locations])->asArray()->all();
        $location = ArrayHelper::map($location, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['reason-location/create']);
        }

        return $this->render('create', [
            'model' => $model,
            'reason' => $reason,
            'location' => $location,
        ]);
    }

    /**
     * Updates an existing ReasonLocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $reason = ArrayHelper::map(Reason::find()->asArray()->all(), 'id', 'name');
        $location = ArrayHelper::map(Location::find()->asArray()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'reason' => $reason,
            'location' => $location,
        ]);
    }

    /**
     * Deletes an existing ReasonLocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReasonLocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReasonLocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReasonLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('reason_location', 'The requested page does not exist.'));
    }
}
