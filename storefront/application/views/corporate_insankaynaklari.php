<!-- pageContent -->
<section class="pageContent p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="offerform">
					<div class="pageTitle">İnsan Kaynakları</div>
					<div class="textArea">
						<h6>OTOPARÇASANDAKİ AÇIK POZİSYONLAR VE STAJ FIRSATLARI</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ante odio, maximus id pulvinar a, vestibulum ac massa. Curabitur at tincidunt mi. Nunc maximus sem ipsum, maximus dictum mi sagittis eget. Nunc sagittis maximus orci vel imperdiet. Curabitur sollicitudin consequat elit. Duis aliquet ultrices leo. Vivamus pellentesque lacus metus, sit amet semper lectus auctor at. Praesent dignissim ultrices enim non dignissim. Integer congue dignissim libero, non bibendum odio maximus a. Curabitur interdum dolor vitae leo mollis euismod. Donec tincidunt neque leo, in auctor massa posuere sed. Nullam sit amet egestas leo, venenatis aliquet nisl. Vivamus sit amet ipsum lobortis purus ullamcorper posuere.</p>
						<h6>OTOPARÇASANDAKİ AÇIK POZİSYONLAR VE STAJ FIRSATLARI</h6>
						<p>Quisque vitae molestie ante, vitae pellentesque nibh. Maecenas sed consectetur leo. Quisque non enim ac augue euismod efficitur ut a tortor. Suspendisse potenti. Nulla pretium, enim vel molestie bibendum, nisl felis feugiat metus, in molestie diam sem vitae arcu. Sed id nisi non elit euismod cursus sit amet in ipsum. Suspendisse non maximus est. Maecenas venenatis ornare interdum.</p>
					</div>
					<div class="pageTitle mt-3">Başvuru Formu</div>
					<div class="formArea ">
						<form class="insankaynaklari" action="<?=site_url('Corporate/insankaynaklari')?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-12">
									<div class="avatar-upload">
										<div class="avatar-edit">
											<input type='file' name="user_file" id="imageUpload" accept=".png, .jpg, .jpeg" />
											<label for="imageUpload"></label>
										</div>
										<center>Fotoğraf Ekleyin</center>
										<div class="avatar-preview">
											<div id="imagePreview" style="background-image: url('https://otoparcasan.kodakil.com/assets/Front/images/Icons/uprofile.png');">
											</div>
										</div>
									</div>
									<?=(!empty($this->session->flashdata('image_error')))?'<div style="max-width: 449px;margin: 0 auto;" class="alert alert-danger"  role="alert">'.$this->session->flashdata('image_error').'</div>':''?>
								</div>
								<div class="col-12">
									<div class="pageTitle mt-3">Kişisel Bilgiler</div>
								</div>
								<div class="col-sm-6">
									<label>Ad Soyad</label>
									<input type="text" placeholder="Ad Soyad" value="<?=set_value('name_surname')?>" name="name_surname">
									<?=form_error('name_surname', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-sm-6">
									<label>T.C Kimlik No</label>
									<input type="number" placeholder="TC Kimlik No" name="identification_number" value="<?=set_value('identification_number')?>">
									<?=form_error('identification_number', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-sm-6">
									<label>E-Posta</label>
									<input type="email" placeholder="E-Posta" name="email" value="<?=set_value('email')?>">
									<?=form_error('email', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-sm-6">
									<label>Telefon</label>
									<input type="tel" placeholder="Telefon" name="phone" value="<?=set_value('phone')?>">
									<?=form_error('phone', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-6">
									<label>Cinsiyetiniz</label>
									<select name="gender">
										<option value="">Seçiniz</option>
										<option value="1" <?=!empty(set_value('gender') && set_value('gender') == 1)?'selected':''?>>Kadın</option>
										<option value="2" <?=!empty(set_value('gender') && set_value('gender') == 2)?'selected':''?>>Erkek</option>
									</select>
									<?=form_error('gender', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-6">
									<label>Medeni Durumu</label>
									<select name="marital_status">
										<option value="">Seçiniz</option>
										<option value="1" <?=!empty(set_value('marital_status') && set_value('marital_status') == 1)?'selected':''?>>Evli</option>
										<option value="2" <?=!empty(set_value('marital_status') && set_value('marital_status') == 2)?'selected':''?>>Bekar</option>
									</select>
									<?=form_error('marital_status', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-sm-6">
									<label>Askerlik Durumu</label>
									<select name="military_status">
										<option value="">Seçiniz</option>
										<option value="1" <?=!empty(set_value('military_status') && set_value('military_status') == 1)?'selected':''?>>Yapmadı</option>
										<option value="2" <?=!empty(set_value('military_status') && set_value('military_status') == 2)?'selected':''?>>Yaptı</option>
										<option value="3" <?=!empty(set_value('military_status') && set_value('military_status') == 3)?'selected':''?>>Muaf</option>
									</select>
									<?=form_error('military_status', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-sm-6">
									<label>Eğitim Durumu</label>
									<select name="educational_status">
										<option value="">Seçiniz</option>
										<option value="1" <?=!empty(set_value('educational_status') && set_value('educational_status') == 1)?'selected':''?>>İlkokul</option>
										<option value="2" <?=!empty(set_value('educational_status') && set_value('educational_status') == 2)?'selected':''?>>Lise</option>
										<option value="3" <?=!empty(set_value('educational_status') && set_value('educational_status') == 3)?'selected':''?>>Üniversite</option>
										<option value="4" <?=!empty(set_value('educational_status') && set_value('educational_status') == 4)?'selected':''?>>Yüksek Lisans ve Üstü</option>
									</select>
									<?=form_error('educational_status', '<div class="alert alert-danger" role="alert">', '</div>');?>
								</div>
								<div class="col-12">
									<div class="pageTitle mt-3">Doğum Tarihi ve Yeri</div>
								</div>
								<div class="col-sm-6">
									<label>Yaşadığınız Şehir</label>
									<select name="city_id" id="city">
										<option value="">İl</option>
										<?foreach ($city as $key => $cityInfo) {?>
											<option value="<?=$cityInfo->CityID?>" <?=(!empty(set_value('city_id')) && set_value('city_id') == $cityInfo->CityID)?'selected':''?>><?=$cityInfo->CityName?></option>
											<?}?>
										</select>
										<?=form_error('city_id', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Doğum Tarihi</label>
										<input type="date" placeholder="Doğum Tarihi" name="birth_date" value="<?=set_value('birth_date')?>">
										<?=form_error('birth_date', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Yaşadığınız İlçe</label>
										<select name="town_id" id="town">
											<option value="">Seçiniz</option>
										</select>
										<?=form_error('town_id', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Ev Adresiniz</label>
										<input type="text" placeholder="Ev Adresi" name="address" value="<?=set_value('address')?>">
										<?=form_error('address', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<div class="pageTitle mt-3">Eğitim Geçmişi</div>
									</div>
									<div class="col-md-3 col-6">
										<label>Okul</label>
										<input type="text" placeholder="Okul Adı" name="education_school" value="<?=set_value('education_school')?>">
										<?=form_error('education_school', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3 col-6">
										<label>Bölüm</label>
										<input type="text" placeholder="Bölüm" name="education_department" value="<?=set_value('education_department')?>">
										<?=form_error('education_department', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3 col-6">
										<label>Başlangıç</label>
										<input type="date" placeholder="Başlama Tarihi" name="education_start_date" value="<?=set_value('education_start_date')?>">
										<?=form_error('education_start_date', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3 col-6">
										<label>Bitiş</label>
										<input type="date" placeholder="Bitiş Tarihi" name="education_end_date" value="<?=set_value('education_end_date')?>">
										<?=form_error('education_end_date', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-12 d-sm-none d-block">
										<hr>
									</div>
									<div class="col-12">
										<div class="pageTitle mt-3">İş Geçmişi</div>
									</div>
									<div class="col-12">
										<label>İşyeri</label>
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="İşyerinin adı" name="job_name" value="<?=set_value('job_name')?>">
										<?=form_error('job_name', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="Görev" name="job_mission" value="<?=set_value('job_mission')?>">
										<?=form_error('job_mission', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-2">
										<input type="date" placeholder="Başlama Tarihi" name="job_start_date" value="<?=set_value('job_start_date')?>">
										<?=form_error('job_start_date', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-2">
										<input type="date" placeholder="Bitiş Tarihi" name="job_end_date" value="<?=set_value('job_end_date')?>">
										<?=form_error('job_end_date', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-4">
										<input type="text" placeholder="Ayrılma Sebebi" name="job_reason" value="<?=set_value('job_reason')?>">
										<?=form_error('job_reason', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<div class="pageTitle mt-3">Referanslar</div>
									</div>
									<div class="col-12">
										<label>Referans</label>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Ad Soyad" name="r1_name_surname" value="<?=set_value('r1_name_surname')?>">
										<?=form_error('r1_name_surname', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="İşyeri" name="r1_job" value="<?=set_value('r1_job')?>">
										<?=form_error('r1_job', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Görevi" name="r1_mission" value="<?=set_value('r1_mission')?>">
										<?=form_error('r1_mission', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Telefonu" name="r1_phone" value="<?=set_value('r1_phone')?>">
										<?=form_error('r1_phone', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<label>Referans</label>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Ad Soyad" name="r2_name_surname" value="<?=set_value('r2_name_surname')?>">
										<?=form_error('r2_name_surname', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="İşyeri" name="r2_job" value="<?=set_value('r2_job')?>">
										<?=form_error('r2_job', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Görevi" name="r2_mission" value="<?=set_value('r2_mission')?>">
										<?=form_error('r2_mission', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Telefonu" name="r2_phone" value="<?=set_value('r2_phone')?>">
										<?=form_error('r2_phone', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<label>Referans</label>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Ad Soyad" name="r3_name_surname" value="<?=set_value('r3_name_surname')?>">
										<?=form_error('r3_name_surname', '<div class="alert alert-danger" role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="İşyeri" name="r3_job" value="<?=set_value('r3_job')?>">
										<?=form_error('r3_job', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Görevi" name="r3_mission" value="<?=set_value('r3_mission')?>">
										<?=form_error('r3_mission', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-md-3">
										<input type="text" placeholder="Telefonu" name="r3_phone" value="<?=set_value('r3_phone')?>">
										<?=form_error('r3_phone', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<div class="pageTitle mt-3">Diğer Bilgiler</div>
									</div>
									<div class="col-sm-6">
										<label>Sigara Kullanıyor musunuz ?</label>
										<select name="smoke">
											<option value="">Seçiniz</option>
											<option value="1" <?=!empty(set_value('smoke') && set_value('smoke') == 1)?'selected':''?>>Evet</option>
											<option value="2" <?=!empty(set_value('smoke') && set_value('smoke') == 2)?'selected':''?>>Hayır</option>
											<option value="3" <?=!empty(set_value('smoke') && set_value('smoke') == 3)?'selected':''?>>Çok Nadir</option>
										</select>
										<?=form_error('smoke', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Ehliyetiniz Var mı ?</label>
										<select name="driving_licence">
											<option value="">Seçiniz</option>
											<option value="1" <?=!empty(set_value('driving_licence') && set_value('driving_licence') == 1)?'selected':''?>>Var</option>
											<option value="2" <?=!empty(set_value('driving_licence') && set_value('driving_licence') == 2)?'selected':''?>>Yok</option>
										</select>
										<?=form_error('driving_licence', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Çalışmak İstediğiniz Pozisyon</label>
										<select name="position">
											<option value="">Seçiniz</option>
											<?foreach ($positions as $key => $posInfo) {?>
												<option value="<?=$posInfo->id?>" <?=!empty(set_value('position') && set_value('position') == $posInfo->id)?'selected':''?>><?=$posInfo->name?></option>
											<?}?>
										</select>
										<?=form_error('position', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-sm-6">
										<label>Beklenen Ücret (Net) ?</label>
										<input type="number" placeholder="TL" name="fee" value="<?=set_value('fee')?>">
										<?=form_error('fee', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-12">
										<label>Eklemek İstedikleriniz</label>
										<textarea id="dearlership_note" placeholder="Eklemek İstediklerinizi yazınız." name="message"><?=set_value('message')?></textarea>
										<?=form_error('message', '<div class="alert alert-danger role="alert">', '</div>');?>
									</div>
									<div class="col-12 text-center">
										<input class="corporate-human-button" type="submit" value="Formu Gönder">
										<!--<button type="button">Formu Gönder</button>-->
										<?=(!empty($this->session->flashdata('success'))==1)?'<div class="alert alert-success role="alert">Bilgilerinizi Aldık En Kısa Sürede Size Geri Dönüş Sağlayacağız.</div>':''?>
										<?=(!empty($this->session->flashdata('danger'))==2)?'<div class="alert alert-danger role="alert">Girdiğiniz Bilgilerde Hala Bir Sorun Bulunuyor Lütfen Daha Sonra Tekrar Deneyin</div>':''?>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>