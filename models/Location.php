<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $name Наименование местоположения
 * @property string $datetime Дата и время создания записи (формат 0000-00-00 00:00:00)
 * @property string $address Адрес локации
 * @property string $description Описание местоположения, комментарий
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['datetime'], 'safe'],
            [['datetime'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['datetime'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['description'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'datetime' => Yii::t('app', 'Datetime'),
            'address' => Yii::t('app', 'Address'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
