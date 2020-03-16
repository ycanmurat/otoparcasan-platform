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
				<div class="pageTitle">Iban Bilgilerim</div>
				<div class="accountArea">
					<p class="small mt-2 mb-3"><b>* </b> Sipariş iptali veya ürün iadesi nedeniyle hesabınıza geri ödeme yapılabilmesi için IBAN numaranızı seçin.<br>
						<b>* </b> Sistemde kayıtlı bir IBAN numaranızı yoksa ya da kendi adınıza ait farklı bir IBAN numarasına geri ödeme yapılmasını istiyorsanız yeni IBAN girişi alanından kayıt yapabilirsiniz. <br>
						<b>* </b> Girdiğiniz IBAN numarası vadeli bir hesaba ait olmamalıdır.
						<br>
						<b>* </b> Farklı IBAN numaraları kullanabilirsiniz ancak sadece biri aktif olabilir.(Ödemeler aktif hesap üzerinden gerçekleştirilir.) </p>
						<form action="#" method="post" class="ibanPage">
							<table class="table profileTable">
								<thead>
									<tr>
										<!--<th>Durum</th>-->
										<th style="text-align: center;">IBAN</th>
										<th style="text-align: center;">Hesap Sahibi</th>
										<th>Banka</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($ibanInformation as $key => $ibanInfo) {?>
										<tr>
											<!--<td>
												<select class="custom-select">
													<option>Aktif</option>
													<option>Pasif</option>
												</select>
											</td>-->
											<td style="text-align: center;">
												<p>TR<?=$ibanInfo->iban?></p>
											</td>
											<td style="text-align: center;">
												<?=$ibanInfo->name_surname?>
											</td>
											<td>
												<p><?=$ibanInfo->bank?></p>
												<a href="<?=site_url('Account/deleteIbanInformation/'.$ibanInfo->id)?>"><span class="button">Sil</span></a>
											</td>
										</tr>
									<?}?>
									<tr>
										<!--<td>
											<select class="custom-select" name="ibanStatus" id="ibanStatus">
												<option value="1">Aktif</option>
												<option value="2">Pasif</option>
											</select>
										</td>-->
										<td>
											<span>TR</span>
											<input class="form-control" type="text" name="ibanNumber" id="ibanNumber" placeholder="IBAN Numarası">
										</td>
										<td>
											<input class="form-control d-inline" type="text" name="ibanNameSurname" id="ibanNameSurname" placeholder="Hesap Sahibi">
										</td>
										<td>
											<input class="form-control d-inline" type="text" name="ibanBank" id="ibanBank" placeholder="Banka">
											<span class="button" id="ibanAdd">Kaydet</span>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- / pageContent -->
<!--
	<div class="row">
								
								<div class="col-lg-4">
									<div class="formElements">
										<label for="#">Iban</label>
										<input type="number" name="iban" value="" id="iban">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="formElements">
										<label for="#">Hesap Sahibi</label>
										<input type="text" name="sahip" value="" id="sahip">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="formElements">
										<label for="#">Banka</label>
										<input type="text" name="bankinfo" value="" id="bankinfo">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="formElements">
										<label for="#">Durum</label>
										<select>
											<option>Aktif</option>
											<option>Pasif</option>
										</select>
									</div>
								</div>
								<div class="col-lg-8">
									<div class="formElements">
										<button type="button" id="">Sil</button>
										<button type="button" id="updateAccount">Güncelle</button>
									</div>
								</div>
								<div class="col-12">
									<hr>
								</div>
								<div class="col-12">
									<div class="formElements mb-0 mt-3 text-right">
										<button type="button" id="">Ekle</button>
										
									</div>
								</div>
							</div>
							 -->