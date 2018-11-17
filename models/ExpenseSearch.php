<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\data\Sort;

/**
 * ExpenseSearch represents the model behind the search form of `app\models\Expense`.
 */
class ExpenseSearch extends Expense
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sum', 'reason_id', 'user_id', 'location_id'], 'integer'],
            [['date', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param $params
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $query = Expense::find();

        $this->load($params);

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'sum' => $this->sum,
            'reason_id' => $this->reason_id,
            'user_id' => $this->user_id,
            'location_id' => $this->location_id,
        ]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->orderBy([
            'date' => SORT_DESC,
            'id' => SORT_DESC,
        ]);
        $query = $query->all();

        $expenseArray = [];
        foreach ($query as $key => $item) {
            $expenseArray[] = [
                'id' => $item->id,
                'date' => $item->date,
                'sum' => $item->sum,
                'reason_id' => ($item->getReason()->select('name')->asArray()->one())['name'],
                'user_id' => ($item->getUser()->select('username')->asArray()->one())['username'],
                'location_id' => ($item->getLocation()->select('name')->asArray()->one())['name'],
                'description' => $item->description,
            ];
        }

        $sort = new Sort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Id',
                ],
                'date' => [
                    'asc' => ['date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Date',
                ],
                'sum' => [
                    'asc' => ['sum' => SORT_ASC, 'date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['sum' => SORT_DESC, 'date' => SORT_ASC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Sum',
                ],
                'reason_id' => [
                    'asc' => ['reason_id' => SORT_ASC, 'date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['reason_id' => SORT_DESC, 'date' => SORT_ASC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'reason_id',
                ],
                'user_id' => [
                    'asc' => ['user_id' => SORT_ASC, 'date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['user_id' => SORT_DESC, 'date' => SORT_ASC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'user_id',
                ],
                'location_id' => [
                    'asc' => ['location_id' => SORT_ASC, 'date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['location_id' => SORT_DESC, 'date' => SORT_ASC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'location_id',
                ],
                'description' => [
                    'asc' => ['description' => SORT_ASC, 'date' => SORT_ASC, 'id' => SORT_ASC],
                    'desc' => ['description' => SORT_DESC, 'date' => SORT_ASC, 'id' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Description',
                ],
            ],
        ]);

        $dataProvider = new ArrayDataProvider ([
            'allModels' => $expenseArray,
            'sort' => $sort,
        ]);

        return $dataProvider;
    }
}
