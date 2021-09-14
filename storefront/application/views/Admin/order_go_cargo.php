<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Sipariş Listele
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
					<a href="<?=admin_url('Order?s=1')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Sipariş Listele
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
        <!--
		<div>
			<div>
				<button type="button" class="btn m-btn--air btn-success" onclick="window.location = '<?=get_url('Admin/Order/ExportExcel')?>'"><i class="fa fa-file-excel-o"></i></button>
			</div>
		</div>
    -->
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__body">
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-metal table-detail">
							<thead>
								<tr>
									<th width="150px">Sipariş No</th>
									<th width="200px">Sipariş Durumu</th>
									<th width="200px">Ödeme Durumu</th>
									<th width="200px">Ödeme Türü</th>
									<th width="400px">Üye Adı</th>
									<th width="300px">Sipariş Tarihi</th>
									<th width="300px">Toplam Adet</th>
                                    <th width="300px">Toplam Tutar</th>
                                    <th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($orders as $key => $val) { ?>
								<tr>
									<th><?=$val->id?></th>
									<td>
										<span class="m-badge m-badge--<?=admin_order_status_color($val->order_status_inside)?> m-badge--wide"><?=admin_order_status($val->order_status_inside)?></span>
									</td>
									<td>
                                        <span class="m-badge m-badge--<?=payment_status_color($val->payment_status)?> m-badge--wide"><?=payment_status($val->payment_status)?></span>
									</td>
									<td>
                                        <span class="m-badge m-badge--<?=payment_types_user_color($val->payment_type)?> m-badge--wide"><?=payment_types_user($val->payment_type)?></span>
									</td>
									<td><?=$val->name.' '.$val->surname?></td>
									<td><?=dateparse($val->added_time)?></td>
									<td><?=$val->count?></td>
                                    <td><b><?=number_format($val->totalPrice,2,',','.')?> TL </b></td>
                                    <td><a href="<?=admin_url('Order/detail/'.$val->id)?>" class="btn btn-outline-info">Sipariş Detayı</a></td>
									<td><a href="<?=admin_url('Order/goingCargoSuccess/'.$val->id)?>" class="btn btn-outline-success">Kargoya Verildi</a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>