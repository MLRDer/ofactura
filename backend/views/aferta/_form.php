<?php

use dosamigos\tinymce\TinyMce;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Aferta */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="aferta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => 'UZ',
                    'content' => $form->field($model, 'title_uz')->textInput(['maxlength' => true]).$form->field($model, 'body_uz')->widget(TinyMce::className(), [
                            'options' => ['rows' => 10],
                            'language' => 'ru',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])
                ],
                [
                    'label' => 'OZ',
                    'content' => $form->field($model, 'title_oz')->textInput(['maxlength' => true]).$form->field($model, 'body_oz')->widget(TinyMce::className(), [
                            'options' => ['rows' => 10],
                            'language' => 'ru',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])
                ],
                [
                    'label' => 'RU',
                    'content' => $form->field($model, 'title_ru')->textInput(['maxlength' => true]).$form->field($model, 'body_ru')->widget(TinyMce::className(), [
                            'options' => ['rows' => 10],
                            'language' => 'ru',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen",
                                    "insertdatetime media table contextmenu paste"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                            ]
                        ])
                ],
            ],
        ]
    ) ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
