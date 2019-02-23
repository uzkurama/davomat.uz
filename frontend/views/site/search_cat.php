<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Qidirish';
?>
<div style="margin-top: 80px;" class="container-fluid">

    <div class="col-md-12">
        <center>
            <div class="row">
                <div class="col-md-6">
                    <div style="padding: 50px;" class="btn card">
                        <a href="<?= Url::to(['s/i']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-search"></i><p style="font-size: 20px;">Talaba qidirish</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 50px" class="btn card">
                        <a href="<?= Url::to(['a/i']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-search"></i><p style="font-size: 20px;">Davomat qidirish</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </center>
    </div>
   
</div>
