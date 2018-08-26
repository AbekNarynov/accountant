<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property int $id
 * @property string $date Дата создания записи (формат 0000-00-00)
 * @property int $sum Сумма дохода
 * @property int $source_id Id источника дохода из таблицы "source"
 * @property int $user_id Id пользователя из таблицы "user"
 * @property int $location_id Id локации из таблицы "location"
 * @property string $description Описание дохода, комментарий
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'sum', 'source_id', 'user_id', 'location_id'], 'required'],
            [['date'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['sum', 'source_id', 'user_id', 'location_id'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('income', 'ID'),
            'date' => Yii::t('income', 'Date'),
            'sum' => Yii::t('income', 'Sum'),
            'source_id' => Yii::t('income', 'Source ID'),
            'user_id' => Yii::t('income', 'User ID'),
            'location_id' => Yii::t('income', 'Location ID'),
            'description' => Yii::t('income', 'Description'),
        ];
    }
}