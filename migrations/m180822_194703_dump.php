<?php

use yii\db\Migration;

/**
 * Команда для миграции:
 * /opt/php5.6/bin/php yii migrate
 *
 * Class m180822_194703_dump
 */
class m180822_194703_dump extends Migration
{
    /**
     * {@inheritdoc}
     * @return bool|void
     */
    public function safeUp()
    {
//        // Структура таблицы `user`
//        $this->createTable('user', [
//            'id' => $this->primaryKey(),
//            'name' => $this->string()->comment('Имя пользователя'),
//            'surname' => $this->string()->comment('Фамилия пользователя'),
//            'middle_name' => $this->string()->comment('Отчество пользователя'),
//            'email' => $this->string()->notNull()->comment('Электронная почта пользователя, одновременно логин (уникальное значение)'),
//            'password' => $this->string()->notNull()->comment('Пароль пользователя'),
//            'datetime' => $this->dateTime()->notNull()->comment('Дата и время создания записи (формат 0000-00-00 00:00:00)'),
//            'is_active' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Активность пользователя'),
//        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица пользователей"');
//
//        $this->createIndex(
//            'email',
//            'user',
//            'email'
//        );

        // Структура таблицы `expense`
        $this->createTable('expense', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull()->comment('Дата создания записи (формат 0000-00-00)'),
            'sum' => $this->integer()->notNull()->comment('Сумма расхода'),
            'reason_id' => $this->integer()->notNull()->comment('Id причины расхода из таблицы "reason"'),
            'user_id' => $this->integer()->notNull()->comment('Id пользователя из таблицы "user"'),
            'location_id' => $this->integer()->notNull()->comment('Id локации из таблицы "location"'),
            'is_regular' => $this->smallInteger()->notNull()->comment('Является ли расход регулярным из месяца в месяц'),
            'description' => $this->text()->comment('Описание расхода, комментарий'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица расходов пользователя"');

        $this->createIndex(
            'user_id',
            'expense',
            'user_id'
        );

        // Структура таблицы `income`
        $this->createTable('income', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull()->comment('Дата создания записи (формат 0000-00-00)'),
            'sum' => $this->integer()->notNull()->comment('Сумма дохода'),
            'source_id' => $this->integer()->notNull()->comment('Id источника дохода из таблицы "source"'),
            'user_id' => $this->integer()->notNull()->comment('Id пользователя из таблицы "user"'),
            'location_id' => $this->integer()->notNull()->comment('Id локации из таблицы "location"'),
            'is_regular' => $this->smallInteger()->notNull()->comment('Является ли доход регулярным из месяца в месяц'),
            'description' => $this->text()->comment('Описание дохода, комментарий'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица доходов пользователя"');

        $this->createIndex(
            'user_id',
            'income',
            'user_id'
        );

        // Структура таблицы `location`
        $this->createTable('location', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Наименование местоположения'),
            'datetime' => $this->dateTime()->notNull()->comment('Дата и время создания записи (формат 0000-00-00 00:00:00)'),
            'address' => $this->string()->comment('Адрес локации'),
            'description' => $this->text()->comment('Описание местоположения, комментарий'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица местоположений"');

        // Структура таблицы `reason`
        $this->createTable('reason', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Наименование причины расхода'),
            'user_id' => $this->integer()->notNull()->comment('Id пользователя из таблицы "user"'),
            'datetime' => $this->dateTime()->notNull()->comment('Дата и время создания записи (формат 0000-00-00 00:00:00)'),
            'description' => $this->text()->comment('Описание причины расхода, комментарий'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица наименований расходов"');

        $this->createIndex(
            'user_id',
            'reason',
            'user_id'
        );

        // Структура таблицы `source`
        $this->createTable('source', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Наименование источника дохода'),
            'user_id' => $this->integer()->notNull()->comment('Id пользователя из таблицы "user"'),
            'datetime' => $this->dateTime()->notNull()->comment('Дата и время создания записи (формат 0000-00-00 00:00:00)'),
            'description' => $this->text()->comment('Описание источника дохода, комментарий'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Таблица источников дохода"');

        $this->createIndex(
            'user_id',
            'source',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     * @return bool|void
     */
    public function safeDown()
    {
//        $this->dropTable('user');
        $this->dropTable('expense');
        $this->dropTable('income');
        $this->dropTable('location');
        $this->dropTable('reason');
        $this->dropTable('source');
    }
}