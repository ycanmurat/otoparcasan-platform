<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Otoparçasan - Yönetim Paneli
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="<?=base_url('assets/theme/webfont.js')?>"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<script src="https://www.google.com/recaptcha/api.js?render=<?=getenv('RECAPTCHA_SITE_KEY')?>"></script>
		<!--end::Web font -->
		<!--begin::Base Styles -->
		<link href="<?=base_url('assets/theme/')?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets/theme/')?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="<?=base_url()?>/assets/Front/js/sweetalert2.js"></script>
		<!--end::Base Styles -->
		<link rel="icon" href="<?=site_url('assets/Front/images/favicon_ops.webp')?>" type="image/x-icon" />
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(<?=base_url('assets/theme/')?>assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">

						<div class="m-login__logo">
							<a href="#">
								<img src="<?=site_url('assets/Front/images/logofinali.webp')?>" style="max-width:95%;">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Yönetici Girişi
								</h3>
							</div>
							<?if($this->session->flashdata('login_error') == 1){?>
								<div class="alert alert-warning" role="alert" style="border-radius: 25px;">
								  Girdiğiniz Bilgiler Yanlış, Lütfen Kontrol Edip Tekrar Deneyin
								</div>
							<?}elseif($this->session->flashdata('captcha_error') == 1){?>
								<div class="alert alert-warning" role="alert" style="border-radius: 25px;">
								  Robot Olmadığınızı Manuel Olarak Onaylayıp Lüften Tekrar Giriş Yapın
								</div>
							<?}?>
							<form class="m-login__form m-form" action="<?=admin_url('Login')?>" method="POST">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="E-Mail" name="user_mail" autocomplete="off" id="admin_email">
									<?=form_error('user_mail','<div class="alert alert-warning" role="alert" style="border-radius: 25px;margin-top: 10px;">','</div>')?>
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Şifre" name="password" id="admin_password">
									<?=form_error('password','<div class="alert alert-warning" role="alert" style="border-radius: 25px;margin-top: 10px;">','</div>')?>
								</div>
								<br>
								<div class="form-group m-form__group">
									<center>
										<div class="g-recaptcha" data-sitekey="<?=getenv('RECAPTCHA_SITE_KEY')?>" style="display:none;"></div>
										<input type="hidden" id="g-recaptcha-response-login" name="g-recaptcha-response-login">
									</center>
								</div>
								<div class="m-login__form-action">
									<button type="button" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" id="m_login_signin_submit" style="background-color: #4fa6d8;border-color: #178acc;">
										Giriş
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->
		<!--begin::Base Scripts -->
		<script src="<?=base_url('assets/theme/')?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="<?=base_url('assets/theme/')?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
		
		<script src="<?=site_url('assets/scripts/login.js')?>" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
