<?php
namespace app\models\ar;


use app\components\TransactionTransferException;
use yii\base\Exception;
use yii\db\ActiveRecord;

/**
 * Class Transaction
 * Перевод денеге между счетами
 * @package app\models\ar
 * @property int $id Идентификатор перевода
 * @property string $datetime Дата и время, когда был совершен перевод
 * @property int $from Номер счета, с которого был совершен перевод
 * @property int $to Номер счета, на который был совершен перевод
 * @property float $amount Сумма, которую переводили
 * @property float $tax Размер комиссии, удержанной с отправителя
 */
class Transaction extends ActiveRecord{
    /**
     * Размер комиссии в процентах
     */
    const TAX_PERCENT = 0.0099;

    /**
     * Получает аккаунт, который отправил платеж
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(Account::className(), ['serial' => 'from']);
    }

    /**
     * Получает счет, который принял платеж
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(Account::className(), ['serial' => 'to']);
    }
    
    /** @inheritdoc */
    public static function tableName()
    {
        return 'transactions';
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'id'  => \Yii::t('app','Идентификатор перевода'),
            'datetime' => \Yii::t('app', 'Дата совершения перевода'),
            'from' => \Yii::t('app', 'Счет с которого снимается сумма'),
            'to' => \Yii::t('app', 'Счет, на который производится перевод'),
            'amount' => \Yii::t('app', 'Сумма перевода'),
            'tax' => \Yii::t('app', 'Размер комиссии'),
        ]);
    }

    /** @inheritdoc */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['from', 'to', 'amount'], 'required'],
            [['amount'], 'double'],
            [['from'], 'compare', 'compareAttribute' => 'to', 'operator' => '!=',  'message' => \Yii::t('app', 'Счета должны быть различны')],
            [['to'], 'compare', 'compareAttribute' => 'from', 'operator' => '!=',  'message' => \Yii::t('app', 'Счета должны быть различны')]
        ]);
    }

    /**
     * Производит перевод средств с одного счета на другой
     */
    public function transfer()
    {
        if($this->validate()) {
            $tr = \Yii::$app->db->beginTransaction();
            try {

                $this->tax = $this->amount * self::TAX_PERCENT;
                /** @var Account $sender */
                $sender = $this->getSender()->one();
                $sender->balance -= $this->amount;
                $sender->balance -= $this->tax;
                if (!$sender->save()) {
                    throw new TransactionTransferException(\Yii::t('app', 'Невозмножно сохранить информацию об отправителе'));
                }

                $default = Account::getDefault();
                $default->balance += $this->tax;
                if (!$default->save()) {
                    throw new TransactionTransferException(\Yii::t('app', 'Невозмножно сохранить информацию о зачислении комиссии'));
                }

                /** @var Account $receiver */
                $receiver = $this->getReceiver()->one();
                $receiver->balance += $this->amount;
                if (!$receiver->save()) {
                    throw new TransactionTransferException(\Yii::t('app', 'Невозмножно сохранить информацию о получателе'));
                }

                if (!$this->save()) {
                    throw new TransactionTransferException(\Yii::t('app', 'Невозмножно сохранить информацию о транзакции'));
                }
                $tr->commit();
                return true;
            }catch(Exception $e){
                $tr->rollBack();
                throw $e;
            }
        }
        return false;
    }


}