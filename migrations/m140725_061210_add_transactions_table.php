<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m140725_061210_add_transactions_table
 * Добавляет таблицу для работы с транзакциями
 */
class m140725_061210_add_transactions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('transactions', [
            'id' => 'pk',
            'datetime' => 'timestamp without time zone NOT NULL DEFAULT CURRENT_DATE',
            'from' => 'int NOT NULL',
            'to' => 'int NOT NULL',
            'amount' => 'money NOT NULL',
            'tax' => 'money NOT NULL'
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('transactions');
    }
}
