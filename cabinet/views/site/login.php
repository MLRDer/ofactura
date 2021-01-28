<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<form name="testform" id="authForm" action="/site/login" method="post" class="kt-form" >
    <div class="sign-in-form">

        <div class="header">
            <img src="/new_template/images/icon/sign-in-logo.svg" alt="">
        </div>
        <div class="body">
            <select class="js-example-basic-hide-search" name="key" onchange="cbChanged(this)">

            </select>
            <div>
                <p id="message"></p>
                <input name="data" type="hidden" value="<?= $guid ?>">
                <label id="keyId" style="display:none;"></label><br />
                <textarea name="pkcs7" style="display:none;"></textarea>
                <div class="clearfix"></div>
            </div>
            <button type="button" class="btn-blue w-100 m-b-10 d-flex justify-content-center" onclick="sign()">Войти</button>
        </div>
    </div>
</form>



<script language="javascript">
    var EIMZO_MAJOR = 3;
    var EIMZO_MINOR = 37;


    var errorCAPIWS = 'Ошибка соединения с E-IMZO. Возможно у вас не установлен модуль E-IMZO или Браузер E-IMZO.';
    var errorBrowserWS = 'Браузер не поддерживает технологию WebSocket. Установите последнюю версию браузера.';
    var errorUpdateApp = 'ВНИМАНИЕ !!! Установите новую версию приложения E-IMZO или Браузера E-IMZO.<br /><a href="https://e-imzo.uz/main/downloads/" role="button">Скачать ПО E-IMZO</a>';
    var errorWrongPassword = 'Пароль неверный.';

    window.localStorage.removeItem('auth_key');
    var AppLoad = function () {
        EIMZOClient.API_KEYS = [
            'cabinet.onlinefactura.uz', 'F09A2CBE8EA25A5C065AF78D32F517B1DCF12E997575556CBD90B405A90420E6EB538FCCFFCBAA22C5D191CAB3803965621B023E8642F77F35DDA072FBA17914'
        ];
        uiLoading();
        EIMZOClient.checkVersion(function(major, minor){
            var newVersion = EIMZO_MAJOR * 100 + EIMZO_MINOR;
            var installedVersion = parseInt(major) * 100 + parseInt(minor);
            if(installedVersion < newVersion) {
                uiUpdateApp();
            } else {
                EIMZOClient.installApiKeys(function(){
                    uiLoadKeys();
                },function(e, r){
                    if(r){
                        uiShowMessage(r);
                    } else {
                        wsError(e);
                    }
                });
            }
        }, function(e, r){
            if(r){
                uiShowMessage(r);
            } else {
                uiNotLoaded(e);
            }
        });
    }


    var uiShowMessage = function(message){
        // alert(message);
        swal({
            position: 'center',
            type: 'error',
            title: 'Ошибка',
            showCloseButton: true,
            text: message
        });
    }

    var uiLoading = function(){
        var l = document.getElementById('message');
        l.innerHTML = 'Загрузка ...';
        l.style.color = 'red';
    }

    var uiNotLoaded = function(e){
        var l = document.getElementById('message');
        l.innerHTML = '';
        if (e) {
            wsError(e);
        } else {
            uiShowMessage(errorBrowserWS);
        }
    }

    var uiUpdateApp = function(){
        var l = document.getElementById('message');
        l.innerHTML = errorUpdateApp;
    }

    var uiLoadKeys = function(){
        uiClearCombo();
        EIMZOClient.listAllUserKeys(function(o, i){
            // console.log(o);
            var itemId = "itm-" + o.serialNumber + "-" + i;
            return itemId;
        },function(itemId, v){
            return uiCreateItem(itemId, v);
        },function(items, firstId){
            uiFillCombo(items);
            uiLoaded();
            uiComboSelect(firstId);
        },function(e, r){
            uiShowMessage(errorCAPIWS);
        });
    }

    var uiComboSelect = function(itm){
        if(itm){
            var id = document.getElementById(itm);
            id.setAttribute('selected','true');
        }
    }

    var cbChanged = function(c){
        document.getElementById('keyId').innerHTML = '';
    }

    var uiClearCombo = function(){
        var combo = document.testform.key;
        combo.length = 0;
    }

    var uiFillCombo = function(items){
        var combo = document.testform.key;
        for (var itm in items) {
            combo.append(items[itm]);
        }
    }

    var uiLoaded = function(){
        var l = document.getElementById('message');
        l.innerHTML = '';
    }

    var uiCreateItem = function (itmkey, vo) {
        var now = new Date();
        vo.expired = dates.compare(now, vo.validTo) > 0;
        var itm = document.createElement("option");
        itm.value = itmkey;
        var itemText ="";
        itemText = vo.O
        if(vo.O=="НЕ УКАЗАНО"){
            itemText = vo.CN
        }
        itm.text = itemText+" - "+vo.TIN;
        if (!vo.expired) {

        } else {
            itm.style.color = 'gray';
            itm.text = itm.text + ' (срок истек)';
        }
        itm.setAttribute('vo',JSON.stringify(vo));
        itm.setAttribute('id',itmkey);
        return itm;
    }

    var wsError = function (e) {
        if (e) {
            uiShowMessage(errorCAPIWS + " : " + e);
        } else {
            uiShowMessage(errorBrowserWS);
        }
    };


    var sendAuth =function(keyId,pkcs7,data){
        console.log('authga keldi');
        // var login ='<div class="kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--brand"></div>';
        // document.getElementById('authForm').innerHTML = login;
        // SetLoader('authForm');
        document.getElementById('loginPageArea').innerHTML='<div class="loader"><div class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><span class="tooltip"><p>line-scale</p></span></div>';
        $.ajax({
            url: '/site/auth',
            method: 'POST',
            async : false,
            data:{
                keyId:keyId,
                pkcs7:pkcs7,
                guid:data
            },
            success: function(data){
                data = JSON.parse(data);
                console.log(data);
                if(data.success==true){
                    window.localStorage.setItem('auth_key',keyId);
                    location.href= data.url;
                } else {
                    document.getElementById('loginPageArea').innerHTML = data.reason;
                }
            },
            error: function(data) {

            }
        });
    };

    sign = function () {
        var itm = document.testform.key.value;
        console.log(itm);
        if (itm) {
            var id = document.getElementById(itm);
            var vo = JSON.parse(id.getAttribute('vo'));
            var data = document.testform.data.value;
            var keyId = document.getElementById('keyId').innerHTML;
            // var keyId = window.localStorage.getItem('auth_key');
            console.log(keyId, "Hi");
            if(keyId){
                EIMZOClient.createPkcs7(keyId, data, null, function(pkcs7){
                    document.testform.pkcs7.value = pkcs7;


                }, function(e, r){
                    if(r){
                        if (r.indexOf("BadPaddingException") != -1) {
                            uiShowMessage(errorWrongPassword);
                        } else {
                            uiShowMessage(r);
                        }
                    } else {
                        document.getElementById('keyId').innerHTML = '';
                        uiShowMessage(errorBrowserWS);
                    }
                    if(e) wsError(e);
                });
            } else {
                EIMZOClient.loadKey(vo, function(id){
                    // document.getElementById('keyId').innerHTML = id;
                    window.localStorage.setItem('auth_key',id);
                    EIMZOClient.createPkcs7(id, data, null, function(pkcs7){
                        document.testform.pkcs7.value = pkcs7;
                        console.log(pkcs7);
                        sendAuth(id,pkcs7,data);
                        // var input = $("<input>")
                        //     .attr("type", "hidden")
                        //     .attr("name", "pkcs7").val(pkcs7);
                        // $('#authForm').append(input);
                        // $("#authForm").submit();
                    }, function(e, r){
                        if(r){
                            if (r.indexOf("BadPaddingException") != -1) {
                                uiShowMessage(errorWrongPassword);
                            } else {
                                uiShowMessage(r);
                            }
                        } else {
                            document.getElementById('keyId').innerHTML = '';
                            uiShowMessage(errorBrowserWS);
                        }
                        if(e) wsError(e);
                    });
                }, function(e, r){
                    if(r){
                        if (r.indexOf("BadPaddingException") != -1) {
                            uiShowMessage(errorWrongPassword);
                        } else {
                            uiShowMessage(r);
                        }
                    } else {
                        uiShowMessage(errorBrowserWS);
                    }
                    if(e) wsError(e);
                });
            }
        }
    };
    AppLoad();
    // window.onload = AppLoad;
</script>
