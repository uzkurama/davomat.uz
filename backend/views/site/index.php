<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'NDKI davomat sistemasi';
?>
<div style="margin-top: 80px;" class="container-fluid">

    <div class="col-md-12">
        <center>
            <div class="row">
                <div class="col-md-4">
                    <div style="padding: 50px" class="btn card">
                        <a href="<?= Url::to(['faculty/create']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-plus"></i><p style="font-size: 20px;">Fakultet qo'shish</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="padding: 50px" class="btn card">
                        <a href="<?= Url::to(['chair/create']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-plus"></i><p style="font-size: 20px;">Yo'nalish qo'shish</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="padding: 50px" class="btn card">
                        <a href="<?= Url::to(['group/create']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-plus"></i><p style="font-size: 20px;">Guruh qo'shish</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div style="padding: 50px;" class="btn card">
                        <a href="<?= Url::to(['student/create']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-plus"></i><p style="font-size: 20px;">Talaba qo'shish</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 50px" class="btn card">
                        <a href="<?= Url::to(['davomat/index']); ?>">
                            <div class="card-content">
                                <i style="font-size: 30px;" class="fas fa-plus"></i><p style="font-size: 20px;">Davomat kiritish</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </center>
    </div>
   
</div>
