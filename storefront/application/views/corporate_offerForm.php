
<!-- pageContent -->
<section class="pageContent p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="offerform">
					<div class="pageTitle">Toplu Parça Teklif Formu</div>
					<p class="mt-2 mb-3 small">Lorem ipsum Dolor site amet  Lorem ipsum Dolor site amet Lorem ipsum Dolor site amet Lorem ipsum Dolor site ametLorem ipsum Dolor site amet Lorem ipsum Dolor site amet  Lorem ipsum Dolor site amet Lorem ipsum Dolor site amet Lorem ipsum Dolor site ametLorem ipsum Dolor site amet</p>
					<div class="formArea">
						<form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-4">
										<input type="text" placeholder="Ad Soyad" value="<?php echo set_value('name_surname'); ?>" name="name_surname">
										<?php echo form_error('name_surname', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-4">
										<input type="text" placeholder="E-Posta" value="<?php echo set_value('email'); ?>" name="email">
										<?php echo form_error('email', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-4">
										<input type="text" placeholder="Telefon" value="<?php echo set_value('phone'); ?>" name="phone">
										<?php echo form_error('phone', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input type="text" placeholder="Şase No" value="<?php echo set_value('chasis_number'); ?>" name="chasis_number">
									<?php echo form_error('chasis_number', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Marka" value="<?php echo set_value('brand'); ?>" name="brand">
									<?php echo form_error('brand', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Model" value="<?php echo set_value('model'); ?>" name="model">
									<?php echo form_error('model', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Kasa" value="<?php echo set_value('body'); ?>" name="body">
									<?php echo form_error('body', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Yıl" value="<?php echo set_value('year'); ?>" name="year">
									<?php echo form_error('year', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Motor Hacmi" value="<?php echo set_value('engine_capacity'); ?>" name="engine_capacity">
									<?php echo form_error('engine_capacity', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Beygir" value="<?php echo set_value('at'); ?>" name="at">
									<?php echo form_error('at', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="text" placeholder="Yedek Parça Listesi" value="<?php echo set_value('spare_part'); ?>" name="spare_part">
									<?php echo form_error('spare_part', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<textarea name="content" placeholder="Eklemek İstedikleriniz"><?php echo set_value('content'); ?></textarea>
									<?php echo form_error('content', '<div class="alert alert-warning" role="alert">', '</div>'); ?>
								</div>
								<div class="col-12">
									<input type="file" name="user_file">
								</div>
								<?php if (!empty($this->session->flashdata('image_error'))) { ?>
									<br><br>
									<div class="col-12">
										<div class="alert alert-warning" role="alert"><?php echo $this->session->flashdata('image_error'); ?></div>
									</div>
								<?php } else if (!empty($this->session->flashdata('success'))) { ?>
									<br><br>
									<div class="col-12">
										<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
									</div>
								<?php } else if (!empty($this->session->flashdata('danger'))) { ?>
									<br><br>
									<div class="col-12">
										<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('danger'); ?></div>
									</div>
								<?php } ?>
								<div class="col-12 text-center" style="margin-top: 15px;">
									<button type="submit">Hemen Gönder</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->


<!-- Modal -->
<div class="modal fade" id="offer_contract" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Teklif Sözleşmesi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
				Teklif Sözleşmesi <br>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="secure_contract" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Gizlilik Sözleşmesi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
				Gizlilik Sözleşmesi <br>
			</div>
		</div>
	</div>
</div>

