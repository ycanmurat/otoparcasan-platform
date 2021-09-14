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
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-bottom-30">
						<form action="<?=admin_url('Order')?>?s=1" method="GET">
							<div><h6>Filtrele</h6></div>
							<div class="form-group m-form__group row align-items-center">
								<div class="col-2">
                                    <label for=""> Sipariş Durumu</label>
									<select class="form-control form-control-sm m-input" name="order_status" placeholder="Sipariş Durumu">
										<option  value="" >Tümü</option>
										<?php foreach ($orderStatus as $key => $val){ ?>
											<option value="<?=$key?>" <?=($filter->order_status == $key) ? 'selected' : '' ?>><?=$val?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-2">
                                    <label for=""> Ödeme Durumu</label>
									<select class="form-control form-control-sm m-input" name="payment_status" placeholder="Ödeme Türü">
										<option value="">Tümü</option>
										<?php foreach ($paymentStatus as $key => $val){ ?>
											<option value="<?=$key?>" <?=($filter->payment_status == $key) ? 'selected' : '' ?>><?=$val?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-6">
                                    <label for=""></label>
									<input class="form-control form-control-sm m-input" type="text" value="<?=$this->input->get('key', true)?>" name="key" placeholder="E-Posta / Telefon / Sipariş Numarası" />
								</div>
								<div class="col-2">
                                    <label for=""> </label>
									<input type="hidden" name="s" value="1">
									<button type="submit" class="btn m-btn--air btn-info btn-sm"><i class="la la-search"></i> Ara</button>
								</div>
							</div>
						</form>
					</div><!--end: Search Form -->
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
									<td><a href="<?=admin_url('Order/detail/'.$val->id)?>" class="btn btn-outline-success">Sipariş Detayı</a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php if ($prevPage || $nextPage){ ?>
						<!--Sayfalama-->
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav">
								<li>
									<a href="<?=get_url('Admin/Order')?>s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
								</li>
								<li>
									<a href="<?=get_url('Admin/Order')?>s=<?=$prevPage?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
								</li>
								<?php for ($i=1; $i < $lastPage+1 ; $i++) { ?>
									<li style="">
										<a href="<?=get_url('Admin/Order')?>s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
									</li>
								<?php } ?>
								<li>
									<a href="<?=get_url('Admin/Order')?>s=<?=$nextPage?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
								</li>
								<li>
									<a href="<?=get_url('Admin/Order')?>s=<?=ceil($lastPage)?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
								</li>
							</ul>
						</div>
						<!--Sayfalama-->
						<?php } ?>
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>