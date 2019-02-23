<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\assets\AwesomeAsset;
use dosamigos\chartjs\ChartJs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);
AwesomeAsset::register($this);

Yii::$app->name = 'NDKI davomat sistemasi';
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
    <div class="wrapper">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Asosiy', 'url' => ['/a/f']],
                ['label' => 'Qidirish', 'url' => ['/s/s']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Kirish', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li class="active">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Chiqish (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-info']
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
            <div class="content" style="margin-top: 100px; margin-left: 4px; margin-right: 4px; margin-bottom: 10px;">
                    <?= $content ?>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

                    <p style="color: purple;" class="pull-right"><?= "Created by Amir Rakhmonov" ?></p>
                </div>
            </footer>
    </div>


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
