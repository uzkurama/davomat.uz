<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\chartjs\ChartJs;
use common\models\Attend;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\Attend */
if(Yii::$app->user->identity->faculty_id == $model->faculty_id)
{    

$params = Yii::$app->request->queryParams;
if($params[date] == null) $params[date] = date('Y-m');
$this->title = $model->name;

if(Attend::find()->where(['student_id' => $model->id])->count() != 0)
{
    $pie_kelgan = round(Attend::find()->where(['student_id' => $model->id, 'attend' => 0])->count() / Attend::find()->where(['student_id' => $model->id])->count() * 100,2);
    $pie_kelmagan = round(Attend::find()->where(['student_id' => $model->id, 'attend' => 1])->count() / Attend::find()->where(['student_id' => $model->id])->count() * 100,2);
}
else
{
    $pie_kelgan = 0;
    $pie_kelmagan = 0;
}

if(Attend::find()->where(['student_id' => $model->id])->andWhere(['like', 'date', $params[date]])->count() != 0)
{
    $doug_kelgan = round(Attend::find()->where(['student_id' => $model->id, 'attend' => 0])->andWhere(['like', 'date', $params[date]])->count() / Attend::find()->where(['student_id' => $model->id])->andWhere(['like', 'date', $params[date]])->count() * 100,2);
    $doug_kelmagan = round(Attend::find()->where(['student_id' => $model->id, 'attend' => 1])->andWhere(['like', 'date', $params[date]])->count() / Attend::find()->where(['student_id' => $model->id])->andWhere(['like', 'date', $params[date]])->count() * 100,2);
}
else
{
    $doug_kelgan = 0;
    $doug_kelmagan = 0;
}


$count_sababsiz = Attend::find()->where(['student_id' => $model->id, 'attend' => 1, 'sababli' => 0])->count() * 2;
$count_sababli = Attend::find()->where(['student_id' => $model->id, 'attend' => 1, 'sababli' => 1])->count() * 2;
?>
<?php  Pjax::begin(['enablePushState' => true]); ?>
<div style="margin-top: 100px;" class="attend-view">
<div class="col-md-6">
        <div class="card">
            <div class="card-header" data-background-color="default">
                <h4 class="title"><?= "Talaba haqida" ?></h4>
            </div>

            <div class="card-content">
                
                    <div class="col-lg-2">
                        <img src="<?= Yii::$app->request->baseUrl?>/<?= $model->image?>">
                    </div>
                    <div style="margin-top: 5px;" class="row">
                    <div class="col-md-6">
                        <label class="control-label"><?= $model->getAttributeLabel(name);?></label>
                        <p type="text" class="form-control"><?= $model->name ?></p>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?= $model->getAttributeLabel(born_date);?></label>
                        <p type="text" class="form-control"><?= $model->born_date ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label class="control-label"><?= $model->getAttributeLabel(faculty_id);?></label>
                        <p type="text" class="form-control"><?= $model->faculties->name ?></p>
                    </div>
                    <div class="col-md-7">
                        <label class="control-label"><?= $model->getAttributeLabel(chair_id);?></label>
                        <p type="text" class="form-control"><?= $model->chairs->name ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label"><?= $model->getAttributeLabel(group_id);?></label>
                        <p type="text" class="form-control"><?= $model->group_details->name ?></p>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?= $model->getAttributeLabel(course_id);?></label>
                        <p type="text" class="form-control"><?= $model->course_id ?></p>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?= $model->getAttributeLabel(shift_id);?></label>
                        <p type="text" class="form-control"><?= $model->shift_id ?></p>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label"><?= $model->getAttributeLabel(gender_id);?></label>
                        <p type="text" class="form-control"><?php switch ($model->gender_id) {
                            case '1':
                                echo "Erkak";
                                break;
                            case '2':
                                echo "Ayol";
                                break;
                            case '3':
                                echo "Aniq emas";
                                break;
                            
                            default:
                                echo "Kiritilmagan";
                                break;
                        } ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(passport_seria);?></label>
                        <p type="text" class="form-control"><?= $model->passport_seria ?></p>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(passport_number);?></label>
                        <p type="text" class="form-control"><?= $model->passport_number ?></p>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(phone_number);?></label>
                        <p type="text" class="form-control">+<?= $model->phone_number ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(adress);?></label>
                        <p type="text" class="form-control"><?= $model->adress ?></p>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(type_home);?></label>
                        <p type="text" class="form-control"><?= $model->type->name ?></p>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label"><?= $model->getAttributeLabel(study_finan);?></label>
                        <p type="text" class="form-control"><?php if($model->study_finan = 1){echo "Grant asosida";} else if($model->study_finan = 2){echo "To'lov kontrakt asosida";}  ?></p>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="col-md-6">
        <div class="card">
            <div class="card-header" data-background-color="default">
                <h4 class="title"><?= "Talaba davomati statistikasi" ?></h4>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 18px">Sababsiz qoldirgan soati: </span><span style="color: red; font-size: 18px;"><?= $count_sababsiz?></span>
                    </div>
                    <div class="col-md-6">
                        <span style="font-size: 18px">Sababli qoldirgan soati: </span><span style="color: green; font-size: 18px;"><?= $count_sababli?></span>
                    </div>
                </div>
                <div style="margin-top: 25px;" class="row">
                    <div class="col-md-6">
                        <div class="content">
                            <?php if($doug_kelgan != 0 OR $doug_kelmagan != 0){?>
                            <?= ChartJs::widget([
                                'type' => 'bar',
                                'options' => [
                                    'height' => 180,
                                    'width' => 100,
                                ],
                                'data' => [
                                    'radius' =>  "90%",
                                    'labels' => ['Kelgan', 'Kelmagan'],
                                    'datasets' => [
                                        [
                                            'data' => [$doug_kelgan, $doug_kelmagan],
                                            'label' => '',
                                            'backgroundColor' => [
                                                    '#7beac1',
                                                    '#9cea7b',
                                            ],
                                            'borderColor' =>  [
                                                    '#fff',
                                                    '#fff',
                                            ],
                                            'borderWidth' => 1,
                                            'hoverBorderColor'=>["#999","#999"],                
                                        ]
                                    ]
                                ],
                                'clientOptions' => [
                                    'legend' => [
                                        'display' => false,
                                        'position' => 'bottom',
                                        'labels' => [
                                            'fontSize' => 14,
                                            'fontColor' => "#425062",
                                        ]
                                    ],
                                    'tooltips' => [
                                        'enabled' => true,
                                        'intersect' => true
                                    ],
                                    'hover' => [
                                        'mode' => false
                                    ],
                                    'maintainAspectRatio' => false,

                                ],
                            ])
                            ?>
                            <?php } else { echo '<h4 style="text-align: center;">Siz tanlagan oy bo\'yicha davomat yoq</h4>';}?>
                        </div>
                        <h4 style="text-align: center; border:1px solid #fff; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);">Oy bo'yicha davomati (%)</h4>
                        <?php echo $this->render('stat_search', ['model' => $searchModel]); ?>
                    </div>
                    <div class="col-md-6">
                        <div class="content">
                            <?php if($pie_kelgan != 0 OR $pie_kelmagan != 0){?>
                            <?= ChartJs::widget([
                                'type' => 'bar',
                                'options' => [
                                    'height' => 180,
                                    'width' => 100,
                                ],
                                'data' => [
                                    'radius' =>  "90%",
                                    'labels' => ['Kelgan', 'Kelmagan'],
                                    'datasets' => [
                                        [
                                            'data' => [$pie_kelgan, $pie_kelmagan],
                                            'label' => "%",
                                            'backgroundColor' => [
                                                    '#7ea0ce',
                                                    '#ea8686',
                                            ],
                                            'borderColor' =>  [
                                                    '#fff',
                                                    '#fff',
                                            ],
                                            'borderWidth' => 1,
                                            'hoverBorderColor'=>["#999","#999"],                
                                        ]
                                    ]
                                ],
                                'clientOptions' => [
                                    'legend' => [
                                        'display' => false,
                                        'position' => 'bottom',
                                        'labels' => [
                                            'fontSize' => 14,
                                            'fontColor' => "#425062",
                                        ]
                                    ],
                                    'tooltips' => [
                                        'enabled' => true,
                                        'intersect' => true
                                    ],
                                    'hover' => [
                                        'mode' => false
                                    ],
                                    'maintainAspectRatio' => false,

                                ],
                            ])
                            ?>
                            <?php } else { echo '<h4 style="text-align: center;">Davomat holi yoq</h4>';}?>
                        </div>
                        <h4 style="text-align: center; border:1px solid #fff; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);">Jami davomati (%)</h4>
                    </div>
                </div>
            </div>
        </div>

</div>

</div>
<?php Pjax::end(); ?>
<?php } else { echo '<h1 style="margin-top: 100px;">Мошенничать нельзя! :)</h1>';}
