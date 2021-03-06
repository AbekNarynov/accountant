<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Income */

$this->title = Yii::t('expense', 'Create Income');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incomes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
        'user' => $user,
        'source' => $source,
    ]) ?>

</div>
