<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Transaction $model
 */
use app\models\ar\Account;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Добавить перевод');
?>

<h1><?= $this->title?></h1>

<?php if(Account::find()->notUs()->count()):?>
<?= $this->render('_form', ['model' => $model]);?>

<?php else: ?>

    <div class="alert alert-warning">
        <?= Yii::t('app', 'В системе отсутствуют счета, {addLink}', ['addLink' => Html::a(Yii::t('app', 'добавьте новый'), ['/accounts/create'])])?>
    </div>

<?php endif;?>