<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host='.getenv('OPENSHIFT_POSTGRESQL_DB_HOST').';port='.getenv('OPENSHIFT_POSTGRESQL_DB_PORT').';dbname=demo',
    'username' => 'adminvxvkyxx',
    'password' => 'EJT9MwaNpfMm',
    'charset' => 'utf8',
];
