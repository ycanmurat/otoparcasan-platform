<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
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