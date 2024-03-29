<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\AwesomeAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
AwesomeAsset::register($this);

Yii::$app->name = 'NDKI davomat sistemasi'
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
    $menuItems = [
        ['label' => 'Asosiysi', 'url' => ['/site/index']],
        ['label' => 'Fakultetlar', 'url' => ['/faculty/index']],
        ['label' => 'Yo\'nalishlar', 'url' => ['/chair/index']],
        ['label' => 'Guruhlar', 'url' => ['/group/index']],
        ['label' => 'Talabalar', 'url' => ['/student/index']],
        ['label' => 'Davomat qo\'shish', 'url' => ['/davomat/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p style="color: purple;" class="pull-right"><?= "Created by Amir Rakhmonov" ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>

<script type="text/javascript">
      
NProgress.set(0.3);
NProgress.configure({ ease: 'ease', speed: 1500 }); // конфигурация скорости загрузки и CSS easing
NProgress.start(); // начать "загрузку"
NProgress.done(); // заставить индикатор дойти до конца и пропасть

</script>
</html>
<?php $this->endPage() ?>
