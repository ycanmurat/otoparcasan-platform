	<!-- pageContent -->
	<section class="pageContent bank_account p-lr">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="area-white">
						<div class="pageTitle">Anlaşmalı Servisler</div>

						<div class="EditorText">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
						</div>
						<?foreach ($services as $key => $servicesInfo) {?>
						<div class="panel">
						    <div class="panel-heading">
						        <h5><?=$servicesInfo->name?></h5>
						    </div>
						    <div class="panel-body">
						        <div class="row">
						            <div class="col-md-2"><b>Adres</b></div>
						            <div class="col-md-10"><?=$servicesInfo->address?></div>
						        </div>
						        <div class="row">
						            <div class="col-md-2"><b>Servis Tipi</b></div>
						            <div class="col-md-10"><?=$servicesInfo->type?></div>
						        </div>
						        <div class="row">
						            <div class="col-md-2"><b>Telefon</b></div>
						            <div class="col-md-10"><?=$servicesInfo->phone?></div>
						        </div>
						        <div class="row">
						            <div class="col-md-2"><b>E-Posta</b></div>
						            <div class="col-md-10"><?=$servicesInfo->email?></div>
						        </div>
						        <div class="row">
						            <div class="col-md-2"><b>İl</b></div>
						            <div class="col-md-10"><?=$servicesInfo->city?></div>
						        </div>
						        <div class="row">
						            <div class="col-md-2"><b>İlçe</b></div>
						            <div class="col-md-10"><?=$servicesInfo->counties?></div>
						        </div>
						    </div>
						</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / pageContent -->