<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-04-01
 * Time: 00:48
 */

use common\widgets\Alert;
use yii\grid\GridView;

$this->title = Yii::t('main',"Мои финансы");

?>
<div class="white-box">
    <div class="row">
        <div class="col-md-12">
            <div class="page-title"><?= $this->title ?></div>
        </div>
        <div class="col-md-6">
            <div class="current-balance m-b-60">
                <div class="label">На счету:</div>
                <div class="value"><?= \cabinet\models\Components::getSum()?> сум</div>
            </div>
            <form method="POST" action="https://checkout.paycom.uz" id="PaymeSet">
                <!-- Идентификатор WEB Кассы -->
                <input type="hidden" name="merchant" value="5df8752b7e2d6cf23ec1b00d"/>
                <div class="payment-form">
                    <div class="input m-b-20">
                        <!-- Сумма платежа в тийинах -->
                        <input type="text" placeholder="Введите сумму пополнения счета" name="amount" id="kt_inputmask_7" value="500000">
                        <!-- Поля Объекта Account -->
                        <input type="hidden" name="account[tin]" value="<?= \cabinet\models\Components::CompanyData('tin') ?>"/>
                        <!-- ==================== НЕОБЯЗАТЕЛЬНЫЕ ПОЛЯ ====================== -->
                        <!-- Язык. Доступные значения: ru|uz|en
                             Другие значения игнорируются
                             Значение по умолчанию ru -->
                        <input type="hidden" name="lang" value="ru"/>

                        <!-- Валюта. Доступные значения: 643|840|860|978
                             Другие значения игнорируются
                             Значение по умолчанию 860
                             Коды валют в ISO формате
                             643 - RUB
                             840 - USD
                             860 - UZS
                             978 - EUR -->
                        <input type="hidden" name="currency" value="860"/>

                        <!-- URL возврата после оплаты или отмены платежа.
                             Если URL возврата не указан, он берется из заголовка запроса Referer.
                             URL возврата может содержать параметры, которые заменяются Paycom при запросе.
                             Доступные параметры для callback:
                             :transaction - id транзакции или "null" если транзакцию не удалось создать
                             :account.{field} - поля объекта Account
                             Пример: https://your-service.uz/paycom/:transaction -->
                        <input type="hidden" name="callback" value="https://cabinet.onlinefactura.uz/invoices/payme"/>
                        <!-- Таймаут после успешного платежа в миллисекундах.
                             Значение по умолчанию 15
                             После успешной оплаты, по истечении времени callback_timeout
                             производится перенаправление пользователя по url возврата после платежа -->
                        <!--                <input type="hidden" name="callback_timeout" value="{miliseconds}"/>-->

                        <!-- Выбор платежного инструмента Paycom.
                             В Paycom доступна регистрация несколько платежных
                             инструментов. Если платёжный инструмент не указан,
                             пользователю предоставляется выбор инструмента оплаты.
                             Если указать id определённого платежного инструмента -
                             пользователь перенаправляется на указанный платежный инструмент. -->
                        <!--                <input type="hidden" name="payment" value="{payment_id}"/>-->

                        <!-- Описание платежа
                             Для описания платежа доступны 3 языка: узбекский, русский, английский.
                             Для описания платежа на нескольких языках следует использовать
                             несколько полей с атрибутом  name="description[{lang}]"
                             lang может принимать значения ru|en|uz -->
                        <input type="hidden" name="description" value="Xisobni toldirish uchun"/>

                        <!-- Объект детализации платежа
                             Поле для детального описания платежа, например, перечисления
                             купленных товаров, стоимости доставки, скидки.
                             Значение поля (value) — JSON-строка закодированная в BASE64 -->
                        <!--                <input type="hidden" name="detail" value="{JSON объект детализации в BASE64}"/>-->
                        <!-- ================================================================== -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="checkbox">
                                <input type="radio" class="input-checkbox" name="payment_type2">
                                <div class="check"></div>
                                <img src="/new_template/images/content/payme.png" alt="">
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="checkbox">
                                <input type="radio" class="input-checkbox" name="payment_type2">
                                <div class="check"></div>
                                <img src="/new_template/images/content/aloqabank.png" alt="">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn-blue" type="submit">оплатить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items}{pager}',
                'tableOptions' => [
                    'class' => '',
                ],
                'pager'=>[
                    'prevPageLabel'=>'<img src="/new_template/images/icon/arrow-left-blue.svg" alt="">',
                    'nextPageLabel'=>'<img src="/new_template/images/icon/arrow-right-blue.svg" alt="">',
                ],
                'columns' => [
                    [
                        'attribute'=>'value',
                        'headerOptions' => ['style' => 'width:130px;text-align:center;'],
                        'format'=>'raw',
                        'value'=>function($model){
                                $res = number_format($model->value,2);
                            if($model->type_invoices==1){
                                $res = '<div class="text-success">+ '.number_format($model->value,2).' </div>';
                            }
                            if($model->type_invoices==0){
                                $res = '<div class="text-danger">- '.number_format($model->value,2).' </div>';
                            }


                            return $res;
                        }
                    ],
                    'reason',
                    [
                        'attribute'=>'created_date',
                        'headerOptions' => ['style' => 'width:160px'],
                        'value'=>function($model){
                            return date('d.m.Y H:i',strtotime($model->created_date));
                        }
                    ],


                ],
            ]); ?>
        </div>
    </div>
</div>


<script>
    // Class definition

    var KTInputmask = function () {

        // Private functions
        var demos = function () {
            // date format
            $("#kt_inputmask_1").inputmask("mm/dd/yyyy", {
                autoUnmask: true
            });

            // custom placeholder
            $("#kt_inputmask_2").inputmask("mm/dd/yyyy", {
                "placeholder": "*"
            });

            // phone number format
            $("#kt_inputmask_3").inputmask("mask", {
                "mask": "(999) 999-9999"
            });

            // empty placeholder
            $("#kt_inputmask_4").inputmask({
                "mask": "99-9999999",
                placeholder: "" // remove underscores from the input mask
            });

            // repeating mask
            $("#kt_inputmask_5").inputmask({
                "mask": "9",
                "repeat": 10,
                "greedy": false
            }); // ~ mask "9" or mask "99" or ... mask "9999999999"

            // decimal format
            $("#kt_inputmask_6").inputmask('decimal', {
                rightAlignNumerics: false
            });

            // currency format
            $("#kt_inputmask_7").inputmask('999.999.999,99 so`m', {
                numericInput: true,
                autoUnmask: true,
                removeMaskOnSubmit: true,
            }); //123456  =>  € ___.__1.234,56

            //ip address
            $("#kt_inputmask_8").inputmask({
                "mask": "999.999.999.999"
            });

            //email address
            $("#kt_inputmask_9").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: false,
                onBeforePaste: function (pastedValue, opts) {
                    pastedValue = pastedValue.toLowerCase();
                    return pastedValue.replace("mailto:", "");
                },
                definitions: {
                    '*': {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            });
        }

        return {
            // public functions
            init: function() {
                demos();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTInputmask.init();
    });


</script>