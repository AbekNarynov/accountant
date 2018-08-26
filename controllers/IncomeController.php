<?php

namespace app\controllers;

use app\models\Income;
use app\models\IncomeSearch;
use app\models\Location;
use app\models\Source;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * IncomeController implements the CRUD actions for Income model.
 */
class IncomeController extends Controller
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
     * Lists all Income models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $incomeSum = IncomeSearch::find()->select(['SUM(`sum`) AS sum'])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'incomeSum' => $incomeSum->sum,
        ]);
    }

    /**
     * Displays a single Income model.
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
     * Creates a new Income model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Income();

        $locations = Location::find()->asArray()->all();
        $locationList = [];
        foreach ($locations as $item) {
            $locationList[$item['id']] = $item['name'];
        }

        $users = User::find()->select(['id, CONCAT(`name`, " ", `surname`, " ", `middle_name`) as name'])->asArray()->all();
        $userList = [];
        foreach ($users as $item) {
            $userList[$item['id']] = $item['name'];
        }

        $sources = Source::find()->asArray()->all();
        $sourceList = [];
        foreach ($sources as $item) {
            $sourceList[$item['id']] = $item['name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $locationList,
            'user' => $userList,
            'source' => $sourceList,
        ]);
    }

    /**
     * Updates an existing Income model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $locations = Location::find()->asArray()->all();
        $locationList = [];
        foreach ($locations as $item) {
            $locationList[$item['id']] = $item['name'];
        }

        $users = User::find()->select(['id, CONCAT(`name`, " ", `surname`, " ", `middle_name`) as name'])->asArray()->all();
        $userList = [];
        foreach ($users as $item) {
            $userList[$item['id']] = $item['name'];
        }

        $sources = Source::find()->asArray()->all();
        $sourceList = [];
        foreach ($sources as $item) {
            $sourceList[$item['id']] = $item['name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'location' => $locationList,
            'user' => $userList,
            'source' => $sourceList,
        ]);
    }

    /**
     * Deletes an existing Income model.
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
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Income::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
