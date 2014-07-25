<?php
namespace app\components;

use app\models\ar\Account;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class AccountQuery
 * Представляет собой запрос со специфичными для счетов методами
 * @package app\components
 */
class AccountQuery extends ActiveQuery{

    /**
     * Получает условие для всех счетов кроме дефолтного
     * @return $this
     */
    public function notUs()
    {
        $this->where('serial != 0');
        return $this;
     }

    /**
     * получает все записи счетов для вставки в выпадающие списки
     * @return array
     */
    public function allForDropDown()
    {
        return ArrayHelper::map($this->all(), 'serial' , function(Account $data){
            return $data->client.':'.$data->serial;
        });
    }
} 