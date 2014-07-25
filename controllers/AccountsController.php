<?php
namespace app\controllers;


use app\models\ar\Account;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер для работы со счетами
 */
class AccountsController extends Controller{

    /**
     * Добавляет запись о счете в бд
     */
    public function actionCreate()
    {
        $account = new Account();

        if(\Yii::$app->request->isPost){
            $account->load(\Yii::$app->request->post());
            if($account->save()){
                return \Yii::$app->response->redirect(['/accounts/view', 'id' => $account->serial]);
            }
        }
        return $this->render('create', array('model' => $account));
    }

    /**
     * Просмотр информации о счете, а также списка транзакций, совершенных по данному счету
     * @param $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        $account = Account::findOne($id);
        if($account === null){
            throw new NotFoundHttpException(\Yii::t('app', 'Указанный счет не найден в системе'));
        }

        return $this->render('view', ['model' => $account]);
    }

} 