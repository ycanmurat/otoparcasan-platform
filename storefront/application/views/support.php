<!-- pageContent -->
<section class="pageContent p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="area-white">
					<div class="pageTitle">DESTEK</div>
					<div class="EditorText">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
					</div>
					<div class="supportTableArea">
						<table class="table support">
							<thead>
								<tr>
									<th>DURUM</th>
									<th>KONU</th>
									<th>BÖLÜM</th>
									<th>TARİH</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Açık</td>
									<td>Ürün memnuniyetsizliği</td>
									<td>Ürün</td>
									<td>12.10.2020</td>
								</tr>
								<tr>
									<td>Açık</td>
									<td>Ürün memnuniyetsizliği</td>
									<td>Ürün</td>
									<td>12.10.2020</td>
								</tr>
								<tr>
									<td>Açık</td>
									<td>Ürün memnuniyetsizliği</td>
									<td>Ürün</td>
									<td>12.10.2020</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">Geri</a>
							</li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">İleri</a>
							</li>
						</ul>
					</nav>-->
					<button data-toggle="modal" data-target=".yeniDestekForm" href="#" class="newSupport">Yeni Destek Talebi</button>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade yeniDestekForm" tabindex="-1" role="dialog" aria-labelledby="yeniDestekFormLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-4">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="offerform">
							<h6 class="modalTitle">Yeni Destek Talebi</h6>
							<div class="formArea">
								<form action="#" method="post">
									<div class="row">
										<div class="col-sm-12">
											<select name="supportSection" id="supportSection">
												<option value="">Bölüm</option>
												<?foreach ($supportRequests as $key => $sectionInfo) {?>
													<option value="<?=$sectionInfo->id?>"><?=$sectionInfo->title?></option>
												<?}?>
											</select>
										</div>
										<div class="col-12">
											<input type="text" placeholder="Konu" id="supportSubject" name="supportSubject">
										</div>
										<div class="col-12">
											<textarea name="supportMessage" id="supportMessage" placeholder="Mesajınız"></textarea>
										</div>
										<div class="col-12 text-center">
											<button type="button" id="sendSupportRequests">Gönder</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / pageContent -->