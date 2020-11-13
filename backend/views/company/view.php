<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = $model->name." ma'lumotlari";


$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title"><?= $this->title ?> </h3>

</div>
<div class="panel-body">

    <div class="row">
        <div class="col-md-12" style="padding-bottom: 10px">
            <span>
                <?=
                Html::a('<i class="glyphicon glyphicon-plus"></i> Ручной оплатаь', ['/invoices/create?id='.$model->id],
                    ['role'=>'modal-remote','title'=> 'Create new Invoices','class'=>'btn btn-success']);
                ?>
            </span>
        </div>
    </div>

<div class="company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tin',
            'address',
            'status',
            'invoices_sum',
            'tarif_id',
        ],
    ]) ?>


    <?=GridView::widget([
        'id'=>'crud-datatable',
        'dataProvider' => $dataProvider,
        'pjax'=>true,
        'columns' => require(__DIR__.'/_columnsInvoices.php'),
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Invoices','class'=>'btn btn-default']).
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                '{toggleData}'.
                '{export}'
            ],
        ],
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'panel' =>  false
    ])?>
     
</div>
</div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
