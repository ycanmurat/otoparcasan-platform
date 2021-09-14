	<!-- pageContent -->
	<section class="pageContent bank_account">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="area-white">
						<div class="pageTitle">Banka Hesaplarımız</div>
						<?foreach ($accounts as $key => $bankInfo) {?>
							<div class="panel">
							    <div class="panel-heading">
							        <h5><?=$bankInfo->name?></h5>
							    </div>
							    <div class="panel-body">
							        <div class="row">
							            <div class="col-md-2"><b>Şube Kodu</b></div>
							            <div class="col-md-10"><?=$bankInfo->branch_code?></div>
							        </div>
							        <div class="row">
							            <div class="col-md-2"><b>Hesap No</b></div>
							            <div class="col-md-10"><?=$bankInfo->account_no?></div>
							        </div>
							        <div class="row">
							            <div class="col-md-2"><b>Hesap Tipi</b></div>
							            <div class="col-md-10"><?=$bankInfo->type?></div>
							        </div>
							        <div class="row">
							            <div class="col-md-2"><b>IBAN</b></div>
							            <div class="col-md-10"><?=$bankInfo->iban?></div>
							        </div>
							        <img class="img-fluid" src="<?=site_url($bankInfo->image)?>" alt="<?=$bankInfo->name?>" title="<?=$bankInfo->name?>">
							    </div>
							</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / pageContent -->