<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Tedarikçi Kargo Süresi Düzenle
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
                    <a href="<?=admin_url('MarkaTedarikci/tedarikci')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Tedarikçi Yönetimi
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
	<div class="row">
		<div class="col-lg-12">
			<?if($this->session->flashdata('onay')==1){?>
	         <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	            <strong>
	               Başarılı
	            </strong>
	               Tedarikçi Kargo Süresi Güncellendi
	         </div>
	         <?}elseif($this->session->flashdata('hata')==1){?>
	         <div class="alert alert-danger alert-dismissible fade show" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	            <strong>
	               Başarısız
	            </strong>
	               Tedarikçi Kargo Süresi Güncellenemiyor Lütfen Geliştiricinizden Yardım İsteyin
	         </div>
	         <?}?>
			<div class="m-portlet">
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('MarkaTedarikci/tedarikciSure/'.$id)?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<div class="row">
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL1S" value="<?=$list->KULL1S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL1N" value="<?=$list->KULL1N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL2S" value="<?=$list->KULL2S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL2N" value="<?=$list->KULL2N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL3S" value="<?=$list->KULL3S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL3N" value="<?=$list->KULL3N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL4S" value="<?=$list->KULL4S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL4N" value="<?=$list->KULL4N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL5S" value="<?=$list->KULL5S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL5N" value="<?=$list->KULL5N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL6S" value="<?=$list->KULL6S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL6N" value="<?=$list->KULL6N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL7S" value="<?=$list->KULL7S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL7N" value="<?=$list->KULL7N?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Şube Adı
										</label>
										<input type="text" class="form-control m-input" name="KULL8S" value="<?=$list->KULL8S?>">
									</div>
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-group m-form__group">
										<label for="category_heading">
											Kargo Süresi (Gün)
										</label>
										<input type="number" class="form-control m-input" name="KULL8N" value="<?=$list->KULL8N?>">
									</div>
								</div>
							</div>						

						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 text-right">
									<button type="submit" class="btn btn-primary">
										Güncelle
									</button>
									<button type="reset" class="btn btn-secondary">
										İptal
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>