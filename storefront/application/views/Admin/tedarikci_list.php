<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Tedarikçi Yönetimi
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
			<div class="m-portlet">
				<form action="<?=admin_url('MarkaTedarikci/oranChange')?>" method="post">
					<div class="m-section">
						<div class="m-section__content">
							<div class="table-responsive">
								<table class="table m-table m-table--head-bg-success">
									<thead>
										<tr>
											<th>#</th>
											<th>İsim</th>
											<th style="text-align:right;">Kar Oranı</th>
											<th style="text-align:right;">Kargo Süreleri</th>
										</tr>
									</thead>
									<tbody>
									<?foreach ($tedarikci as $key => $val) { ?>
										<tr>
											<th><?=$val->CARI_KOD?></th>
											<th><?=replaceStringProblemsReverse($val->CARI_ISIM)?></th>
											<td style="text-align:right;">
												<input type="hidden" name="cari_kod[]" value="<?=$val->CARI_KOD?>">
												<input type="text" name="oran[]"  class="form-control sliderSortInput" value="<?=(isset($val->oran)?$val->oran:0)?>" step="0.01">
											</td>
											<td style="text-align:right;">
												<a class="btn btn-info" href="<?=admin_url('MarkaTedarikci/tedarikciSure/'.$val->CARI_KOD)?>">Kargo Süresi</a>
											</td>
										</tr>
									<?}?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="text-right" style="padding:15px;">
	                  <button type="submit" style="" class="btn btn-outline-primary m-btn m-btn--icon m-btn--outline-2x">
	                     <span>
	                        <i class="fa flaticon-list-1"></i>
	                           <span>
	                              	Sırayı Düzenle
	                           </span>
	                     </span>
	                  </button>
	               </div>
	           </form>
			</div>
		</div>
	</div>
</div>