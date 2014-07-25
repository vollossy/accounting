<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Account $model
 */

$this->title = Yii::t('app', 'Добавить счет');
?>

<h1><?= $this->title ?></h1>

<?= $this->render('_form', ['model' => $model]);?>