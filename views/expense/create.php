<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $reason array */
/* @var $location array */

$this->title = Yii::t('expense', 'Create Expense');
$this->params['breadcrumbs'][] = ['label' => Yii::t('expense', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
        'user' => $user,
        'reason' => $reason,
    ]) ?>

</div>