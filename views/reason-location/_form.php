<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReasonLocation */
/* @var $form yii\widgets\ActiveForm */
/* @var $reason array */
/* @var $location array */
?>

<div class="reason-location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reason_id')->dropDownList($reason) ?>

    <?= $form->field($model, 'location_id')->dropDownList($location) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('reason_location', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
