<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReasonLocation */
/* @var $reason array */
/* @var $location array */

$this->title = Yii::t('reason_location', 'Create Reason Location');
$this->params['breadcrumbs'][] = ['label' => Yii::t('reason_location', 'Reason Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reason-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'reason' => $reason,
        'location' => $location,
    ]) ?>

</div>
