<?php
use cabinet\models\Components;
?>
<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <!-- begin:: Aside -->
    <div class="kt-header__brand kt-grid__item  " id="kt_header_brand">
        <div class="kt-header__brand-logo animated flip">
            <a href="/">
                <img alt="Logo" src="/img/favicon.png" width="55px" />
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Title -->
    <div class="headerComapnArea">
        <div class="CompanyNameArea">
            <?php if(Components::CompanyData('is_online')!==1){ ?>
            <button type="button"
                    class="btn btn-warning btn-elevate-hover btn-circle btn-icon animated heartBeat kt-pulse kt-pulse--danger"
                    data-toggle="kt-tooltip"
                    data-placement="bottom" title=""
                    data-skin="dark"
                    data-original-title="<?= Yii::t('main','Sizga shu tizimdan xujjatlar kelib tushishi uchun quydagi tugani bosing va tasdiqlang')?>" onclick="BindProvider()">
                <i class="la la-check-circle-o"></i>
                <span class="kt-pulse__ring"></span>
            </button>
            <?php }?>
            <?php

                $cntCompany = \common\models\CompanyUsers::find()
                    ->select("cu.*, c.name")
                    ->from(\common\models\CompanyUsers::tableName() . ' cu')
                    ->innerJoin(\common\models\Company::tableName() . ' c', 'c.id=cu.company_id')
                    ->andWhere(['cu.users_id' => Yii::$app->user->id, 'cu.enabled' => 1]);

            if($cntCompany->count()>1){
            ?>
            <select class="form-control" onchange="location.href='/doc/change?id='+this.value" style="font-size: 22px;color:black;height: 40px;padding-top: 4px;padding-left: 5px;">
                <?php foreach ($cntCompany->all() as $items){ ?>
                <option value="<?= $items->id ?>" <?= $items->company_id==Components::GetId()?'selected':'' ?>> <?= $items->name ?></option>
                <?php }?>
            </select>

            <?php } else {?>
            <?= Components::CompanyData('name')?>
            <?php }?>
        </div>
        <div class="CompanyInfoArea">
            <span>
                <i class="flaticon-coins"></i>
                <?= Yii::t('main','STIR')?> <?= Components::CompanyData('tin')?>

            </span>
            <span>
                <i class="flaticon-coins"></i>
                <?= Yii::t('main','Hisobda: <b>{sum}</b> so`m',['sum'=>number_format(Components::getSum(),2)])?>
            </span>
            <span>
                <a href="/invoices/payme" class="btn btn-outline-brand btn-sm btn-elevate btn-icon-sm" style="font-size: 10px;

padding: 3px 10px;">
                                <i class="flaticon-coins"></i>
                                <?= Yii::t('main','Xisobni to`ldirish')?>
                            </a>
                <a href="/site/oferta" class="btn btn-outline-warning btn-sm btn-elevate btn-icon-sm" style="font-size: 10px;

