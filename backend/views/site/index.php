<?php

/* @var $this yii\web\View */

$this->title = 'Adminstrator';
$date =date('Y-m-d');
$out_doc = \common\models\Facturas::find()->where("date(created_date)='{$date}' and status>0")->andWhere(['type'=>0])->count();
$out_sum = \common\models\Invoices::find()->where("date(created_date)='{$date}'")->andWhere(['type_invoices'=>0])->count();

$in_doc = \common\models\Facturas::find()->where("date(created_date)='{$date}'")->andWhere(['type'=>1])->count();
$in_error = \common\models\DocInData::find()->where("date(created_date)='{$date}'")->count();

$start_date = date("Y-m-t 00:00:00", strtotime("-1 month") );
$end_date = date("Y-m-1 23:59:00", strtotime("-1 month") );

$total_docs_success_send = \common\models\Facturas::find()->where("(created_date BETWEEN '{$start_date}' and '{$end_date}') and type_invoices=0")->count();
$total_davernost_success_send = \common\models\Facturas::find()->where("(created_date BETWEEN '{$start_date}' and '{$end_date}') and type_invoices=0 and tarrif_id>0")->count();
$total_factura_send = $total_docs_success_send - $total_davernost_success_send;


?>
<div class="site-index">

   <div class="row">
       <div class="col-md-12">
           <div class="panel panel-default">
               <div class="panel-body">
                    <div class="col-md-3">
                        <span class="btn btn-default"><i class="glyphicon glyphicon-upload"></i> </span>  Jonatilgan faktura <span class="badge"><?= $out_doc ?></span>
                    </div>
                    <div class="col-md-3">
                        <span class="btn btn-default">
                        <i class="glyphicon glyphicon-usd"></i> </span>  Pul yechilgan hujjat
                        <span class="badge"><?= $out_sum  ?></span>
                        <div style="font-style: italic;color: red;">Ishlagan pulimiz: <?= number_format($out_sum*250,2)?></div>
                    </div>
                    <div class="col-md-3">
                        <span class="btn btn-default"><i class="glyphicon glyphicon-download"></i> </span>  Call-back <span class="badge"><?= $in_doc  ?></span>
                        <div style="font-style: italic;color: green;">Ishlashimiz mumkin adi: <?= number_format($in_doc*250,2)?></div>
                    </div>
                    <div class="col-md-3">
                        <span class="btn btn-default"><i class="glyphicon glyphicon-ban-circle"></i> </span>  Call-back error <span class="badge"><?= $in_error  ?></span>
                    </div>
                    <hr>
                    <div class="col-md-12" style="padding-top:20px; padding-bottom: 20px;margin-bottom: 20px;border-bottom:1px dashed #000">
                        <div class="row">

                            <hr>
                        <div class="col-md-3">
                            <div class="btn btn-default btn-lg btn-block">
                                Faol korxonalar <span class="badge"><?= $aktiv_company ?></span>
                            </div>
                        </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                      
                    </div>

                    <div class="clearfix"></div>



               </div>
           </div>
           <div class="panel panel-default">
               <div class="panel-body">
                   <div class="col-md-3">
                       <span class="btn btn-default"><i class="glyphicon glyphicon-upload"></i> </span>  O'tgan oy jonatilgan hujjatlar <span class="badge"><?= $total_docs_success_send ?></span>
                   </div>
                   <div class="col-md-3">
                        <span class="btn btn-default">
                        <i class="glyphicon glyphicon-usd"></i> </span>  Davernost hujjatlar
                       <span class="badge"><?= $total_davernost_success_send  ?></span>
                   </div>
                   <div class="col-md-3">
                       <span class="btn btn-default"><i class="glyphicon glyphicon-download"></i> </span>  Jonatilgan facturalar <span class="badge"><?= $total_factura_send  ?></span>
                   </div>

                   <hr>


                   <div class="col-md-12">

                   </div>

                   <div class="clearfix"></div>



               </div>
           </div>
       </div>
   </div>
</div>
