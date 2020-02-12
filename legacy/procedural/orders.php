<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span>Emre</span></div>
						<div class="user-mail">demo@example.com</div>
					</div>
					<div class="panel-content">
						<a href="account.php" class="panel-link "><div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>Hesabım</a>
						<a href="orders.php" class="panel-link Active"><div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>Siparişlerim<span class="Count">122</span></a>
						<a href="returns.php" class="panel-link"><div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>İadelerim<span class="Count">3</span></a>
						<a href="product_question.php" class="panel-link"><div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>Ürün Sorularım<span class="Count">3</span></a>
						<a href="address.php" class="panel-link "><div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>Adreslerim</a>
						<a href="favorites.php" class="panel-link "><div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>Favorilerim</a>
						<a href="garage.php" class="panel-link"><div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>Garajım</a>
						<a href="#" class="panel-link"><div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Çıkış Yap</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Siparişlerim</div>
				<div class="accountArea orderItem">
					<div class="row">
						<div class="col-lg-4">
							<div class="orderInfo">
								<div class="orderNo">Sipariş No : <span>84998488</span></div>
								<div class="orderDate">24 Kasım Cts, 09:36</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-3 text-lg-right">
							<div class="orderPrice">
								296,22 <span>TL</span>
								<div class="orderType">Kredi Kartı</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-2 OrderStep1">
							<div class="orderProgressTitle">Siparişiniz İşleme Alındı.</div>
							<div class="orderProgress"></div>
						</div>
					</div>
					<a href="order_detail.php" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>

				<div class="accountArea orderItem">
					<div class="row">
						<div class="col-lg-4">
							<div class="orderInfo">
								<div class="orderNo">Sipariş No : <span>84998488</span></div>
								<div class="orderDate">24 Kasım Cts, 09:36</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-3 text-lg-right">
							<div class="orderPrice">
								296,22 <span>TL</span>
								<div class="orderType">Kredi Kartı</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-2 OrderStep2">
							<div class="orderProgressTitle">Siparişiniz Hazırlanıyor.</div>
							<div class="orderProgress"></div>
						</div>
					</div>
					<a href="order_detail.php" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>

				<div class="accountArea orderItem">
					<div class="row">
						<div class="col-lg-4">
							<div class="orderInfo">
								<div class="orderNo">Sipariş No : <span>84998488</span></div>
								<div class="orderDate">24 Kasım Cts, 09:36</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-3 text-lg-right">
							<div class="orderPrice">
								296,22 <span>TL</span>
								<div class="orderType">Kredi Kartı</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-2 OrderStep3">
							<div class="orderProgressTitle">Siparişiniz Kargoya Verildi. <a href="#" class="cargoTakip">Kargo Takibi</a></div>
							<div class="orderProgress"></div>
						</div>
					</div>
					<a href="order_detail.php" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>

				<div class="accountArea orderItem">
					<div class="row">
						<div class="col-lg-4">
							<div class="orderInfo">
								<div class="orderNo">Sipariş No : <span>84998488</span></div>
								<div class="orderDate">24 Kasım Cts, 09:36</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-3 text-lg-right">
							<div class="orderPrice">
								296,22 <span>TL</span>
								<div class="orderType">Kredi Kartı</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-2 OrderStep4">
							<div class="orderProgressTitle">Siparişiniz Teslim Edildi. <a href="#" class="cargoTakip">Kargo Takibi</a></div>
							<div class="orderProgress"></div>
						</div>
					</div>
					<a href="order_detail.php" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>

				<div class="accountArea orderItem">
					<div class="row">
						<div class="col-lg-4">
							<div class="orderInfo">
								<div class="orderNo">Sipariş No : <span>84998488</span></div>
								<div class="orderDate">24 Kasım Cts, 09:36</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-3 text-lg-right">
							<div class="orderPrice">
								296,22 <span>TL</span>
								<div class="orderType">Kredi Kartı</div>
							</div>
						</div>
						<div class="col-lg-4 order-lg-2 OrderReturn">
							<div class="orderProgressTitle">Siparişiniz İptal Edildi.</div>
							<div class="orderProgress"></div>
						</div>
					</div>
					<a href="order_detail.php" class="orderDetail"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->



<?php include 'pages/footer.php';?>