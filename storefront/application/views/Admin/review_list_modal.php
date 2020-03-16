<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Genel Değerlendirmeler
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
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
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>ID</th>
										<th style="text-align: right;">Cihaz</th>
										<th style="text-align: right;">Deneyim</th>
										<th style="text-align: right;">Mesaj</th>
										<th style="text-align: right;">İsim Soyisim</th>
										<th style="text-align: right;">E-Mail</th>
										<th style="text-align: right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($reviewInformation as $key => $val) {?>
									<tr>
										<td><?=$val->id?></td>
										<td><?=device_info($val->device)?></td>
										<td><?=experience_info($val->experience)?></td>
										<td style="text-align: right;">
			                              	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$val->id?>">
			                                 Mesajı Gör
			                              	</button>
				                        </td>
				                           <div class="modal fade" id="m_modal_<?=$val->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				                              <div class="modal-dialog" role="document">
				                                 <div class="modal-content">
				                                    <div class="modal-header">
				                                       <h5 class="modal-title" id="exampleModalLabel">
				                                          <?=$val->name.' '.$val->surname?>
				                                       </h5>
				                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                                          <span aria-hidden="true">
				                                             &times;
				                                          </span>
				                                       </button>
				                                    </div>
				                                    <div class="modal-body">
				                                       <?=$val->message??''?>
				                                    </div>
				                                    <div class="modal-footer">
				                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">
				                                          Geri Çık
				                                       </button>
				                                    </div>
				                                 </div>
				                              </div>
				                           </div>
			                           	<td><?=$val->name.' '.$val->surname?></td>
			                           	<td><?=$val->email?></td>
										<td style="text-align: right;">
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Review/deleteReview/'.$val->id)?>')">Sil</a>
												</div>
											</div>
										</td>
									</tr>
									<?}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>