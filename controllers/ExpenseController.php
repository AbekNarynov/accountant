<?php

namespace app\controllers;

use app\models\Expense;
use app\models\ExpenseSearch;
use app\models\IncomeSearch;
use app\models\Location;
use app\models\Reason;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ExpenseController implements the CRUD actions for Expense model.
 */
class ExpenseController extends Controller
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
     * Lists all Expense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $expenseSum = ExpenseSearch::find()->select(['SUM(`sum`) AS sum'])->one();
        $incomeSum = IncomeSearch::find()->select(['SUM(`sum`) AS sum'])->one();
        $difference = $incomeSum->sum - $expenseSum->sum;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'expenseSum' => $expenseSum->sum,
            'incomeSum' => $incomeSum->sum,
            'difference' => $difference,
        ]);
    }

    /**
     * Displays a single Expense model.
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
     * Creates a new Expense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expense();

        $locations = Location::find()->asArray()->all();
        $locationList = [];
        foreach ($locations as $item) {
            $locationList[$item['id']] = $item['name'];
        }

        $users = User::find()->select(['`id`, `username` as name'])->asArray()->all();
        $userList = [];
        foreach ($users as $item) {
            $userList[$item['id']] = $item['name'];
        }

        $reasons = Reason::find()->asArray()->all();
        $reasonList = [];
        foreach ($reasons as $item) {
            $reasonList[$item['id']] = $item['name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $locationList,
            'user' => $userList,
            'reason' => $reasonList,
        ]);
    }

    /**
     * Updates an existing Expense model.
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

        $users = User::find()->select(['id, `username` as name'])->asArray()->all();
        $userList = [];
        foreach ($users as $item) {
            $userList[$item['id']] = $item['name'];
        }

        $reasons = Reason::find()->asArray()->all();
        $reasonList = [];
        foreach ($reasons as $item) {
            $reasonList[$item['id']] = $item['name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'location' => $locationList,
            'user' => $userList,
            'reason' => $reasonList,
        ]);
    }

    /**
     * Deletes an existing Expense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Get Locations By Reason Id
     * @return string
     */
    public function actionGetLocationsByReasonId()
    {
        $reason = Reason::findOne(Yii::$app->request->post('reasonId'));
        $locations = $reason->getLocations()->asArray()->all();

        if (!empty($locations)) {
            $locations = ArrayHelper::map($locations, 'id', 'name');
        } else {
            $locations = Location::find()->asArray()->all();
            $locations = ArrayHelper::map($locations, 'id', 'name');
        }

        return json_encode($locations, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Finds the Expense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expense::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
