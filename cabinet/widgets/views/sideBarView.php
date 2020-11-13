<?php

$path = Yii::$app->request->getUrl();
$lang = "/". Yii::$app->language;
$class = [
  1=>($path==$lang)? "active":'',
    0=>($path==$lang."/reestr/index")? "active":'',
  2=>($path==$lang."/facturas/create")? "active":'',

  3=>($path==$lang."/facturas/sent")? "active":'',
  4=>($path==$lang."/facturas/received")? "active":'',
    14=>($path==$lang."/facturas/saved")? "active":'',
//  4=>($path==$lang."/doc/index" || $path==$lang."/doc/out-list" || $path==$lang."/doc/in-list" || $path==$lang."/doc/new-list")? "active":'',

    5=>($path==$lang."/empowerment/create")? "active":'',
    6=>($path==$lang."/empowerment/index")? "active":'',
    7=>($path==$lang."/doc/create-aksiz")? "active":'',

];
?>
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" >
            <ul class="kt-menu__nav ">

                <li class="kt-menu__item <?= $class[1]?> " aria-haspopup="true">
                    <a href="/" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-background"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Asosiy')?></span>
                    </a>
                </li>
                <li class="kt-menu__item <?= $class[0]?> " aria-haspopup="true">
                    <a href="/reestr/index" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-interface-3"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Реестр')?></span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"><?= Yii::t('main','Xujjatlar')?></h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item <?= $class[2]?>" aria-haspopup="true">
                    <a href="/facturas/create" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-file-1"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Yaratish Factura')?></span>
                    </a>
                </li>


                <li class="kt-menu__item <?= $class[3]?>" aria-haspopup="true">
                    <a href="/facturas/sent" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-folder-3"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Jo`natilgan')?></span>
                    </a>
                </li>
                <li class="kt-menu__item <?= $class[4]?>" aria-haspopup="true">
                    <a href="/facturas/received" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-folder-2"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','in_doc')?></span>
<!--                        <span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--warning">2</span></span>-->
                    </a>
                </li>
                <li class="kt-menu__item <?= $class[14]?>" aria-haspopup="true">
                    <a href="/facturas/saved" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-app"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Saqlangan')?></span>
                    </a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"><?= Yii::t('main','Dovernost')?></h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item <?= $class[5]?>" aria-haspopup="true">
                    <a href="/empowerment/create" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-add"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Yaratish Dovernost')?></span>
                    </a>
                </li>

                <li class="kt-menu__item kt-menu__item--submenu   <?= $class[6]?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-icon flaticon-folder-1
"></i>
                        <span class="kt-menu__link-text"><?= Yii::t('main','Dovernostlar')?></span>
                        <span class="kt-menu__link-badge">
<!--                            <span class="kt-badge kt-badge--brand">2</span></span>-->
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="160" style="">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="/empowerment/index" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                    <span class="kt-menu__link-text"><?= Yii::t('main','Barcha xujjatlar')?></span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="/empowerment/index-send" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                    <span class="kt-menu__link-text"><?= Yii::t('main','Jo`natilgan')?></span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="/empowerment/index-in" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                    <span class="kt-menu__link-text"><?= Yii::t('main','in_doc')?></span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="/empowerment/index-saved" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
                                    <span class="kt-menu__link-text"><?= Yii::t('main','Saqlangan')?></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

