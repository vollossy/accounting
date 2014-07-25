<?php
namespace app\models\ar;

use yii\db\ActiveRecord;

/**
 * Class Account
 * @package app\models\ar
 * Представляет собой модель для таблицы accounts
 * @property string $client Название клиента
 * @property int $serial Номер счета, системный счет имеет значение 0
 * @property float $balance Остаток на счете клиента
 */
class Account extends ActiveRecord{

    /** @inheritdoc */
    public static function tableName()
    {
        return 'accounts';
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'client' => \Yii::t('app', 'Название клиента'),
            'serial' => \Yii::t('app', 'Номер счета'),
            'balance' => \Yii::t('app', 'Баланс счета'),
        ]);
    }

    /** @inheritdoc */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['client','serial', 'balance'], 'required'],
            [['serial'], 'integer'],
            [['balance'], 'double']
        ]);
    }


}