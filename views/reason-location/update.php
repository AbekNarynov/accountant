<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReasonLocation */
/* @var $reason array */
/* @var $location array */

$this->title = Yii::t('reason_location', 'Update Reason Location: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('reason_location', 'Reason Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('reason_location', 'Update');
?>
<div class="reason-location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'reason' => $reason,
        'location' => $location,
    ]) ?>

</div>
