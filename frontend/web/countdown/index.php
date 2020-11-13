<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76852852-5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-76852852-5');
    </script>

    <title>Online factura</title>


	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="UnNMeTh4WXRmKTgreSE9TSoGFhpZNRccZCIIKH8oI1kqGhQMYDswRg==">
    <title> Mylab - Elektron davriy jadval</title>
    <link rel="icon" type="image/png" href="favicon.png" />
    <meta name="keywords" content="Elektron, factura, schet, xisob, fatura, shot faktura">
    <meta name="description" content="Elektron xisob facturalarni almashish tizimi">
    <meta name="business:contact_data:locality" content="Tashkent">
    <meta name="business:contact_data:country_name" content="Uzbekistan">
    <meta name="business:contact_data:website" content="http://www.onlinefactura.uz">
    <meta itemprop="name" content="onlinefactura.uz">
    <meta itemprop="description" content="Электронный документооборот между компаниями">

    <meta itemprop="description" image="http://onlinefactura.uz/Bg.PNG">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="onlinefactura.uz">
    <meta name="twitter:title" content="Elekrton xisob fakturalari">
    <meta name="twitter:description" content="Xisob fakturalar almashish tizimi">

    <meta name="twitter:image:src" content="http://onlinefactura.uz/Bg.PNG">

    <meta name="twitter:domain" content="onlinefactura.uz">
    <meta name="description" content="Xisob fakturalar almashish tizimi">
    <meta name="keywords" content="Elektron, factura, schet, xisob, fatura, shot faktura">
    <meta property="og:type" content="profile">
    <meta property="og:title" charset="UTF-8" content="Xisob fakturalar almashish tizimi">
    <meta property="og:description" charset="UTF-8" content="Xisob fakturalar almashish tizimi">

    <meta property="og:image" charset="UTF-8" content="http://onlinefactura.uz/Bg.PNG">

    <meta property="og:url" content="http://onlinefactura.uz/">
    <meta property="og:site_name" content="onlinefactura.uz">
    <meta property="og:site_name" content="http://www.onlinefactura.uz">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
$now = time(); // or your date as well
$your_date = strtotime("2020-01-01");
$datediff =  $your_date - $now;
$sec = $datediff;
$minut = round($datediff / (60));
$hour = round($datediff / (60 * 60));
$day = round($datediff / (60 * 60 * 24));

$hour = $hour - ($day*24);
//$minut = $minut - (($day*24*60)+($hour*60));
$sec = $sec - (($day*24*60*60)+($hour*60*60));

//echo "Kun:".$day." Soat :".$hour." Minut:".$minut." Sec:".$sec;
?>
	
	<div class="bg-img1 overlay1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background-image: url('images/bg01.jpg');">
		<div class="wsize1">
			<p class="txt-center p-b-23">
				<img src="/images/only_logo.png" width="120px">
			</p>

			<h3 class="l1-txt1 txt-center p-b-22">
				Online Factura
			</h3>

			<p class="txt-center m2-txt1 p-b-67">
                Наш сайт находится в стадии разработки, следите за обновлениями!
			</p>

			<div class="flex-w flex-sa-m cd100 bor1 p-t-42 p-b-22 p-l-50 p-r-50 respon1">
				<div class="flex-col-c-m wsize2 m-b-20">
					<span class="l1-txt2 p-b-4 days"><?= $day?>></span>
					<span class="m2-txt2">дней</span>
				</div>

				<span class="l1-txt2 p-b-22">:</span>
				
				<div class="flex-col-c-m wsize2 m-b-20">
					<span class="l1-txt2 p-b-4 hours"><?= $hour?></span>
					<span class="m2-txt2">часов</span>
				</div>

				<span class="l1-txt2 p-b-22 respon2">:</span>

				<div class="flex-col-c-m wsize2 m-b-20">
					<span class="l1-txt2 p-b-4 minutes"><?= $minut?></span>
					<span class="m2-txt2">минут</span>
				</div>

				<span class="l1-txt2 p-b-22">:</span>

				<div class="flex-col-c-m wsize2 m-b-20">
					<span class="l1-txt2 p-b-4 seconds">00</span>
					<span class="m2-txt2">секунд</span>
				</div>
			</div>

			<form class="flex-w flex-c-m contact100-form validate-form p-t-70">
				<div class="wrap-input100 validate-input where1" data-validate = "Email is required: ex@abc.xyz">
					<input class="s1-txt1 placeholder0 input100" type="text" name="email" placeholder="Адрес электронной почты">
					<span class="focus-input100"></span>
				</div>

				<button class="flex-c-m s1-txt1 size2 how-btn trans-04 where1">
                    Уведомить меня
				</button>
			</form>			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/moment.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>

	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: <?= $day?>,
			endtimeHours: <?= $hour ?>,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: ""
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>