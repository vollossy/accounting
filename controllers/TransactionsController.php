<?php

namespace app\controllers;


use app\models\ar\Transaction;
use yii\web\Controller;

/**
 * Class TransactionsController
 * @package app\controllers
 * Управление переводами
 *
 */
class TransactionsController extends Controller{
    /**
     * Добавляет запись о переводе в бд
     * todo: можно отрефакторить этот метод, вынеся его в базовый класс, а то тут дублирование кода довольно большое с
     * AccountsController
     */
    public function actionCreate()
    {
        $transaction = new Transaction();

        if(\Yii::$app->request->isPost){
            $transaction->load(\Yii::$app->request->post());
            if($transaction->transfer()){
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Перевод успешно осуществлен'));
            }
        }
        return $this->render('create', array('model' => $transaction));
    }
} 