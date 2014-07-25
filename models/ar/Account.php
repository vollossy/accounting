<?php
namespace app\models\ar;

use app\components\AccountQuery;
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

    /**
     * @var Account Системный счет, куда переводятся средства от комиссий
     */
    protected static $_defaultAccount;

    /**
     * Функция-геттер для системного счета
     * @return Account
     */
    public static function getDefault()
    {
        if(!isset(self::$_defaultAccount)){
            self::$_defaultAccount = Account::findOne(0);
        }
        return self::$_defaultAccount;
    }

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

    public static function find()
    {
        return new AccountQuery(get_called_class());
    }

    /** @inheritdoc */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['client','serial', 'balance'], 'required'],
            [['serial'], 'integer'],
            [['serial'], 'unique'],
            [['balance'], 'double']
        ]);
    }


}