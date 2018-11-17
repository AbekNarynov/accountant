<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    try {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => Yii::t('menu', 'Expense'), 'url' => ['/expense/index']],
                ['label' => Yii::t('menu', 'Income'), 'url' => ['/income/index']],
                ['label' => Yii::t('menu', 'Location'), 'url' => ['/location/index']],
                ['label' => Yii::t('menu', 'Reason'), 'url' => ['/reason/index']],
                ['label' => Yii::t('menu', 'Source'), 'url' => ['/source/index']],
                ['label' => Yii::t('menu', 'Users'), 'url' => ['/rbac/default/index']],
                ['label' => Yii::t('menu', 'Reason-Location'), 'url' => ['/reason-location/index']],
                Yii::$app->user->isGuest ? (
                ['label' => Yii::t('menu', 'Login'), 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        Yii::t('menu', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
    } catch (Exception $e) {
    }
    NavBar::end();
    ?>

    <div class="container">
        <?php try {
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
        } catch (Exception $e) {
        } ?>
        <?php try {
            echo Alert::widget();
        } catch (Exception $e) {
        } ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Accountant <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