padding: 3px 10px;">
                                <i class="flaticon-interface-10"></i>
                                <?= Yii::t('main','Oferta')?>
                            </a>
            </span>

        </div>
    </div>

    <!-- end:: Title -->

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

        </div>
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <!--begin: Search -->
<!--        <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">-->
<!--            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">-->
<!--                <span class="kt-header__topbar-icon"><i class="flaticon2-search-1"></i></span>-->
<!--            </div>-->
<!--            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">-->
<!--                <div class="kt-quick-search kt-quick-search--inline" id="kt_quick_search_inline">-->
<!--                    <form method="get" class="kt-quick-search__form">-->
<!--                        <div class="input-group">-->
<!--                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>-->
<!--                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">-->
<!--                            <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!--end: Search -->
       
        <!--end: Notifications -->

        <!--begin: Quick actions -->
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon kt-header__topbar-icon--warning"><i class="fa fa-cart-arrow-down"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <form>

                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark" style="background-image: url(/themes/media/misc/bg-1.jpg)">
                        <h3 class="kt-head__title">
                            <i class="fa fa-cart-arrow-down"></i> <?= Yii::t('main','Tizim sozlamalari')?>
                        </h3>
                    </div>

                    <!--end: Head -->

                    <!--begin: Grid Nav -->
                    <div class="kt-grid-nav kt-grid-nav--skin-light">
                        <div class="kt-grid-nav__row">
                            <a href="/invoices" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect id="bound" x="0" y="0" width="24" height="24" />
																<path d="M4.3618034,10.2763932 L4.8618034,9.2763932 C4.94649941,9.10700119 5.11963097,9 5.30901699,9 L15.190983,9 C15.4671254,9 15.690983,9.22385763 15.690983,9.5 C15.690983,9.57762255 15.6729105,9.65417908 15.6381966,9.7236068 L15.1381966,10.7236068 C15.0535006,10.8929988 14.880369,11 14.690983,11 L4.80901699,11 C4.53287462,11 4.30901699,10.7761424 4.30901699,10.5 C4.30901699,10.4223775 4.32708954,10.3458209 4.3618034,10.2763932 Z M14.6381966,13.7236068 L14.1381966,14.7236068 C14.0535006,14.8929988 13.880369,15 13.690983,15 L4.80901699,15 C4.53287462,15 4.30901699,14.7761424 4.30901699,14.5 C4.30901699,14.4223775 4.32708954,14.3458209 4.3618034,14.2763932 L4.8618034,13.2763932 C4.94649941,13.1070012 5.11963097,13 5.30901699,13 L14.190983,13 C14.4671254,13 14.690983,13.2238576 14.690983,13.5 C14.690983,13.5776225 14.6729105,13.6541791 14.6381966,13.7236068 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
																<path d="M17.369,7.618 C16.976998,7.08599734 16.4660031,6.69750122 15.836,6.4525 C15.2059968,6.20749878 14.590003,6.085 13.988,6.085 C13.2179962,6.085 12.5180032,6.2249986 11.888,6.505 C11.2579969,6.7850014 10.7155023,7.16999755 10.2605,7.66 C9.80549773,8.15000245 9.45550123,8.72399671 9.2105,9.382 C8.96549878,10.0400033 8.843,10.7539961 8.843,11.524 C8.843,12.3360041 8.96199881,13.0779966 9.2,13.75 C9.43800119,14.4220034 9.7774978,14.9994976 10.2185,15.4825 C10.6595022,15.9655024 11.1879969,16.3399987 11.804,16.606 C12.4200031,16.8720013 13.1129962,17.005 13.883,17.005 C14.681004,17.005 15.3879969,16.8475016 16.004,16.5325 C16.6200031,16.2174984 17.1169981,15.8010026 17.495,15.283 L19.616,16.774 C18.9579967,17.6000041 18.1530048,18.2404977 17.201,18.6955 C16.2489952,19.1505023 15.1360064,19.378 13.862,19.378 C12.6999942,19.378 11.6325049,19.1855019 10.6595,18.8005 C9.68649514,18.4154981 8.8500035,17.8765035 8.15,17.1835 C7.4499965,16.4904965 6.90400196,15.6645048 6.512,14.7055 C6.11999804,13.7464952 5.924,12.6860058 5.924,11.524 C5.924,10.333994 6.13049794,9.25950479 6.5435,8.3005 C6.95650207,7.34149521 7.5234964,6.52600336 8.2445,5.854 C8.96550361,5.18199664 9.8159951,4.66400182 10.796,4.3 C11.7760049,3.93599818 12.8399943,3.754 13.988,3.754 C14.4640024,3.754 14.9609974,3.79949954 15.479,3.8905 C15.9970026,3.98150045 16.4939976,4.12149906 16.97,4.3105 C17.4460024,4.49950095 17.8939979,4.7339986 18.314,5.014 C18.7340021,5.2940014 19.0909985,5.62999804 19.385,6.022 L17.369,7.618 Z" id="C" fill="#000000" />
															</g>
														</svg> </span>
                                <span class="kt-grid-nav__title"><?= Yii::t('main','To`lov tarixi')?></span>
                                <span class="kt-grid-nav__desc"><?= Yii::t('main','to`lovlar va xarajatlar')?></span>
                            </a>
                            <a href="/doc/tarif" class="kt-grid-nav__item">
													<span class="kt-grid-nav__icon">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--lg">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect id="bound" x="0" y="0" width="24" height="24" />
																<path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" id="Combined-Shape" fill="#000000" />
																<path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" id="Path" fill="#000000" opacity="0.3" />
															</g>
														</svg> </span>
                                <span class="kt-grid-nav__title"><?= Yii::t('main','Tariflar')?></span>
                                <span class="kt-grid-nav__desc"><?= Yii::t('main','Tariflarni o`zgartirish va tanlash')?></span>
                            </a>
                        </div>

                    </div>

                    <!--end: Grid Nav -->
                </form>
            </div>
        </div>

        <!--end: Quick actions -->


        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
										<img class="" src="/img/<?= Yii::$app->language ?>.png" alt="" />
									</span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <li class="kt-nav__item <?= (Yii::$app->language=="uz")?'kt-nav__item--active':'' ?>">
                        <a href="https://cabinet.onlinefactura.uz/uz" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="/img/uzbekistan.png" alt="" /></span>
                            <span class="kt-nav__link-text">УЗБ</span>
                        </a>
                    </li>
                    <li class="kt-nav__item <?= (Yii::$app->language=="oz")?'kt-nav__item--active':'' ?>">
                        <a href="https://cabinet.onlinefactura.uz/oz" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="/img/uzbekistan.png" alt="" /></span>
                            <span class="kt-nav__link-text">O'ZB</span>
                        </a>
                    </li>
                    <li class="kt-nav__item <?= (Yii::$app->language=="ru")?'kt-nav__item--active':'' ?>">
                        <a href="https://cabinet.onlinefactura.uz/ru" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><img src="/img/russia.png" alt="" /></span>
                            <span class="kt-nav__link-text">РУС</span>
                        </a>
                    </li>


                </ul>
            </div>


        </div>

        <!--end: Language bar -->

        <!--begin: User bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                <span class="kt-hidden kt-header__topbar-username">Nick</span>
