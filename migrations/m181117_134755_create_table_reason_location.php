<?php

use yii\db\Migration;

/**
 * Class m181117_134755_create_table_reason_location
 */
class m181117_134755_create_table_reason_location extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        // Создание таблицы "reason_location"
        $this->createTable('reason_location', [
            'id' => $this->primaryKey(),
            'reason_id' => $this->integer()->notNull()->comment('Причина расхода'),
            'location_id' => $this->integer()->notNull()->comment('Местоположение'),
        ], 'ENGINE InnoDB DEFAULT CHARSET=utf8 COMMENT="Связка многие ко многим: reason - location"');

        // Внесение данных в таблицу "reason_location"
        $this->batchInsert(
            'reason_location',
            [
                'id',
                'reason_id',
                'location_id',
            ],
            [
                [null, '1', '7'],
                [null, '1', '12'],
                [null, '11', '11'],
                [null, '11', '2'],
                [null, '11', '3'],
                [null, '4', '1'],
                [null, '1', '4'],
                [null, '11', '5'],
                [null, '2', '8'],
                [null, '4', '9'],
                [null, '4', '10'],
                [null, '5', '13'],
                [null, '11', '17'],
                [null, '11', '18'],
                [null, '11', '21'],
                [null, '11', '23'],
                [null, '11', '25'],
                [null, '11', '32'],
                [null, '2', '14'],
                [null, '5', '15'],
                [null, '6', '16'],
                [null, '6', '65'],
                [null, '18', '19'],
                [null, '18', '20'],
                [null, '7', '22'],
                [null, '7', '40'],
                [null, '8', '27'],
                [null, '1', '24'],
                [null, '1', '26'],
                [null, '1', '28'],
                [null, '1', '29'],
                [null, '1', '30'],
                [null, '12', '35'],
                [null, '9', '31'],
                [null, '10', '33'],
                [null, '10', '38'],
                [null, '18', '34'],
                [null, '18', '39'],
                [null, '13', '36'],
                [null, '12', '41'],
                [null, '11', '42'],
                [null, '18', '44'],
                [null, '14', '37'],
                [null, '16', '43'],
                [null, '11', '45'],
                [null, '1', '46'],
                [null, '1', '47'],
                [null, '11', '48'],
                [null, '11', '50'],
                [null, '7', '51'],
                [null, '9', '49'],
                [null, '14', '52'],
                [null, '16', '53'],
                [null, '10', '54'],
                [null, '16', '57'],
                [null, '1', '55'],
                [null, '15', '56'],
                [null, '15', '68'],
                [null, '15', '74'],
                [null, '13', '58'],
                [null, '18', '59'],
                [null, '13', '60'],
                [null, '14', '62'],
                [null, '18', '63'],
                [null, '4', '64'],
                [null, '11', '61'],
                [null, '11', '69'],
                [null, '11', '70'],
                [null, '11', '72'],
                [null, '11', '73'],
                [null, '11', '75'],
                [null, '18', '76'],
                [null, '18', '67'],
                [null, '17', '71'],
                [null, '1', '66'],
            ]
        );
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        // Удаление таблицы "reason_location"
        $this->dropTable('reason_location');
    }
}
