<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Facturas */

$this->title = "Счет фактура № ".$model->FacturaNo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Facturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column align-items-start">
                    <div class="page-title m-b-10">
                        <?= "Счет фактура <span class='number'>№ ".$model->FacturaNo."</span>";?>
                    </div>
                    <?php if($model->SellerTin==\cabinet\models\Components::CompanyData('tin')){ ?>
                        <div class="badge yellow">
                            <?= Yii::t('main','Chiquvchi xujjat')?>
                        </div>
                    <?php } elseif($model->BuyerTin==\cabinet\models\Components::CompanyData('tin')){?>
                    <div class="badge yellow">
                            <?= Yii::t('main','Kiruvchi xujjat')?>
                        </div>
                    <?php }?>
                </div>
                <div class="d-flex justify-content-end align-items-center">

                    <?php if($model->SellerTin==\cabinet\models\Components::CompanyData('tin')){ ?>
                        <?= $this->render('_viewButtons',['model'=>$model])?>
                    <?php } else {?>
                        <?= $this->render('_viewButtonsIn',['model'=>$model])?>
                    <?php }?>
<!--                    <a href="#!" class="btn-outline-yellow m-r-20">-->
<!--                        <img src="images/icon/copy-yellow.svg" alt=""> <span class="title">дублировать </span>-->
<!--                    </a>-->
<!--                    <a href="#!" class="btn-gray">отменить</a>-->
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <?php

            if(isset($_SESSION['missing_classcodes'])){
                $missings = $_SESSION['missing_classcodes'];
                $text_missings = "";
                foreach ($missings as $missing){
                    $text_missings .= $missing . " ";

                }

                if (count($_SESSION['missing_classcodes']) > 0){
                    echo "<div style='background-color: #f2f3f7; padding: 20px '>".$text_missings." - ushbu klass kodlar sizda mavjud emas!"."</div>";
                }
            }

            $_SESSION["missing_classcodes"]=[];

        ?>

    <div class="row">
        <div class="col-md-12">
            <div class="pdf-wrapper">
                <?php
                $CanseledJson = [
                    'FacturaId'=>$model->Id,
                    'SellerTin'=>$model->SellerTin
                ];
                ?>
                <input type="hidden" id="CaneledValue" name="caneled_value" value='<?= \yii\helpers\Json::encode($CanseledJson)?>'>
                <object data="/facturas/pdf?id=<?= $model->Id ?>" type="application/pdf" width="100%" height="650"></object>
            </div>
        </div>
    </div>
</div>


<style>
    table tr td{
        color: black;
        vertical-align: center;
    }
    .labelFactura{
        font-weight: bold;
        color: black;
    }
</style>