<!--                <img class="kt-hidden" alt="Pic" src="/themes/media/users/300_21.jpg" />-->
                <span class="kt-header__topbar-icon kt-hidden-"><i class="flaticon2-user-outline-symbol"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(/themes/media/misc/bg-1.jpg)">
                    <div class="kt-user-card__avatar">
<!--                        <img class="kt-hidden" alt="Pic" src="/themes/media/users/300_25.jpg" />-->

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
                            <?= mb_substr(Yii::$app->user->identity->fio,0,1)?>
                        </span>
                    </div>
                    <div class="kt-user-card__name">
                        <?= Yii::$app->user->identity->fio ?>
                    </div>
                    <div class="kt-user-card__badge">

                    </div>
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="/users/update" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                <?= Yii::t('main','Мой профиль')?>
                            </div>
                            <div class="kt-notification__item-time">
                                <?= Yii::t('main','Настройки учетной записи и многое другое')?>
                            </div>
                        </div>
                    </a>
                    <a href="/company-users/index" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                <?= Yii::t('main','Foydalanuvchilar')?>
                            </div>
                            <div class="kt-notification__item-time">
                                <?= Yii::t('main','Korxona nomidan ish olib borishga ruxsat etilgan foydalanuvchilar')?>
                            </div>
                        </div>
                    </a>

                    <div class="kt-notification__custom">
                        <a href="/site/logout" class="btn btn-label-brand btn-sm btn-bold"><?= Yii::t('main','Chiqish')?></a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User bar -->


        <!--end: Quick panel toggler -->
    </div>

    <!-- end:: Header Topbar -->
</div>
