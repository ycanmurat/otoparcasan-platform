<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Sohbet Geçmişi
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
			    <li class="m-nav__item m-nav__item--home">
			        <a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
			            <i class="m-nav__link-icon la la-home"></i>
			        </a>
			    </li>
			    <li class="m-nav__separator">
			        >
			    </li>
			    <li class="m-nav__item">
			        <a href="<?=admin_url('Product')?>" class="m-nav__link">
			            <span class="m-nav__link-text">
			            Ürünler
			            </span>
			        </a>
			    </li>
			    <li class="m-nav__separator">
			        >
			    </li>
			    <li class="m-nav__item">
			        <a href="<?=$this->agent->referrer()?>" class="m-nav__link">
			            <span class="m-nav__link-text">
			            Geri Dön
			            </span>
			        </a>
			    </li>
			</ul>
		</div>
	</div>
</div>

<div class="m-content">
	<?if(!empty($this->session->flashdata('onay'))){?>
		<div class="alert alert-success" role="alert">
  			Cevap Başarıyla Eklendi
		</div>
	<?} else if (!empty($this->session->flashdata('hata'))){?>
		<div class="alert alert-danger" role="alert">
  			Cevap Eklenemiyor, Lütfen Geliştiricinize Başvurun
		</div>
	<?}?>
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon">
						<i class="fa fa-commenting-o"></i>
					</span>
					<h3 class="m-portlet__head-text">
						<?=$question->name_surname?> Sordu
						<small>
						<?=$question->added_time?>
						</small>
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
				<div class="m-messenger__messages">
					<div class="m-messenger__message m-messenger__message--in">
						<div class="m-messenger__message-body">
							<div class="m-messenger__message-arrow"></div>
							<div class="m-messenger__message-content">
								<div class="m-messenger__message-text my_messenger_text">
									<?=$question->question?>
								</div>
							</div>
						</div>
					</div>
					<?foreach ($answers as $key => $val) {?>
						<div class="m-messenger__message m-messenger__message--out">
							<div class="m-messenger__message-body">
								<div class="m-messenger__message-arrow"></div>
								<div class="m-messenger__message-content">
									<div class="m-messenger__message-text my_messenger_text">
										<?=$val->answer?> <br><br> <span style="font-size:10px;"><?=$val->added_time?></span>
										<br><br>
										<center>
											<button type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--label-danger m-btn--bolder" style="padding: 5px;" onclick="window.location.href='<?=admin_url('Comment/deleteAnswer/' . $val->id . '/' . $id)?>'">
											Cevabı Sil
											</button>
										</center>
									</div>
								</div>
							</div>
						</div>
					<?}?>
				</div>
				<div class="m-messenger__seperator"></div>
				<form action="<?=current_url()?>" method="POST">
					<div class="row">
						<div class="col-12">
							<div class="m-messenger__form-controls">
								<textarea class="form-control m-input m-input--solid" name="answer" placeholder="Açıklama yaz..." rows="8"></textarea>
								<input type="hidden" name="question_id" value="<?=$id?>"/>
								<input type="hidden" name="slug" value="<?=$question->slug?>"/>
							</div>
						</div>
						<div class="col-12 mt-2"><button type="submit" class="btn btn-primary">Gönder</button></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>