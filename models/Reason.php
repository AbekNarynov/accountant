<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reason".
 *
 * @property int $id
 * @property string $name Наименование причины расхода
 * @property int $user_id Id пользователя из таблицы "user"
 * @property string $datetime Дата и время создания записи (формат 0000-00-00 00:00:00)
 * @property string $description Описание причины расхода, комментарий
 * @property int $is_regular Является ли расход регулярным из месяца в месяц
 */
class Reason extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reason';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'is_regular'], 'required'],
            [['user_id', 'is_regular'], 'integer'],
            [['datetime'], 'safe'],
            [['datetime'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['datetime'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'datetime' => Yii::t('app', 'Datetime'),
            'description' => Yii::t('app', 'Description'),
            'is_regular' => Yii::t('app', 'Is Regular'),
        ];
    }

    /**
     * Get Locations
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['id' => 'location_id'])
            ->viaTable('reason_location', ['reason_id' => 'id']);
    }
}
