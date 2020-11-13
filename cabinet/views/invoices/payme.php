<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-04-01
 * Time: 00:48
 */

use common\widgets\Alert;
$this->title = Yii::t('main',"﻿Пополнение счета");

?>


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--Begin::Dashboard 6-->

    <!--Begin::Section-->
    <div class="row">

        <div class="col-md-12">
            <?= Alert::widget()?>
        </div>


        <div class="col-xl-12">

            <!--begin:: Widgets/Order Statistics-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                    <rect id="Rectangle" fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/>
                                    <rect id="Rectangle-Copy-3" fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>
                                    <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" id="Combined-Shape" fill="#000000"/>
                                </g>
                            </svg>
                            <?= Yii::t('main','Xisobni to`ldirish') ?>
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">


                                <h3 class="kt-section__title kt-section__title-lg">Customer Info:</h3>

                                <form method="POST" action="https://checkout.paycom.uz" id="PaymeSet">

                                    <!-- Идентификатор WEB Кассы -->
                                    <input type="hidden" name="merchant" value="5df8752b7e2d6cf23ec1b00d"/>

                                    <!-- Сумма платежа в тийинах -->
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">To`lov miqdorini kiriting</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="amount" id="kt_inputmask_7" value="500000">
                                        </div>
                                    </div>

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
                                    <input type="hidden" name="callback" value="https://cabinet.onlinefactura.uz/invoices/index"/>

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
                                    <input type="hidden" name="description" value="Xisobni toldirtish uchun"/>

                                    <!-- Объект детализации платежа
                                         Поле для детального описания платежа, например, перечисления
                                         купленных товаров, стоимости доставки, скидки.
                                         Значение поля (value) — JSON-строка закодированная в BASE64 -->
                                    <!--                <input type="hidden" name="detail" value="{JSON объект детализации в BASE64}"/>-->
                                    <!-- ================================================================== -->
                                    <div style="padding-top: 100px;text-align: center">
                                    <button type="submit" class="btn btn-default btn-lg"><img src="/img/unnamed.png" width="105px"><br> Оплатить с помощью <b>Payme</b></button>
                                        <a  href="/docs/Тулов_топширикномаси_сайт_учун_шаблон (2).xls" class="btn btn-default btn-lg"><img src="/img/bank_icon.png" width="120px"><br> Оплатить с помощью <b>Банк</b></a>
                                    </div>
                            </div>
                        </div>



                </div>
            </div>

            <!--end:: Widgets/Order Statistics-->
        </div>

    </div>
</div>


<style>
    .kt-widget4 .kt-widget4__item .kt-widget4__info .kt-widget4__username {
        font-weight: 500;
        font-size: 1rem;
        color: #000000;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-widget4 .kt-widget4__item .kt-widget4__title {
        color: #000000;
        font-size: 1rem;
        font-weight: 500;
        padding-right: 1.25rem;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }
    .btn.btn-default {
        border: 0;
        background: transparent;
        color: #000;
        border: 1px solid #dedfe4;
    }

</style>

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