<?php

use yii\db\Migration;

/**
 * Class m180823_210326_alter_table
 */
class m180823_210326_alter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->dropIndex(
//            'email',
//            'user'
//        );
//
//        $this->createIndex(
//            'email',
//            'user',
//            'email',
//            true
//        );

        $this->dropColumn(
            'expense',
            'is_regular'
        );

        $this->dropColumn(
            'income',
            'is_regular'
        );

        $this->addColumn(
            'reason',
            'is_regular',
            'SMALLINT NOT NULL COMMENT "Является ли расход регулярным из месяца в месяц"'
        );

        $this->addColumn(
            'source',
            'is_regular',
            'SMALLINT NOT NULL COMMENT "Является ли расход регулярным из месяца в месяц"'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropIndex(
//            'email',
//            'user'
//        );
//
//        $this->createIndex(
//            'email',
//            'user',
//            'email'
//        );

        $this->addColumn(
            'expense',
            'is_regular',
            'SMALLINT NOT NULL COMMENT "Является ли расход регулярным из месяца в месяц"'
        );

        $this->addColumn(
            'income',
            'is_regular',
            'SMALLINT NOT NULL COMMENT "Является ли доход регулярным из месяца в месяц"'
        );

        $this->dropColumn(
            'reason',
            'is_regular'
        );

        $this->dropColumn(
            'source',
            'is_regular'
        );
    }
}
