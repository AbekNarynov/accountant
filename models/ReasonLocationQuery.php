<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ReasonLocation]].
 *
 * @see ReasonLocation
 */
class ReasonLocationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ReasonLocation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ReasonLocation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
