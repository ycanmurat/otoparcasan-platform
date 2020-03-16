<!-- pageContent -->
<section class="pageContent notification">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="area-white">
					<div class="pageTitle">Bildirimler</div>
					<?if(empty($notifications)){?>
						<div class="empty_page">
							<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/empty_notification.webp')?>" alt="Bildirim Bulunamadı." title="Bildirim Bulunamadı."></div>
							<div class="T">Bildirim Bulunamadı.</div>
							<div class="sT">Önemli bir durum olduğunda size bildireceğiz.</div>
							<a href="<?=site_url()?>" alt="Anasayfa'ya Dön" title="Anasayfa'ya Dön" class="global-btn">Anasayfa'ya Dön</a>
						</div>
					<?}else{
					foreach ($notifications as $key => $notificationsInfo) {?>
						<div class="notifications-item">
							<div class="item">
								<div class="txt"><?=$notificationsInfo->content?></div>
							</div>
							<div class="item">
								<div class="date"><?=time_ago($notificationsInfo->added_time)?></div>
							</div>
						</div>
					<?}}?>
				</div>
			</div>
		</div>
	</div>
</section>