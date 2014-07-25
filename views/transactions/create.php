<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Transaction $model
 */

$this->title = Yii::t('app', 'Добавить перевод');
?>

<h1><?= $this->title?></h1>

<?= $this->render('_form', ['model' => $model]);