<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="nofollow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="icon" href="<?=site_url('assets/Front/images/favicon_ops.webp')?>" type="image/x-icon" />


	<?php if (!isset($title)) {
		$title = 'Otoparçasan Türkiyenin en hızlı yedek parçacısı';
	} ?>

	<title><?=$title?></title>

	<script src="<?=site_url('assets/Front/js/jquery.min.js')?>"></script>

	<?php if (!isset($desc)) {
		$desc = 'Description';
	} ?>
	<meta name="description" content="<?=$desc?>">

	<script src="<?=site_url('assets/Front/js/jquery.scrollTo.min.js')?>"></script>
	

	<!-- owl-carousel -->
	<link rel="stylesheet" type="text/css" href="<?=site_url('assets/Front/assets/owl-carousel/owl.carousel.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=site_url('assets/Front/assets/owl-carousel/owl.theme.default.css')?>">
	<script src="<?=site_url('assets/Front/assets/owl-carousel/owl.carousel.min.js')?>"></script>

	<!-- CheckBox Plugin -->
	<link rel="stylesheet" type="text/css" href="<?=site_url('assets/Front/assets/pretty/pretty-checkbox.min.css')?>">
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=site_url('assets/Front/assets/bootstrap/bootstrap.min.css')?>">
	<script src="<?=site_url('assets/Front/assets/bootstrap/bootstrap.min.js')?>"></script>
	
	<!-- Mail -->
	<meta name="yandex-verification" content="445e1a9bce70271a" />
	
	<!-- Swal -->
	<script src="<?=site_url('assets/Front/js/sweetalert2.js')?>"></script>

	<!-- Time -->
	<script src="<?=site_url('assets/Front/js/flipclock/flipclock.min.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?=site_url('assets/Front/js/flipclock/flipclock.css')?>"/>

	<!-- FontAwesome -->
	<link rel="stylesheet" href="<?=site_url('assets/Front/assets/font-awesome/css/font-awesome.min.css')?>">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet">


	<!-- Select2 -->
	<link rel="stylesheet" href="<?=site_url('assets/Front/assets/select2/select2.min.css')?>">
	<script src="<?=site_url('assets/Front/assets/select2/select2.min.js')?>"></script>


	<script src="<?=site_url('assets/Front/assets/select2/select2.min.js')?>"></script>

	<!-- Kodakil Logo -->
	<script src="<?=site_url('assets/Front/js/dat.js?v=0.1.2'.md5(date("y-m-d H:i:s")))?>"></script>
	<link rel="stylesheet" href="https://kodakil.com/assets/Front/images/kodakil_footer/kodakil_logo.css">

	<!-- Fix -->
	<link rel="stylesheet" href="<?=site_url('assets/Front/css/reset.css')?>">
	<link rel="stylesheet" href="<?=site_url('assets/Front/css/main.css')?>">
	<link rel="stylesheet" href="<?=site_url('assets/Front/css/animate.css')?>">
	<script src="<?=site_url('assets/Front/js/main.js')?>"></script>
	<script src="<?=site_url('assets/scripts/user.js')?>"></script>
	<script src="<?=site_url('assets/scripts/chasis.js')?>"></script>
	<script src="<?=site_url('assets/scripts/reviews.js')?>"></script>
	<script src="<?=site_url('assets/scripts/human_resources.js')?>"></script>
	<script src="<?=site_url('assets/scripts/contact.js')?>"></script>
	<!--	<script src="<?=site_url('assets/scripts/banner.js?cache'.md5(date('Y-m-d H:i:s')))?>"></script>-->


	<!-- inputmask -->
	<script src="<?=site_url('assets/Front/assets/jquery.inputmask.bundle.js')?>"></script>
	<!-- Google Chart -->
	<script type='text/javascript' src='https://www.google.com/jsapi'></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


	</head>
	<body>