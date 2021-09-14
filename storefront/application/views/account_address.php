<!-- pageContent -->
<section class="pageContent AddressPage">
    <div class="container-fluid">
        <div class="row">
            <?php $this->load->view('account_menu'); ?>
            <div class="col-md">
                <div class="pageTitle">Adres Bilgileri</div>
                
                <div class="addNewAddress" data-toggle="modal" data-target="#addAddressModal">
                    <div class="addBtn">Yeni Adres Ekle</div>
                </div>
                <?php foreach ($address as $key => $addressInformation) { ?>
                <div class="accountArea">
                    <div class="row">
                        <div class="col-12">
                            <div class="address-title"><?=$addressInformation->definition?></div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="address-info"><b>Fatura Tipi : </b> <?=$addressInformation->corporate == 1 ?'Kurumsal':'Bireysel' ?></p>
                                    <p class="address-info"><b>Ad Soyad :</b> <?=$addressInformation->name?></p>
                                    <p class="address-info"><b>İl/İlçe :</b> <?=$addressInformation->CityName?>, <?=$addressInformation->CountyName?></p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="address-info"><b>Açık Adres :</b> <?=$addressInformation->content?></p>
                                    <p class="address-info"><b>Telefon :</b> <?=$addressInformation->gsm?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="address-control">
                                <?=($addressInformation->default==1)?'<div class="item Available">Geçerli Adresiniz</div>':'<div class="item Edit" data-toggle="modal" data-target=""><a href="'.site_url('Account/addDefaultAddress/'.$addressInformation->Id).'">Geçerli Adres Yap</a></div>'?>
                                <div class="item Edit" data-toggle="modal" data-target="#editAddressModal-<?=md5($addressInformation->Id)?>">Düzenle</div>
                                <div class="item Remove" onclick="removeAddress(<?=$addressInformation->Id?>)" ><a href="javascript:void(0);">Sil</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</section>
<!-- / pageContent -->
<!-- Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="#" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Adres Bilgileri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-auto">
                        <div class="FormElements mb-0">
                            <div class="checkboxGroup">
                                <input type="radio" name="addressCorporate" id="BireyselAdresCheckbox" class="KurumsalAdresCheckbox" checked="checked">
                                <label for="BireyselAdresCheckbox">Bireysel</label>
                                <input type="radio" name="addressCorporate" id="KurumsalAdresCheckbox0" class="KurumsalAdresCheckbox">
                                <label for="KurumsalAdresCheckbox0">Kurumsal</label>
                            </div>
                        </div>
                    </div>
                    <div class="formArea">
                        <div class="row m-0">
                            <div class="col-12"><input type="text" placeholder="Başlık" name="definition" id="definition"></div>
                            <div class="col-12"><input type="text" placeholder="Ad Soyad" name="name" id="name"></div>
                            <div class="col-sm-6"><input type="tel" placeholder="Cep Telefonu" name="gsm" id="gsm"></div>
                            <div class="col-sm-6"><input type="tel" placeholder="Posta Kodu" name="post_code" id="post_code"></div>
                            <div class="col-sm-6">
                                <select name="country" id="country">
                                    <option value="">Lütfen Seçin</option>
                                    <?php foreach ($country as $key => $countryInfo) { ?>
                                        <option value="<?=$countryInfo->CountryID?>" <?=$countryInfo->CountryID == 212 ? 'selected' : ''?>><?=$countryInfo->CountryName?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select name="city" id="city">
                                    <option value="0">Lütfen Seçin</option>
                                    <?php foreach ($cities as $key => $cityInfo) { ?>
                                        <option value="<?=$cityInfo->CityID?>"><?=$cityInfo->CityName?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select name="town" id="town">
                                    <option value="0">Lütfen Seçin</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Tc Kimlik No (isteğe bağlı)" id="identity_number" name="identity_number">
                            </div>
                            <div class="col-12">
                                <textarea name="content" id="content" placeholder="Adres Bilgileri"></textarea>
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Firma" name="firm_name" id="firm_name">
                            </div>
                            <div class="col-6">
                                <input type="text" placeholder="Vergi No" name="tax_no" id="tax_no">
                            </div>
                            <div class="col-6">
                                <input type="text" placeholder="Vergi Dairesi" name="tax_admin" id="tax_admin">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary" id="addAddress">Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($address as $key => $addressInformation) { ?>
<div class="modal fade" id="editAddressModal-<?=md5($addressInformation->Id)?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="#" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Adres Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-auto">
                        <div class="FormElements mb-0">
                            <div class="checkboxGroup">
                                <input type="radio" name="addressCorporate" id="bireyselCheck_<?=$addressInformation->Id?>" data-type="bireysel" data-id="<?=$addressInformation->Id?>" class="updateCheck" <?=($addressInformation->corporate==0)?'checked':''?>>
                                <label for="bireyselCheck_<?=$addressInformation->Id?>">Bireysel</label>
                                <input type="radio" name="addressCorporate" id="kurumsalCheck_<?=$addressInformation->Id?>" data-type="kurumsal" data-id="<?=$addressInformation->Id?>" class="updateCheck" <?=($addressInformation->corporate==1)?'checked':''?>>
                                <label for="kurumsalCheck_<?=$addressInformation->Id?>">Kurumsal</label>
                            </div>
                        </div>
                    </div>
                    <div class="formArea">
                        <div class="row m-0">
                            <div class="col-12"><input type="text" placeholder="Başlık" name="definition" id="definition_<?=$addressInformation->Id?>" value="<?=$addressInformation->definition?>"></div>
                            <div class="col-12"><input type="text" placeholder="Ad Soyad" name="name" id="name_<?=$addressInformation->Id?>" value="<?=$addressInformation->name?>"></div>
                            <div class="col-sm-6"><input type="tel" placeholder="Cep Telefonu" class="uGsm" name="gsm" id="gsm_<?=$addressInformation->Id?>" value="<?=$addressInformation->gsm?>"></div>
                            <div class="col-sm-6"><input type="tel" placeholder="Posta Kodu" name="post_code" id="post_code_<?=$addressInformation->Id?>" value="<?=$addressInformation->post_code?>"></div>
                            <div class="col-sm-6">
                                <select name="country" id="country_<?=$addressInformation->Id?>">
                                    <option value="">Lütfen Seçin</option>
                                    <?php foreach ($country as $key => $countryInfo) { ?>
                                        <option value="<?=$countryInfo->CountryID?>" <?=($countryInfo->CountryID == $addressInformation->country)?'selected':''?>><?=$countryInfo->CountryName?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select name="city" id="city_<?=$addressInformation->Id?>">
                                    <?php foreach ($cities as $key => $citiesInfo) { ?>
                                        <option value="<?=$citiesInfo->CityID?>" <?=($citiesInfo->CityID==$addressInformation->city)?'selected':''?>><?=$citiesInfo->CityName?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select name="town" id="town_<?=$addressInformation->Id?>">
                                    <?php foreach ($counties as $key => $countiesInfo) { ?>
                                        <?php if($countiesInfo->CityID == $addressInformation->city){ ?>
                                            <option value="<?=$countiesInfo->CountyID?>" <?=($countiesInfo->CountyID == $addressInformation->town)?'selected':''?>>
                                                <?=$countiesInfo->CountyName?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Tc Kimlik No (isteğe bağlı)" id="identity_number_<?=$addressInformation->Id?>" name="identity_number" value="<?=$addressInformation->identity_number?>">
                            </div>
                            <div class="col-12">
                                <textarea name="content" id="content_<?=$addressInformation->Id?>" placeholder="Adres Bilgileri"><?=$addressInformation->content?></textarea>
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Firma" name="firm_name" id="firm_name_<?=$addressInformation->Id?>" value="<?=$addressInformation->firm_name?>" <?=($addressInformation->corporate == 1)?'':'style="display:none;"'?>>
                            </div>
                            <div class="col-6">
                                <input type="text" placeholder="Vergi No" name="tax_no" id="tax_no_<?=$addressInformation->Id?>" value="<?=$addressInformation->tax_no?>" <?=($addressInformation->corporate == 1)?'':'style="display:none;"'?>>
                            </div>
                            <div class="col-6">
                                <input type="text" placeholder="Vergi Dairesi" name="tax_admin" id="tax_admin_<?=$addressInformation->Id?>" value="<?=$addressInformation->tax_admin?>" <?=($addressInformation->corporate == 1)?'':'style="display:none;"'?>>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary addressUpdate" data-id="<?=$addressInformation->Id?>">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?}?>