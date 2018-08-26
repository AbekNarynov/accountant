<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name Имя пользователя
 * @property string $surname Фамилия пользователя
 * @property string $middle_name Отчество пользователя
 * @property string $email Электронная почта пользователя, одновременно логин (уникальное значение)
 * @property string $password Пароль пользователя
 * @property string $datetime Дата и время создания записи (формат 0000-00-00 00:00:00)
 * @property int $is_active Активность пользователя
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'datetime'], 'required'],
            [['datetime'], 'safe'],
            [['is_active'], 'integer'],
            [['name', 'surname', 'middle_name', 'email', 'password'], 'string', 'max' => 255],
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
            'surname' => Yii::t('app', 'Surname'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'datetime' => Yii::t('app', 'Datetime'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }
}
