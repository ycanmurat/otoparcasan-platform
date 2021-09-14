<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel helpPanel">
					
					<div class="panel-content">
						<h6>YARDIM</h6>
						<?foreach ($helps as $key => $helpInfo) {?>
							<a href="<?=site_url('kurumsal/yardim/'.$helpInfo->slug)?>" class="panel-link <?=($helpInfo->slug == $content->slug)?'active':''?>">
								<?=$helpInfo->menu?>
							</a>
						<?}?>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="accountArea">
					<div class="pageTitle"><?=$content->title?></div>
					<div class="EditorText">
						<?=$content->content?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->