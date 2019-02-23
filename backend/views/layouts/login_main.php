<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;



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
<body style="background: url(../img/main.jpg)">
<?php $this->beginBody() ?>
    <center>
        <?= $content; ?>
    </center>
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