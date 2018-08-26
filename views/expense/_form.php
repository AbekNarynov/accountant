<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['class' => 'date-picker form-control']) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'location_id')->dropDownList($location) ?>

    <?= $form->field($model, 'reason_id')->dropDownList($reason) ?>

    <?= $form->field($model, 'user_id')->dropDownList($user) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>