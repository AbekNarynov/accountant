<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
/* @var $reason array */
/* @var $location array */
?>

<div class="expense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['class' => 'date-picker form-control']) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'reason_id')->dropDownList($reason) ?>

    <?= $form->field($model, 'location_id')->dropDownList($location) ?>

    <?= $form->field($model, 'user_id')->dropDownList($user) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    // Меняем местоположения, в зависимости от выбранной причины при загрузке страницы
    $(document).ready(function () {
        changeLocations($('#expense-reason_id').val());
    });

    // Меняем местоположения, в зависимости от выбранной причины при изменении причины
    $('#expense-reason_id').change(function () {
        changeLocations($(this).val());
    });

    // Меняем местоположения, в зависимости от выбранной причины
    function changeLocations (reasonId) {
        $.ajax({
            type: 'POST',
            url: 'get-locations-by-reason-id',
            data: {
                reasonId: reasonId
            },
            success: function (data) {
                var locations = JSON.parse(data);
                var options = '';

                for (var key in locations) {
                    options += '<option value="' + key + '">' + locations[key] + '</option>';
                }

                $('#expense-location_id').empty().append(options);
            }
        })
    }
</script>