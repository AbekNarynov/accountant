<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reason_location".
 *
 * @property int $id
 * @property int $reason_id Причина расхода
 * @property int $location_id Местоположение
 */
class ReasonLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reason_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reason_id', 'location_id'], 'required'],
            [['reason_id', 'location_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('reason_location', 'ID'),
            'reason_id' => Yii::t('reason_location', 'Причина расхода'),
            'location_id' => Yii::t('reason_location', 'Местоположение'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReasonLocationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReasonLocationQuery(get_called_class());
    }
}
