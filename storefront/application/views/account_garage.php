<!-- pageContent -->
<section class="pageContent">
    <div class="container-fluid">
        <div class="row">
            <?php $this->load->view('account_menu'); ?>
            <div class="col-md">
                <div class="pageTitle">Garajım</div>
                <?php if ($cars != false) { ?>

                    <div class="addBtn-block">
                        <a class="addBtn" href="javascript:void(0)" onclick="addNewCarModal()">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yeni Araç Ekle
                        </a>
                    </div>

                    <?php if ($this->session->flashdata('addingGarrage')) { ?>
                        <div class="alert alert-success" role="alert">
                            Aracınız Garaja Eklenmiştir
                        </div>
                    <?php } ?>
                    <?php foreach ($cars as $key => $val) { ?>
                        <div class="garage_item">
                            <div class="garage-img" style="background-image: url(<?=site_url($val->detail->image)?>);"></div>
                            <div class="garage-content">
                                <div class="contentHead">
                                   <div class="removeGarage" onclick="removeCar(<?=$val->Id?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                   <div class="plaka-title-box">
                                      <h3 class="Title plaka-title"><?=$val->detail->Vehicle->ManufacturerName?> <?=$val->detail->Vehicle->BaseModelName?></h3>
                                  </div>
                                  <div class="plaka-box">
                                    <div class="plaka-area">
                                        <div class="plaka">
                                            <div class="plaka-word">
                                                TR
                                            </div>
                                            <img src="<?=site_url('assets/Front/images/Icons/turkey.svg')?>" alt="">
                                        </div>
                                    </div>
                                    <input class="content-text garageCarInput" data-id="<?=$val->Id?>" type="text" name="user-name" value="<?=$val->name?>" placeholder="Araç Plakanızı Girin">
                                </div>
                            </div>
                            <div class="contentBody">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="garage-item-feature feature1">
                                                    <div class="feature-title">Şanzıman</div>
                                                    <div class="feature-info"><?=$val->detail->Vehicle->TechInfo->GearboxType??' .'?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="garage-item-feature feature2">
                                                    <div class="feature-title">Yakıt</div>
                                                    <div class="feature-info"><?=$val->detail->Vehicle->TechInfo->FuelMethod??' .'?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="garage-item-feature feature3">
                                                    <div class="feature-title">Motor Hacmi</div>
                                                    <div class="feature-info"><?=$val->detail->Vehicle->TechInfo->Capacity ?? ''?> cc - <?=$val->detail->Vehicle->TechInfo->PowerKw ?? ''?> KW - <?=$val->detail->Vehicle->TechInfo->PowerHp ?? ''?> Hp</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="garage-item-feature feature4">
                                                    <div class="feature-title">İlk Tescil Tarihi</div>
                                                    <div class="feature-info"><?=getConsTime($val->construction_time)??' .'?> Sonrası</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                                                <div class="btn1-block">
                                                    <div class="Btn Btn1" onclick="changeSelectedCar('<?=$val->car_id?>','<?=$val->construction_time?>')">Yedek Parçalar</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                                                <div class="btn2-block">
                                                    <div class="Btn Btn2">Bakım Robotu</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                                                <div class="btn3-block">
                                                    <div class="Btn Btn3">Hatırlatmalar</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="empty_page">
                    <div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/garage_empty.webp')?>" alt=""></div>
                    <div class="T">Garajınızda Araç Bulunamadı..</div>
                    <div class="sT">Hemen sizde aracınız ekleyin, aracınıza göre parçaları listeleyin.</div>
                    <a href="<?=site_url()?>" class="global-btn">Araç Ekle</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</section>

<div class="modal fade" id="saseFirst" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="sase-modal-close">
                <button type="button" class="close sase-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="plate-area">
                    <input class="sase-input-edit plate-input" type="text" placeholder="ŞASE NO" id="chasisNo">
                    <button type="button" onclick="sasiSearch()" class="plateSearchButon sase-button-edit" id="chasisSearch"></button>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    <button onclick="sasiAra('<?=current_url()?>')">Ara</button>
                <?php }else{ ?>
                    <button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
                    <button onclick="sasiAra('<?=current_url()?>')">Ara</button>
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
                                                                        <div class="col-12"><button onclick="SearchPart('<?=site_url('yedek-parcalar')?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
                                                                    <?php }else{ ?>
                                                                        <div class="col-6 pr-2"><button onclick="addGarrage()" type="button" class="Btn Left" style="width: 100%">Garajıma Ekle</button></div>
                                                                        <div class="col-6 pl-2"><button onclick="SearchPart('<?=site_url('yedek-parcalar')?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
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