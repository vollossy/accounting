<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\ar\Transaction;
use app\models\ar\Account;

/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Account $model
 * @var \yii\bootstrap\ActiveForm $form
 */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model) ?>

<?php if(Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success')?></div>
<?php endif;?>

<?= $form->field($model, 'from')->dropDownList(Account::find()->notUs()->allForDropDown()) ?>
<?= $form->field($model, 'to')->dropDownList(Account::find()->notUs()->allForDropDown()) ?>
<?= $form->field($model, 'amount')->textInput()?>


<div class="form-group">
    <?= Html::submitButton( Yii::t('app', 'Перевести'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
