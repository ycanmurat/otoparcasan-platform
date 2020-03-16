<!-- titleCover -->
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="site-title"><span>OYLAMA VE GERİ BİLDİRİMLER</span></div>
		</div>
	</div>
</div>
<!-- / titleCover -->


<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-md-12">
				<div class="rate-TopBar">
					<div class="row">
						<div class="col-xl-4 col-md-12 mt-4">
							<h6><b><?=number_format($stars->star,1)?></b> / 5</h6>
							<p>Toplam Geri Bildirim : <?=$countReviews?></p>
							<h4>
								<?if($stars->star == 2){?>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($stars->star < 3){?>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($stars->star < 4){?>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($stars->star < 5){?>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}else{?>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}?>
							</h4>
							<div class="total-rate-area">
								<div class="total-rate-item">
									<div class="Icon"><i class="fa fa-wrench" aria-hidden="true"></i></div>
									<h6>Hızlı Kargo</h6>
									<span class="good"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$fast_shipping_like?></span>
									<span class="bad"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$fast_shipping_dislike?></span>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-md-12">
							<div class="total-rate-area">
								<div class="row">
									<div class="col-sm-6 col-12">
										<div class="total-rate-item">
											<div class="Icon"><i class="fa fa-wrench" aria-hidden="true"></i></div>
											<h6>Ürün Kalitesi</h6>
											<span class="good"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$product_quality_like?></span>
											<span class="bad"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$product_quality_dislike?></span>
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="total-rate-item">
											<div class="Icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
											<h6>Kullanım Kolaylığı</h6>
											<span class="good"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$ease_of_use_like?></span>
											<span class="bad"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$ease_of_use_dislike?></span>
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="total-rate-item">
											<div class="Icon"><i class="fa fa-money" aria-hidden="true"></i></div>
											<h6>Fiyat Aralığı</h6>
											<span class="good"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$price_range_like?></span>
											<span class="bad"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$price_range_dislike?></span>
										</div>
									</div>
									<div class="col-sm-6 col-12">
										<div class="total-rate-item">
											<div class="Icon"><i class="fa fa-dropbox" aria-hidden="true"></i></div>
											<h6>Ürün Paketleme</h6>
											<span class="good"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$product_packaging_like?></span>
											<span class="bad"><i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$product_packaging_dislike?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="CustomerReviewsArea">
					<?foreach ($commentsAndReviews as $key => $commentInfo) {if(!empty($commentInfo->message)){?>
						<div class="customer-comment">
							<h5><?=$commentInfo->name.' '.$commentInfo->surname?></h5>
							<div class="starArea">
								<?if($commentInfo->star == 1){?>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($commentInfo->star == 2){?>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($commentInfo->star == 3){?>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}elseif($commentInfo->star == 4){?>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								<?}else{?>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
								<?}?>
							</div>
							<p class="comment-line"><?=$commentInfo->message?></p>
							<b>
								<?
									$date = explode(" ",$commentInfo->comment_time);
									echo $date[0].' - '.$date[1];
								?>
							</b>
						</div>
						<?if(!empty($commentInfo->answer)){?>
							<div class="co-comment">
								<h5>Otoparcasan.com</h5>
								<p class="comment-line"><?=$commentInfo->answer?></p>
								<b>
									<?
										$answerDate = explode(" ",$commentInfo->replay_time);
										echo $answerDate[0].' - '.$answerDate[1];
									?>		
								</b>
							</div>
						<?}?>
						<hr>
					<?}}?>
					<!--<nav aria-label="Page navigation ">
						<ul class="pagination">
							<li class="page-item disabled"><a class="page-link" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
						</ul>
					</nav>-->
				</div>
			</div>
			<div class="col-xl-4 col-md-12">
				<form method="post" action="#">
					<div class="RateArea">
						<?if(empty($userInfo)){?><div class="pleaseLogin"></div><?}?>
						<h4>Bizi Değerlendirin</h4>
						<div class='rating-stars text-center'>
							<ul id='stars'>
								<li class='star <?=(!empty($reviewsInformation) && $reviewsInformation->star >=1)?'hover':''?>' title='Kötü' data-value='1'>
									<i class='fa fa-star fa-fw'></i>
								</li>
								<li class='star <?=(!empty($reviewsInformation) && $reviewsInformation->star >=2)?'hover':''?>' title='İdare eder' data-value='2'>
									<i class='fa fa-star fa-fw'></i>
								</li>
								<li class='star <?=(!empty($reviewsInformation) && $reviewsInformation->star >=3)?'hover':''?>' title='İyi' data-value='3'>
									<i class='fa fa-star fa-fw'></i>
								</li>
								<li class='star <?=(!empty($reviewsInformation) && $reviewsInformation->star >=4)?'hover':''?>' title='Mükemmel' data-value='4'>
									<i class='fa fa-star fa-fw'></i>
								</li>
								<li class='star <?=(!empty($reviewsInformation) && $reviewsInformation->star >=5)?'hover':''?>' title='Harika' data-value='5'>
									<i class='fa fa-star fa-fw'></i>
								</li>
							</ul>
						</div>
						<div class='success-box'>
							<div class='clearfix'></div>
							<div class='text-message'></div>
							<div class='clearfix'></div>
						</div>
						<table class="table rateUs">
							<tr>
								<td>Ürün Kalitesi</td>
								<td>
									<div class="pretty p-icon p-toggle p-plain">
										<input type="checkbox" id="product_quality" <?=(!empty($reviewsInformation) && $reviewsInformation->product_quality == 1)?'':(isset($reviewsInformation->product_quality)?'checked':'')?>/>
										<div class="state p-success-o p-off">
											<i class="icon fa fa-thumbs-up"></i>
											<label>İyi</label>
										</div>
										<div class="state p-danger-o p-on">
											<i class="icon fa fa-thumbs-down"></i>
											<label>Kötü</label>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Kullanım Kolaylığı</td>
								<td>
									<div class="pretty p-icon p-toggle p-plain">
										<input type="checkbox" id="ease_of_use" <?=(!empty($reviewsInformation) && $reviewsInformation->ease_of_use == 1 )?'':(isset($reviewsInformation->ease_of_use)?'checked':'')?>/>
										<div class="state p-success-o p-off">
											<i class="icon fa fa-thumbs-up"></i>
											<label>İyi</label>
										</div>
										<div class="state p-danger-o p-on">
											<i class="icon fa fa-thumbs-down"></i>
											<label>Kötü</label>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Hızlı Kargo</td>
								<td>
									<div class="pretty p-icon p-toggle p-plain">
										<input type="checkbox" id="fast_shipping" <?=(!empty($reviewsInformation) && $reviewsInformation->fast_shipping == 1 )?'':(isset($reviewsInformation->fast_shipping)?'checked':'')?>/>
										<div class="state p-success-o p-off">
											<i class="icon fa fa-thumbs-up"></i>
											<label>İyi</label>
										</div>
										<div class="state p-danger-o p-on">
											<i class="icon fa fa-thumbs-down"></i>
											<label>Kötü</label>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Fiyat Aralığı</td>
								<td>
									<div class="pretty p-icon p-toggle p-plain">
										<input type="checkbox" id="price_range" <?=(!empty($reviewsInformation) && $reviewsInformation->price_range == 1 )?'':(isset($reviewsInformation->price_range)?'checked':'')?>/>
										<div class="state p-success-o p-off">
											<i class="icon fa fa-thumbs-up"></i>
											<label>İyi</label>
										</div>
										<div class="state p-danger-o p-on">
											<i class="icon fa fa-thumbs-down"></i>
											<label>Kötü</label>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Ürün Paketleme</td>
								<td>
									<div class="pretty p-icon p-toggle p-plain">
										<input type="checkbox" id="product_packaging" <?=(!empty($reviewsInformation) && $reviewsInformation->product_packaging == 1 )?'':(isset($reviewsInformation->product_packaging)?'checked':'')?>/>
										<div class="state p-success-o p-off">
											<i class="icon fa fa-thumbs-up"></i>
											<label>İyi</label>
										</div>
										<div class="state p-danger-o p-on">
											<i class="icon fa fa-thumbs-down"></i>
											<label>Kötü</label>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<div class="form-group">
							<textarea class="form-control" <?=(!empty($reviewsInformation) && !empty($reviewsInformation->message)?'':'placeholder="Mesajınız.."')?> id="message"><?=(!empty($reviewsInformation) && !empty($reviewsInformation->message)?$reviewsInformation->message:'')?></textarea>
						</div>
						<button type="button" class="rateSendButon" id="sendReview"> Geri Bildirim Gönder</button>
					</div>
				</form>
			</div>
			<div class="col-lg-8 col-md-12">
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->