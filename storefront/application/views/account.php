<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span></div>
						<div class="user-mail"><?=$userInfo->email?></div>
					</div>
					<div class="panel-content">
						<a href="<?=site_url('Account')?>" class="panel-link <?=($tabPanel=='account')?'Active':''?>">
							<div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>
							Üyelik Bilgilerim
						</a>
						<a href="<?=site_url('Account/password')?>" class="panel-link <?=($tabPanel=='password')?'Active':''?>">
							<div class="Icon"><i class="fa fa-key" aria-hidden="true"></i></div>
							Şifre Güncelleme
						</a>
						<a href="<?=site_url('Account/orders')?>" class="panel-link <?=($tabPanel=='orders')?'Active':''?>">
							<div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
							Siparişlerim<span class="Count">122</span>
						</a>
						<a href="<?=site_url('Account/returns')?>" class="panel-link <?=($tabPanel=='returns')?'Active':''?>">
							<div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>
							İadelerim<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/questions')?>" class="panel-link <?=($tabPanel=='questions')?'Active':''?>">
							<div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
							Ürün Sorularım<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/address')?>" class="panel-link <?=($tabPanel=='address')?'Active':''?>">
							<div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
							Adreslerim
						</a>
						<a href="<?=site_url('Account/favorite')?>" class="panel-link <?=($tabPanel=='favorite')?'Active':''?> ">
							<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
							Favorilerim
						</a>
						<a href="<?=site_url('Account/garage')?>" class="panel-link <?=($tabPanel=='garage')?'Active':''?>">
							<div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>
							Garajım
						</a>
						<a href="<?=site_url('Account/iban')?>" class="panel-link <?=($tabPanel=='iban')?'Active':''?>">
							<div class="Icon"><i class="fa fa-bank" aria-hidden="true"></i></div>
							IBAN Bilgilerim
						</a>
						<a href="<?=site_url('Account/transfer')?>" class="panel-link <?=($tabPanel=='transfer')?'Active':''?>">
							<div class="Icon"><i class="fa fa-exchange" aria-hidden="true"></i></div>
							Havale Ödeme Bildirimi
						</a>
						<a href="<?=site_url('Account/coupon')?>" class="panel-link <?=($tabPanel=='coupon')?'Active':''?>">
							<div class="Icon"><i class="fa fa-money" aria-hidden="true"></i></div>
							Kuponlarım
						</a>
						<a href="<?=site_url('User/logout')?>" class="panel-link">
							<div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
							Çıkış Yap
						</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Üyelik Bilgileri</div>
				<div class="accountArea">
					<form action="#" method="post">
						<div class="row">
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Adı</label>
									<input type="text" name="name" value="<?=$accountInformation->name?>" id="name">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Soyadı</label>
									<input type="text" name="surname" value="<?=$accountInformation->surname?>" id="surname">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Cep Telefonu</label>
									<input type="tel" name="phone" value="<?=$accountInformation->phone?>" id="phone">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">E-Mail Adresi</label>
									<input type="email" name="email" value="<?=$accountInformation->email?>" id="email">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">İl</label>
									<select name="city" id="city">
										<?foreach ($city as $key => $cityInfo) {?>
											<option value="<?=$cityInfo->CityID?>" <?=($accountInformation->city==$cityInfo->CityID)?'selected':''?>><?=$cityInfo->CityName?></option>
										<?}?>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">İlçe</label>
									<select name="town" id="town">
										<?foreach ($town as $key => $townInfo) {?>
											<option value="<?=$townInfo->CountyID?>" <?=($accountInformation->town==$townInfo->CountyID)?'selected':''?>><?=$townInfo->CountyName?></option>
										<?}?>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Doğum Tarihi</label>
									<input type="text" name="date_of_birth" value="<?=$accountInformation->date_of_birth?>" id="date_of_birth">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Cinsiyet</label>
									<select name="gender" id="gender">
										<option value="Erkek" <?=($accountInformation->gender=="Erkek")?'selected':''?>>Erkek</option>
										<option value="Kadın" <?=($accountInformation->gender=="Kadın")?'selected':''?>>Kadın</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="formElements mb-0 mt-3 text-right">
									<button type="button" id="updateAccount">Güncelle</button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="pageTitle">Bildirim Ayarları</div>
				<div class="accountArea">
					<form action="#" method="post">
						<div class="row">
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="campaign_email" type="checkbox" <?=($notification->campaign_email==1)?'checked="true"':''?>>
									<label for="campaign_email" style="font-size:14px;">Kampanyalardan E-Posta Yoluyla Haberdar Olmak istiyorum.</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="campaign_sms" type="checkbox" <?=($notification->campaign_sms==1)?'checked="true"':''?>>
									<label for="campaign_sms" style="font-size:14px;">Kampanyalardan SMS Yoluyla Haberdar Olmak İstiyorum.</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="basket_email" type="checkbox" <?=($notification->basket_email==1)?'checked="true"':''?>>
									<label for="basket_email" style="font-size:14px;">Sepetimdeki Ürünlerin E-Posta Yoluyla Hatırlatılmasını İstiyorum.</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="cargo_sms" type="checkbox" <?=($notification->cargo_sms==1)?'checked="true"':''?>>
									<label for="cargo_sms" style="font-size:14px;">Kargo Bilgilerimi SMS Yoluyla Almak İstiyorum.</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="favorites_product_email" type="checkbox" <?=($notification->favorites_product_email==1)?'checked="true"':''?>>
									<label for="favorites_product_email" style="font-size:14px;">İzlediğim Ürünlerle İlgili E-Posta Almak İstiyorum.</label>
								</div>
							</div>
							<div class="col-lg-12 col-md-6" style="margin-bottom: 5px;">
								<div class="checkItem">
									<input class="styled-checkbox" id="marketing_call" type="checkbox" <?=($notification->marketing_call==1)?'checked="true"':''?>>
									<label for="marketing_call" style="font-size:14px;">Pazarlama Faaliyetlerinin Telefon Yoluyla Yapılmasını İstiyorum.</label>
								</div>
							</div>
							<div class="col-12">
								<div class="formElements mb-0 mt-3 text-right">
									<button type="button" id="notification_settings_update">Güncelle</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->