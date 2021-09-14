<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Üyelik Bilgileri</div>
				<div class="accountArea">
                    <?php if ($this->session->flashdata('userAccountUpdates')) { ?>
                        <div class="alert alert-success" role="alert">
                            Üyelik Bilgileriniz Güncellenmiştir
                        </div>
                    <?php } ?>
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
                                        <option value="0">Şehir Seçin</option>
										<?php foreach ($city as $key => $cityInfo) { ?>
											<option value="<?=$cityInfo->CityID?>" <?=($accountInformation->city==$cityInfo->CityID)?'selected':''?>><?=$cityInfo->CityName?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">İlçe</label>
									<select name="town" id="town">
										<?php foreach ($town as $key => $townInfo) { ?>
											<option value="<?=$townInfo->CountyID?>" <?=($accountInformation->town==$townInfo->CountyID)?'selected':''?>><?=$townInfo->CountyName?></option>
										<?php } ?>
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
                    <?php if ($this->session->flashdata('userCampaignUpdates')) { ?>
                        <div class="alert alert-success" role="alert">
                            Bildirim Ayarlarınız Güncellenmiştir
                        </div>
                    <?php } ?>
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