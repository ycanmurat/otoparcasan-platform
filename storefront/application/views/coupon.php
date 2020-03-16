<!-- pageContent -->
<section class="pageContent AddressPage">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span></div>
						<div class="user-mail"><?=$userInfo->email?></div>
					</div>
					<div class="panel-content">
						<a href="<?=site_url('Account')?>" class="panel-link <?=($tabPanel=='account')?'Active':''?>">
							<div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>
							Üyelik Bilgilerim
						</a>
						<a href="<?=site_url('Account/password')?>" class="panel-link <?=($tabPanel=='password')?'Active':''?>">
							<div class="Icon"><i class="fa fa-key" aria-hidden="true"></i></div>
							Şifre Güncelleme
						</a>
						<a href="<?=site_url('Account/orders')?>" class="panel-link <?=($tabPanel=='orders')?'Active':''?>">
							<div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
							Siparişlerim<span class="Count">122</span>
						</a>
						<a href="<?=site_url('Account/returns')?>" class="panel-link <?=($tabPanel=='returns')?'Active':''?>">
							<div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>
							İadelerim<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/questions')?>" class="panel-link <?=($tabPanel=='questions')?'Active':''?>">
							<div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
							Ürün Sorularım<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/address')?>" class="panel-link <?=($tabPanel=='address')?'Active':''?>">
							<div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
							Adreslerim
						</a>
						<a href="<?=site_url('Account/favorite')?>" class="panel-link <?=($tabPanel=='favorite')?'Active':''?> ">
							<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
							Favorilerim
						</a>
						<a href="<?=site_url('Account/garage')?>" class="panel-link <?=($tabPanel=='garage')?'Active':''?>">
							<div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>
							Garajım
						</a>
						<a href="<?=site_url('Account/iban')?>" class="panel-link <?=($tabPanel=='iban')?'Active':''?>">
							<div class="Icon"><i class="fa fa-bank" aria-hidden="true"></i></div>
							IBAN Bilgilerim
						</a>
						<a href="<?=site_url('Account/transfer')?>" class="panel-link <?=($tabPanel=='transfer')?'Active':''?>">
							<div class="Icon"><i class="fa fa-exchange" aria-hidden="true"></i></div>
							Havale Ödeme Bildirimi
						</a>
						<a href="<?=site_url('Account/coupon')?>" class="panel-link <?=($tabPanel=='coupon')?'Active':''?>">
							<div class="Icon"><i class="fa fa-money" aria-hidden="true"></i></div>
							Kuponlarım
						</a>
						<a href="<?=site_url('User/logout')?>" class="panel-link">
							<div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
							Çıkış Yap
						</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Kuponlarım</div>
				<p class="small mt-2 mb-3">Kazandığınız hediye kuponları aşağıda listelenmiştir. Bu hediye kuponlarını geçerlilik tarihleri içinde kullanmadığınızda iptal edilirler. İptal edilen hediye kuponları yeniden aktif edilmezler.</p>
				<div class="FavItem CouponCode">
					<div class="row">
						<div class="col-lg-3">
							<div class="productPrice text-center">
								<div class="productPrice">%10 İndirim</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="productDetail CouponDetail">
								<div class="productInfo">
									<p href="#" class="productName">Kupon Kodu : <b>85611-1002-4845</b></p>
									<div>
										<span>Kupon bitişi : <b>12.10.2019 - 22:24</b></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<span class="couponstatus">Kullanıldı</span>
						</div>
					</div>
				</div>

				<div class="empty_page">
					<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/fav_empty.webp')?>" alt=""></div>
					<div class="T">Kupon Bulunamadı.</div>
					<div class="sT">Daha çok alışveriş yapın. Aldıkça Kazanın</div>

					<a href="index.php" class="global-btn">Alışverişe Başla</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->