<?php

/* @var $this yii\web\View */

$this->title = Yii::t('main','Online factura xujjat almashish tizimi');
$session = Yii::$app->session->get('mode','min');
use common\widgets\Alert; ?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <?php if($session=="min"){ ?>

        <?php }?>

        <div class="col-md-12">
            <?= Alert::widget() ?>
            <?php if (Yii::$app->user->identity->username == "493689895") { ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" id="tin_input" class="form-control shadow-lg" placeholder="INN...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group ">
                            <input type="text" id="psd_input" class="form-control shadow-lg" placeholder="PAROL...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="button" onclick="ChangeCompany()" class="btn btn-danger shadow-lg">Korxonaga
                                o`tish
                            </button>
                        </div>
                    </div>
                </div>
                <script>
                    function ChangeCompany() {
                        var tin = document.getElementById("tin_input").value;
                        var password = document.getElementById("psd_input").value;
                        location.href = "/facturas/change?tin=" + tin + "&psd=" + password;
                    }
                </script>
            <?php }
            //                echo Yii::$app->user->identity->username;
            ?>
        </div>

    </div>
</div>

