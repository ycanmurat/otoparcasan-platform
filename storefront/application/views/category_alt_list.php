<div class="big-searchLoading gizle"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"><p>Şase arama işleminiz başladı. Aracınızın türüne göre sorgu süresi değişiklik gösterebilir. <br>Anlayışınız için teşekkür ederiz</p></div>
<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
                <div class="list-head">
                    <div class="breadcrumb-box">
                        <nav aria-label="breadcrumb-list">
                            <ol class="breadcrumb-list">
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url()?>">
                                        Anasayfa
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url('yedek-parcalar/')?>">
                                        Yedek Parçalar
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item active">
                                    <a class="breadcrumb-list-link mobil-bread-link" onclick="loader()" href="<?=site_url('yedek-parcalar')?>">
                                        <i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
                                        <?=$detail->topGroup->GRUP_ISIM?>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    
                    <?php if ($selectedCar == true) { ?>
                        <div class="car-selected">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-info">
                                        <div class="car-detail-list">
                                            <div class="car-detail-block">
                                                <span>
                                                    Araç
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->ManufacturerName ?? ''?> <?=$carDetail->Vehicle->BaseModelName ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Model
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->SubModelName ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Motor
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->Capacity ?? ''?> cc - <?=$carDetail->Vehicle->TechInfo->PowerKw ?? ''?> KW - <?=$carDetail->Vehicle->TechInfo->PowerHp ?? ''?> Hp
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Yıl
                                                </span>
                                                <p>
                                                    <?=getConsTime($carDetail->Vehicle->ConstructionTime)?> Sonrası
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Şanzıman
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->NrOfGears ?? ''?> <?=$carDetail->Vehicle->TechInfo->GearboxType ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Yakıt
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->FuelMethod ?? ''?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-img">
                                        <div class="nav-garage-img">
                                            <a href="<?=site_url($carDetail->image)?>" data-lightbox="Lightbox-galeri-crumb" data-title="<?=$carDetail->Vehicle->ManufacturerName.' '.carNameExplode($carDetail->Vehicle->BaseModelName)?>" class="img-link">
                                                <img src="<?=site_url($carDetail->image)?>" onerror="this.src='<?=site_url('assets/Front/images/resmi_olmayan_araclar.png')?>';"  alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-garage">
                                        <div class="clear"  onclick="removeSelectedCar()">
                                            <span>
                                                Aracı Değiştir
                                            </span>
                                            <img src="https://otoparcasan.com/assets/Front/images/Icons/close.svg">
                                        </div>
                                        <?php if ($garrageUnVisible == 0) { ?>
                                            <div class="garage-add">
                                                <button onclick="addGaraggeFromSelected()"> Garajıma Ekle <img src="https://otoparcasan.com/assets/Front/images/Icons/plus-white.svg"> </button>
                                            </div>
                                        <?php } ?>
                                        <div class="plateSearch Listing">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="mySelectedcar">
                                                        <table class="selectarea">
                                                            <tr>
                                                                <td>
                                                                    <select class="custom-select" name="garaggeCars">
                                                                        <?php if ($userData == false) { ?>
                                                                            <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                        <?php }elseif ($garagge == false) { ?>
                                                                            <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                        <?php }else{ ?>
                                                                            <option value="0">Garajınızdan Seçin</option>
                                                                            <?php foreach ($garagge as $key => $val) { ?>
                                                                                <option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail.' - '.$val->name?></option>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="car-not-selected">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="plateSearch Listing">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 m-auto">
                                                <div class="T">Hızlı Parça Bul</div>
                                                <div class="Area">
                                                    <div class="plate-area">
                                                        <input type="text" class="plate-input" onkeypress="return enterScript(event)" placeholder="ŞASE NO" id="chasisNo">
                                                        <button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
                                                        <button id="clearArea"><i class="fa fa-undo" aria-hidden="true"></i></button>
                                                    </div>
                                                    <div class="bread-tree-box">
                                                      <button class="bread-tree"  data-toggle="modal" data-target="#carTree">
                                                        Araç Ağacından Seçim
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-8 col-sm-12 ">
                                            <div class="mySelectedcar">
                                                <table class="selectarea">
                                                    <tr>
                                                        <td>
                                                            <select class="custom-select" name="garaggeCars">
                                                                <?php if ($userData == false) { ?>
                                                                    <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                <?php }elseif ($garagge == false) { ?>
                                                                    <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                <?php }else{ ?>
                                                                    <option value="0">Garajınızdan Seçin</option>
                                                                    <?php foreach ($garagge as $key => $val) { ?>
                                                                        <option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <h3 class="font-weight-bold pageTitle"><?=replaceStringProblemsReverse($detail->topGroup->GRUP_ISIM)?></h3>
            <p class="altTitle mt-2">
               <?=($detail->topDetail->content)?>
           </p>

       </div>
       <div class="col-12">
        <?php foreach ($detail->mainGroup as $key => $val) { ?>
           <div class="pageTitle"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?></div>
           <div class="altyedekPart">
              <div class="row">
                 <?php foreach ($val->sub as $key2 => $val2) { ?>
                    <?php if (isset($val2->detail)) { ?>
                       <div class="col-lg-3 col-md-3  col-6">
                          <a href="<?=current_url().'/'.$val2->detail->slug ?? ''?>"  onclick="loader()" class="altPart-Item">
                             <div class="alt-item-img">
                                <img src="<?=((isset($val2->detail)?site_url($val2->detail->image):'https://fakeimg.pl/100x75/'))?>">
                            </div>
                            <p class="Title"><?=replaceStringProblemsReverse($val2->GRUP_ISIM)?></p>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
    </div>
    <hr>
<?php } ?>
</div>

<div class="col-12">
    <div class="pageTitle">Oto Parça Kategorileri Hakkında</div>
    <p class="pageText">
       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet molestie cursus. Duis tincidunt sit amet odio vel euismod. Donec congue orci vel pulvinar volutpat. Donec lorem ante, interdum a finibus in, placerat quis nunc. Nullam luctus sodales leo, quis luctus elit venenatis vitae. Fusce felis odio, bibendum vel bibendum in, gravida convallis justo. Proin sollicitudin urna erat, vitae ornare ante pretium in. Vivamus elementum arcu ut metus facilisis, eu vulputate eros ultricies. Fusce luctus tortor eros, quis maximus erat faucibus eget. Nulla ut viverra est. Maecenas eleifend diam sed ligula bibendum dignissim. Mauris elementum laoreet finibus. Nullam tortor nibh, luctus id quam vel, vehicula gravida dui.
   </p>
</div>
</div>
</div>
</section>
<!-- / pageContent -->

<!-- Modal -->
<div class="modal fade" id="sasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="carSasiDetail">
							<img src="" id="carImageSasi">
							<div class="sasiSecililer"></div>
							<div class="sasiText"><p>
								<b class="sasiSearchSasiNumber">KPACA1ETSCP129883</b> şase numarasına ait aracın, aşağıdaki tabloda gösterilen Alt Model, Motor Tipi, Kaporta vb. araca ve şase numarasına göre değişiklik gösterecek donanımlarını da eksiksiz şekilde seçerek aracınızın seçim işlemini bitirmeniz gerekmektedir. Aksi takdirde aradığınız doğru parçaya ulaşamayabilirsiniz.
							</p></div>
						</div>
					</div>
					<div class="col-12"><div style="color:red;font-weight: bold;" class="gizle" id="sasiSearchErrorText"><center>Lütfen tüm alanlarda bir seçim yapın.</center><br></div></div>
					<div class="col-12">
						<div class="select-items allBaslik d-none">

						</div>
						<div class="select-items allSelect">

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
                <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
                    <button onclick="sasiAra('<?=site_url('yedek-parcalar/')?>')">Ara</button>
                <?php }else{ ?>
                    <button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
                    <button onclick="sasiAra('<?=site_url('yedek-parcalar/')?>')">Ara</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="carDetail" style="display: none;"><?=json_encode($carDetail ?? '')?></div>

<div class="modal fade modal-content-bread" id="carTree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aracınızı bulamadınız mı ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="offerform">
                                <div class="formArea">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-12">
                                                <div class="FormElements">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                            <select class="custom-select mt-2" id="carType">
                                                                <option value="0">- Araç Türünü Seçiniz </option>
                                                                <?php foreach ($dat->types as $key => $val) { ?>
                                                                    <?php if ($val->status == 1) { ?>
                                                                        <option data-img="<?=site_url($val->icon)?>" value="<?=$val->key?>"><?=$val->value?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                            <select class="custom-select mt-2 carAlt" id="carBrands" disabled>
                                                                <option value="0">- Marka -</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                            <select class="custom-select mt-2 carAlt" id="carModels" disabled>
                                                                <option value="0">- Model -</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                            <select class="custom-select mt-2 carAlt" id="carSubModels" disabled>
                                                                <option value="0">- Alt Tip -</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-12 carTreeModalSelectAlt">
                                                <div class="plateSearch extraArea plateSearch-edit" style="display: none;">
                                                    <form action="#" method="post">
                                                        <div class="Area">
                                                            <div class="FormElements carSelectDetail">

                                                            </div>
                                                            <div class="FormElements">
                                                                <div class="row mt-2">
                                                                    <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
                                                                        <div class="col-12"><button onclick="SearchPart('<?=current_url()?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
                                                                    <?php }else{ ?>
                                                                        <div class="col-6 pr-2"><button onclick="addGarrage()" type="button" class="Btn Left" style="width: 100%">Garajıma Ekle</button></div>
                                                                        <div class="col-6 pl-2"><button onclick="SearchPart('<?=current_url()?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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
</div>