<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m140725_051529_init_db
 * Инициализирует бд с основными таблицами
 */
class m140725_051529_init_db extends Migration
{
    public function safeUp()
    {
        $this->createTable('accounts', [
            'client' => 'string NOT NULL',
            'serial' => 'int NOT NULL',
            'balance' => 'money NOT NULL DEFAULT 0',
        ]);
        $this->addPrimaryKey('pk_serial', 'accounts', 'serial');
        $this->insert('accounts', ['client' => 'Наша фирма', 'serial' => 0]);
    }

    public function safeDown()
    {
        $this->dropTable('accounts');
    }
}
