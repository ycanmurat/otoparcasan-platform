<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Şifrenizi Güncelleyin</div>
				<div class="accountArea">
					<form action="#" method="post">
						<div class="row">
							<div class="col-lg-4 col-sm-6">
								<div class="formElements">
									<label for="#">Mevcut Şifre</label>
									<input type="password" id="currentPassword">
								</div>
							</div>
							<div class="col-lg-4 col-sm-6">
								<div class="formElements">
									<label for="#">Yeni Şifre</label>
									<input type="password" id="newPassword">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="formElements">
									<label for="#">Yeni Şifre Tekrar</label>
									<input type="password" id="newPasswordRepeat">
								</div>
							</div>

							<div class="col-12">
								<div class="formElements text-right">
									<button type="button" id="updatePassword">Güncelle</button>
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