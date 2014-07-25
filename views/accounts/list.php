<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dp
 */

use app\models\ar\Account;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Просмотр списка счетов');
?>

<h1><?= $this->title?></h1>

<?=
GridView::widget([
    'dataProvider' => $dp,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'serial',
            'value' => function(Account $data){
                    return Html::a($data->serial, ['/accounts/view', 'id' =>$data->serial]);
                },
            'format' => 'raw'
        ],
        'client',
        [
            'attribute' => 'balance',
            'value' => function(Account $data){
                    return Yii::$app->formatter->asCurrency($data->balance, 'RUR');
                }
        ],
    ],
]); ?>