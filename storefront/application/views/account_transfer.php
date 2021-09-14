<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Havale Ödeme Bildirimi</div>
				<div class="accountArea">
					<p class="small mb-3">Alışverişiniz sonrasında banka hesaplarımıza Havale ya da EFT yolu ile ödeme gerçekleştirdiyseniz, lütfen aşağıdaki form
					aracılığıyla bizleri bu ödeme veya ödemelerden haberdar ediniz.</p>
					<form action="#" method="post">
						<div class="row">
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">Ad Soyad</label>
									<input type="text" name="transferNameSurname" id="transferNameSurname">
								</div>
							</div>
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">E-Posta</label>
									<input type="text" name="transferEmail" id="transferEmail">
								</div>
							</div>
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">Telefon</label>
									<input type="tel" name="transferPhone" id="transferPhone">
								</div>
							</div>
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">Sipariş Numarası</label>
									<input type="number" name="transferOrderNumber" id="transferOrderNumber">
								</div>
							</div>
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">Banka</label>
									<select name="transferBankId" id="transferBankId">
										<option value="1">Banka 1</option>
										<option value="2">Banka 2</option>
										<option value="3">Banka 3</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 ">
								<div class="formElements">
									<label for="#">Havale-EFT Tutarı</label>
									<input type="number" name="transferAmount" id="transferAmount">
								</div>
							</div>
							<div class="col-12">
								<div class="formElements">
									<label for="#">Mesajınız</label>
									<input type="text" name="transferMessage" placeholder="Mesaj.." id="transferMessage">
								</div>
							</div>
							<div class="col-12">
								<hr>
							</div>
							<div class="col-12">
								<div class="formElements mb-0 mt-3 text-right">
									<button type="button" id="transferAddInformation">Gönder</button>
								</div>
							</div>
						</div>
					</form>

					<div class="pageTitle">Geçmiş Havale Ödeme Bildirimleri</div>
							<form action="#" method="post" class="ibanPage">
								<table class="table profileTable">
									<thead>
										<tr>
											<th style="text-align: center;">Ad Soyad</th>
											<th style="text-align: center;">Sipariş Numarası</th>
											<th style="text-align: center;">Havale-EFT Tutarı</th>
											<th>İşlem</th>
										</tr>
									</thead>
									<tbody>
										<?foreach ($transferInformation as $key => $transferInfo) {?>
											<tr>
												<td style="text-align: center;">
													<p><?=$transferInfo->name_surname?></p>
												</td>
												<td style="text-align: center;">
													<?=$transferInfo->order_number?>
												</td>
												<td style="text-align: center;">
													<?=$transferInfo->amount?>
												</td>
												<td>
													<span data-toggle="modal" data-target="#havaleFormModal-<?=$transferInfo->id?>" aria-hidden="true" class="button" >Detaylar</span>
													<a href="<?=site_url('Account/deleteTransfer/'.$transferInfo->id)?>"><span class="button" >Sil</span></a>
												</td>
											</tr>
										<?}?>
								</tbody>
							</table>
						</form>

				</div>
			</div>

		</div>

	</div>
</div>
</div>
</section>
<!-- / pageContent -->
<?foreach ($transferInformation as $key => $transferInfo) {?>
<!-- Modal -->
<div class="modal fade" id="havaleFormModal-<?=$transferInfo->id?>" tabindex="-1" role="dialog" aria-labelledby="havaleFormModalLongTitle">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><?=$transferInfo->order_number?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="offerform">
					<div class="formArea">
						<div class="row">
							<div class="col-12">
								<p class="quest">Ad Soyad - <b><?=$transferInfo->name_surname?></b></p>
								<p class="quest" style="margin-top: 30px;">E-Posta - <b><?=$transferInfo->email?></b></p>
								<p class="quest" style="margin-top: 30px;">Telefon - <b><?=$transferInfo->phone?></b></p>
								<p class="quest" style="margin-top: 30px;">Sipariş Numarası - <b><?=$transferInfo->order_number?></b></p>
								<p class="quest" style="margin-top: 30px;">Banka - <b><?=$transferInfo->bank_id?></b></p>
								<p class="quest" style="margin-top: 30px;">Havale-EFT Tutarı - <b><?=$transferInfo->amount?></b></p>
								<p class="quest" style="margin-top: 30px;">Mesajınız - <b><?=$transferInfo->message?></b></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?}?>