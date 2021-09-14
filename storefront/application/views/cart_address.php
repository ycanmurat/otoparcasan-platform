<div class="MembershipHeader">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="membership-logo" style="cursor:pointer;" onclick="window.location.href = '<?=site_url()?>'">
                    <picture>
                        <img src="<?=site_url('assets/Front/images/logofinali.png')?>" alt="logo">
                    </picture>
                </div>
            </div>
            <div class="col-auto">
                <div class="membership-sec">
                    <div class="security_text">Güvenli Ödeme</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / cart_header -->
<!-- pageContent -->
<section class="pageContent Cart_Page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="basket-bars-area">
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>1</p>
                        </div>
                        <span>
                            Sipariş Sepet
                        </span>
                        <div class="basket-bars-decor">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p class="active">
                                2
                            </p>
                        </div>
                        <span>
                            Teslimat Bilgileri
                        </span>
                        <div class="basket-bars-decor basket-bars-mobile">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
                                3
                            </p>
                        </div>
                        <span>
                            Ödeme Bilgileri
                        </span>
                        <div class="basket-bars-decor basket-bars-mobile-last">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
                                4
                            </p>
                        </div>
                        <span>
                            Sipariş Tamamlandı
                        </span>
                        <div class="basket-bars-decor-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg">
                <div class="Cart_Content">
                    <div class="T T-edit"><span>Teslimat Adresi</span>
                        <div class="remove-area remove-area-edit">
                            <a href="<?=site_url('sepet')?>" class="all-remove-items"><i class="fa fa-undo" aria-hidden="true"></i> Sepete Dön</a></div>
                        </div>
                        <div class="address-select-area">
                            <div class="row">
                                <?php foreach ($address as $key => $val) { ?>
                                    <div class="col-lg-6">
                                        <div class="select-item">
                                            <input class="select-radio adrressRadio" type="radio" value="<?=$val->Id?>" name="addressSelect" id="addressSelect-<?=$val->Id?>" <?=($val->default == 1 ? 'checked':'')?>>
                                            <label class="select-square" for="addressSelect-<?=$val->Id?>">
                                                <div class="address-info">
                                                    <div class="T"><?=$val->definition?></div>
                                                    <div class="Name"><?=$val->name?></div>
                                                    <p class="max-75"><?=$val->content.' '.$val->CityName.' '.$val->CountyName?></p>
                                                </div>
                                                <div class="address-control">
                                                    <div class="item"><a href="javascript:void(0);" class="Btn Edit" data-toggle="modal" data-target="#editAddressModal_<?=$val->Id?>">Düzenle</a></div>
                                                    <div class="item"><a href="javascript:void(0);" class="Btn Remove" onclick="removeAddress(<?=$val->Id?>)">Sil</a></div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Adres Düzenle -->
                                    <div class="modal fade" id="editAddressModal_<?=$val->Id?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Adres Düzenle</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="#">
                                                    <div class="modal-body">
                                                        <div class="AddressModal_Content">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="FormElements">
                                                                        <div class="checkboxGroup">
                                                                            <input type="radio" name="kurumsal_<?=$val->Id?>" id="bireysel_<?=$val->Id?>" data-id="<?=$val->Id?>" data-type="bireysel" class="kurumsal_update" <?=$val->corporate == 0 ? 'checked':''?>>
                                                                            <label for="bireysel_<?=$val->Id?>">Bireysel</label>
                                                                            <input type="radio" name="kurumsal_<?=$val->Id?>" id="kurumsal_<?=$val->Id?>" data-id="<?=$val->Id?>" data-type="kurumsal" class="kurumsal_update" <?=$val->corporate == 1 ? 'checked':''?>>
                                                                            <label for="kurumsal_<?=$val->Id?>">Kurumsal</label>
                                                                        </div>
                                                                    </div>
                                                            <!--
                                                                <div class="col-lg-12">
                                                                    <div class="checkboxGroup">
                                                                        <label for="kurumsal_<?=$val->Id?>">
                                                                            <input type="checkbox" name="kurumsal_<?=$val->Id?>" id="kurumsal_<?=$val->Id?>" data-id="<?=$val->Id?>" class="kurumsal_update" >
                                                                            Kurumsal
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            -->
                                                            <div class="col-lg-12">
                                                                <div class="FormElements">
                                                                    <label for="">Başlık *</label>
                                                                    <input type="text" id="definition_<?=$val->Id?>" value="<?=$val->definition?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="FormElements">
                                                                    <label for="">Ad Soyad *</label>
                                                                    <input type="text" id="name_<?=$val->Id?>" value="<?=$val->name?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="FormElements">
                                                                    <label for="">Cep Telefonu *</label>
                                                                    <input type="text" id="gsm_<?=$val->Id?>" class="gsmMask" value="<?=$val->gsm?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="FormElements">
                                                                    <label for="">Posta Kodu</label>
                                                                    <input type="text" id="post_code_<?=$val->Id?>" value="<?=$val->post_code?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="FormElements">
                                                                    <label for="">Tc Kimlik No</label>
                                                                    <input type="text" id="identity_number_<?=$val->Id?>"  value="<?=$val->identity_number?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="FormElements">
                                                                    <label for="">Ülke *</label>
                                                                    <select id="country_<?=$val->Id?>" class="edicCountry" data-id="<?=$val->Id?>">
                                                                        <?php foreach ($country as $key2 => $val2) { ?>
                                                                            <option value="<?=$val2->CountryID?>" <?=($val2->CountryID == $val->country ? 'selected':'')?>><?=$val2->CountryName?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="FormElements">
                                                                    <label for="">İl *</label>
                                                                    <select id="city_<?=$val->Id?>" class="editCity" data-id="<?=$val->Id?>">
                                                                        <option value="0">Seçiniz</option>
                                                                        <?php foreach ($cities as $key2 => $val2) { ?>
                                                                            <option <?=($val2->CityID==$val->city_id?'selected':'')?> value="<?=$val2->CityID?>"><?=$val2->CityName?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="FormElements">
                                                                    <label for="">İlçe *</label>
                                                                    <select id="town_<?=$val->Id?>" class="editTown" data-id="<?=$val->Id?>">
                                                                        <?php foreach ($counties as $key2 => $val2) { ?>
                                                                            <?php if ($val2->CityID == $val->city_id) { ?>
                                                                                <option <?=($val2->CountyID==$val->county_id?'selected':'')?> value="<?=$val2->CountyID?>"><?=$val2->CountyName?></option>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="FormElements">
                                                                    <label for="">Adres *</label>
                                                                    <textarea id="content_<?=$val->Id?>"><?=$val->content?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 kurumsal_<?=$val->Id?>" <?=$val->corporate == 0 ? 'style="display: none"':''?>>
                                                                <div class="FormElements">
                                                                    <label for="">Firma Ünvanı</label>
                                                                    <input type="text" id="firm_name_<?=$val->Id?>" value="<?=$val->firm_name?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 kurumsal_<?=$val->Id?>" <?=$val->corporate == 0 ? 'style="display: none"':''?>>
                                                                <div class="FormElements">
                                                                    <label for="">Vergi No</label>
                                                                    <input type="text" id="tax_no_<?=$val->Id?>" value="<?=$val->tax_no?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 kurumsal_<?=$val->Id?>" <?=$val->corporate == 0 ? 'style="display: none"':''?>>
                                                                <div class="FormElements">
                                                                    <label for="">Vergi Dairesi</label>
                                                                    <input type="text" id="tax_admin_<?=$val->Id?>" value="<?=$val->tax_no?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="cartAddressUpdate(<?=$val->Id?>)">Kaydet ve Devam Et</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Vazgeç</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-lg-6">
                            <div class="select-item">
                                <div class="addNewAddress" data-toggle="modal" data-target="#newAddressModal">
                                    <div class="Icon"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <div class="txt">Yeni Adres Ekle</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-adress-fatura">
                                <label for="fatura">
                                    <section title=".squaredThree">
                                        <div class="squaredThree">
                                            <input type="checkbox" name="fatura" id="fatura">
                                            <label for="fatura"></label>
                                        </div>
                                    </section>
                                    Fatura Adresim ile Teslimat Adresim Farklı
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Yeni Adres Ekle -->
                <div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Yeni Adres Ekle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#">
                                <div class="modal-body">
                                    <div class="AddressModal_Content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                        <!--
                                                        <div class="checkboxGroup">
                                                            <div class="card-adress-fatura">
                                                                <label for="kurumsal_new">
                                                                    <section title="squaredThree">
                                                                        <div class="squaredThree">
                                                                            <input type="checkbox" name="kurumsal_new" id="kurumsal_new">
                                                                            <label for="kurumsal_new"></label>
                                                                        </div>
                                                                    </section>
                                                                    Kurumsal
                                                                </label>
                                                            </div>
                                                        </div>
                                                    -->
                                                    <div class="FormElements">
                                                        <div class="checkboxGroup">
                                                            <input type="radio" name="address_new" id="bireysel_new" data-type="bireysel" class="KurumsalAdresCheckbox" checked="checked">
                                                            <label for="bireysel_new">Bireysel</label>
                                                            <input type="radio" name="address_new" id="kurumsal_new" data-type="kurumsal" class="KurumsalAdresCheckbox">
                                                            <label for="kurumsal_new">Kurumsal</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="FormElements">
                                                        <label for="">Başlık *</label>
                                                        <input type="text" id="address_title_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="FormElements">
                                                        <label for="">Ad Soyad *</label>
                                                        <input type="text" id="address_name_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="FormElements">
                                                        <label for="">Cep Telefonu *</label>
                                                        <input type="text" id="address_gsm_new" class="gsmMask">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="FormElements">
                                                        <label for="">Posta Kodu</label>
                                                        <input type="text" id="post_code_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="FormElements">
                                                        <label for="">Tc Kimlik No</label>
                                                        <input type="text" id="identity_number_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="FormElements">
                                                        <label for="">Ülke *</label>
                                                        <select name="address_country_new" id="address_country_new">
                                                            <?php foreach ($country as $key2 => $val2) { ?>
                                                                <option value="<?=$val2->CountryID?>" <?=($val2->CountryID == 212 ? 'selected':'')?>><?=$val2->CountryName?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="FormElements">
                                                        <label for="">İl *</label>
                                                        <select name="address_city_new" id="address_city_new">
                                                            <option value="0">Seçiniz</option>
                                                            <?php foreach ($cities as $key2 => $val2) { ?>
                                                                <option value="<?=$val2->CityID?>"><?=$val2->CityName?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="FormElements">
                                                        <label for="">İlçe *</label>
                                                        <select name="address_town_new" id="address_town_new">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="FormElements">
                                                        <label for="">Adres *</label>
                                                        <textarea name="address_address_new" id="address_address_new"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 kurumsal" style="display: none">
                                                    <div class="FormElements">
                                                        <label for="">Firma Ünvanı</label>
                                                        <input type="text" name="company_name_new" id="company_name_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 kurumsal" style="display: none">
                                                    <div class="FormElements">
                                                        <label for="">Vergi No</label>
                                                        <input type="text" name="company_vergi_new" id="company_vergi_new">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 kurumsal" style="display: none">
                                                    <div class="FormElements">
                                                        <label for="">Vergi Dairesi</label>
                                                        <input type="text" name="company_vergidairesi_new" id="company_vergidairesi_new">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="cartAddressAdd()">Kaydet ve Devam Et</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Vazgeç</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Cart_Content fatura" style="display: none;">
                <div class="T">Fatura Adresi</div>
                <div class="address-select-area">
                    <div class="row">
                        <?php foreach ($address as $key => $val) { ?>
                            <div class="col-lg-6">
                                <div class="select-item">
                                    <input class="select-radio faturaRadio" type="radio" value="<?=$val->Id?>" name="fatura_addressSelect" id="fatura_addressSelect-<?=$val->Id?>" <?=($val->default == 1 ? 'checked':'')?>>
                                    <label class="select-square" for="fatura_addressSelect-<?=$val->Id?>">
                                        <div class="address-info">
                                            <div class="T"><?=$val->definition?></div>
                                            <div class="Name"><?=$val->name?></div>
                                            <p class="max-75"><?=$val->content.' '.$val->CityName.' '.$val->CountyName?></p>
                                        </div>
                                        <div class="address-control">
                                            <div class="item"><a href="javascript:void(0);" class="Btn Edit" data-toggle="modal" data-target="#editAddressModal_<?=$val->Id?>">Düzenle</a></div>
                                            <div class="item"><a href="javascript:void(0);" class="Btn Remove" onclick="removeAddress(<?=$val->Id?>)">Sil</a></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- Adres Düzenle -->
                            <div class="modal fade" id="editAddressModal_<?=$val->Id?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Adres Düzenle</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-lg-6">
                            <div class="select-item">
                                <div class="addNewAddress" data-toggle="modal" data-target="#newAddressModal">
                                    <div class="Icon"><i class="fa fa-plus" aria-hidden="true"></i></div>
                                    <div class="txt">Yeni Adres Ekle</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-auto">
            <div class="cart-addition">
                <div class="T">Sipariş Özeti</div>
                <div class="addition-item">
                    <div class="item">Ara Toplam</div>
                    <div class="item"><?=$orderTable->araToplam?> TL</div>
                </div>
                <div class="addition-item">
                    <div class="item">KDV</div>
                    <div class="item"><?=$orderTable->kdv?> TL</div>
                </div>
                <div class="addition-item">
                    <div class="item">Kargo</div>
                    <div class="item"><?=($orderTable->kargo == 0 ? 'Ücretsiz':$orderTable->kargo.' TL')?></div>
                </div>
                    <!--
                                        <div class="addition-item">
                                                <div class="item">Kampanya İndirimi</div>
                                                <div class="item Colored">-1000 TL</div>
                                        </div>
                                    -->
                                    <div class="addition-total addition-item">
                                        <div class="item">toplam</div>
                                        <div class="item totalPrice"><?=$orderTable->total?> TL</div>
                                    </div>
                                </div>
                                <a onclick="sepetiOnaylaAddress()" class="global-btn d-block text-center mt-3 color-white">Sepeti Onayla</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- / pageContent -->
                <script>
                    $('.gsmMask').inputmask('0 (999) 999 99 99');
                    $('.il').on('change',function() {

                        var val     = $(this).val();
                        var name    = $(' > option:selected',this).text();
                        var id      = $(this).attr('select-id');

                        $('#CityName_'+id).val(name);

                        $.ajax({
                            url: site_url+'Ajax/getCountiesByCities/'+val,
                            method:'POST',
                            dataType : 'JSON',
                            success: function(result){
                                if (result.status == true) {
                                    var dataTxt = '';

                                    $.each(result.array,function(key,val) {
                                        dataTxt += '<option value="'+val.CountyID+'">'+val.CountyName+'</option>';
                                    });

                                    $('#ilce_'+id).html(dataTxt);
                                    var countryName = $('#ilce_'+id+' > option:selected').text();
                                    $('#CountyName_'+id).val(countryName);
                                }
                            },error:function(result) {
                                Swal.fire({type: 'error', title: 'Hata !', html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız', animation: false, customClass: 'animated tada'});
                            }
                        });
                    });

                    $(document).ready(function(){
                        var i = 0;
                        $.each($('.adrressRadio'),function(){
                            if($(this).prop('checked')){
                                i++;
                            }
                        });

                        if(i == 0){
                            $('.adrressRadio').first().attr('checked','checked');
                            $('.faturaRadio').first().attr('checked','checked');
                        }    
                    });

                </script>