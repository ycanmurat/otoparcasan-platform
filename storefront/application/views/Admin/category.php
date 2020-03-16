<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kategoriler
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<?php foreach ($categories as $key => $val) { ?>
							<button class="accordion"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?></button>
							<div class="panel">
								<button onclick="window.location.href='<?=admin_url('Category/editCategory/'.$val->GRUP_KOD)?>'" class="accordion linkegitmelisin">Düzenle</button>
								<?php foreach ($val->sub as $key2 => $val2) { ?>
									<button class="accordion"><?=replaceStringProblemsReverse($val2->GRUP_ISIM)?></button>
									<div class="panel">
										<button onclick="window.location.href='<?=admin_url('Category/editCategory/'.$val2->GRUP_KOD)?>'" class="accordion linkegitmelisin">Düzenle</button>
										<?php foreach ($val2->sub as $key3 => $val3) { ?>
											<button onclick="window.open('<?=admin_url('Category/editCategory/'.$val3->GRUP_KOD)?>','_blank');" class="accordion"><?=replaceStringProblemsReverse($val3->GRUP_ISIM)?></button>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
						<!--
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Kategori İsmi</th>
										<th style="text-align: right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($categories as $key => $categoryInfo) {?>
										<tr>
											<td><?=$categoryInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($categoryInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$categoryInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
										<?foreach ($categoryInfo->sub as $key => $lowerCategoryInfo) {?>
										<tr>
											<td><?=$lowerCategoryInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($lowerCategoryInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$lowerCategoryInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
										<?foreach ($lowerCategoryInfo->sub as $key => $contentInfo) {?>
										<tr>
											<td><?=$contentInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($contentInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$contentInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
									<?}}}?>
								</tbody>
							</table>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	/* Style the buttons that are used to open and close the accordion panel */
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover {
  background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
}
button.accordion {
    border: 2px solid #292b3a;
    margin-bottom: 10px;
}

button.accordion.linkegitmelisin {
    padding: 2px;
    border: 2px solid #ffffff;
    background: #96ef96;
    /* background: transparent; */
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    color: #FFF;
}
</style>

<script>
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>