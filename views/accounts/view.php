<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Account $model
 */

use yii\widgets\DetailView;

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