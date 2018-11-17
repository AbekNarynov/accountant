<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property string $date Дата создания записи (формат 0000-00-00)
 * @property int $sum Сумма расхода
 * @property int $reason_id Id причины расхода из таблицы "reason"
 * @property int $user_id Id пользователя из таблицы "user"
 * @property int $location_id Id локации из таблицы "location"
 * @property string $description Описание расхода, комментарий
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'sum', 'reason_id', 'user_id', 'location_id'], 'required'],
            [['date'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['sum', 'reason_id', 'user_id', 'location_id'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('expense', 'ID'),
            'date' => Yii::t('expense', 'Date'),
            'sum' => Yii::t('expense', 'Sum'),
            'reason_id' => Yii::t('expense', 'Reason ID'),
            'user_id' => Yii::t('expense', 'User ID'),
            'location_id' => Yii::t('expense', 'Location ID'),
            'description' => Yii::t('expense', 'Description'),
        ];
    }

    /**
     * Get Reason
     * @return \yii\db\ActiveQuery
     */
    public function getReason()
    {
        return $this->hasOne(Reason::className(), ['id' => 'reason_id']);
    }

    /**
     * Get User
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Get Location
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
}
