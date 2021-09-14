<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Siparişlerim</div>
                <?php foreach ($orders as $key => $val) { ?>
                    <div class="accountArea orderItem">
    					<div class="row">
    						<div class="col-lg-4">
    							<div class="orderInfo">
    								<div class="orderNo">Sipariş No : <span><?=$val->id?></span></div>
    								<div class="orderDate"><?=$val->added_time?></div>
    							</div>
    						</div>
    						<div class="col-lg-4 order-lg-3 text-lg-right">
    							<div class="orderPrice">
    								<?=number_format($val->product_price+$val->shipping_price,2,',','.')?> <span>TL</span>
                                    <div class="orderType"><?=payment_types_user($val->payment_type)?></div>
    							</div>
    						</div>
                            <?php if ($val->order_status == 0 || $val->order_status == 1) { ?>
                                <div class="col-lg-4 order-lg-2 OrderStep1">
                                    <div class="orderProgressTitle">Siparişiniz Onay Bekliyor.</div>
                                    <div class="orderProgress"></div>
                                </div>
                            <?php }elseif($val->order_status == 2){ ?>
                                <div class="col-lg-4 order-lg-2 OrderStep2">
                                    <div class="orderProgressTitle">Siparişiniz Tedarik Aşamasında.</div>
                                    <div class="orderProgress"></div>
                                </div>
                            <?php }elseif($val->order_status == 3){ ?>
                                <div class="col-lg-4 order-lg-2 OrderStep4">
                                    <div class="orderProgressTitle">Siparişiniz Kargoya Verildi. <a href="#" class="cargoTakip">Kargo Takibi</a></div>
                                    <div class="orderProgress"></div>
                                </div>
                            <?php }elseif($val->order_status == 4){ ?>
                                <div class="col-lg-4 order-lg-2 OrderReturn">
                                    <div class="orderProgressTitle">Siparişiniz İptal Edildi.</div>
                                    <div class="orderProgress"></div>
                                </div>
                            <?php } ?>
    					</div>
    					<a href="<?=site_url('hesabim/siparislerim/'.$val->id)?>" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    				</div>
                <?php } ?>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->