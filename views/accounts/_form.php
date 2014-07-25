<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\models\ar\Account $model
 * @var \yii\bootstrap\ActiveForm $form
 */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model) ?>

<?= $form->field($model, 'client')->textInput() ?>
<?= $form->field($model, 'serial')->textInput() ?>
<?= $form->field($model, 'balance')->textInput() ?>


<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
