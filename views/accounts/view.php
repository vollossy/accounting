<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Account $model
 */

use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Просмотр информации о счете "{name}"', ['name' => $model->client])
?>

<h1><?= $this->title?></h1>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'client',
        'serial',
        [
            'attribute' => 'balance',
            'value' => Yii::$app->formatter->asCurrency($model->balance, 'RUR')
        ]
    ],
]) ?>

<?=
GridView::widget([
    'dataProvider' => $model->getTransactionsDp(),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'datetime:datetime',
        [
            'header' => Yii::t('app','Тип'),
            'value' => function(\app\models\ar\Transaction $data) use ($model){
                    if($data->from == $model->serial){
                        return Yii::t('app', 'Списание');
                    }else{
                        return Yii::t('app', 'Зачисление');
                    }
                },
            'format' => 'raw'
        ],
        [
            'header' => Yii::t('app','Cчет'),
            'value' => function(\app\models\ar\Transaction $data) use ($model){
                    if($data->from == $model->serial){
                        return Html::a($data->to, ['/accounts/view', 'id' => $data->to]);
                    }else{
                        return Html::a($data->from, ['/accounts/view', 'id' => $data->from]);
                    }
                },
            'format' => 'raw'
        ],
        [
            'attribute' => 'amount',
            'value' => function(\app\models\ar\Transaction $data){
                    return Yii::$app->formatter->asCurrency($data->amount, 'RUR');
                }
        ]
    ],
]); ?>