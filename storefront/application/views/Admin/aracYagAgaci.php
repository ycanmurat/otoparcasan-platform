<script src="<?=site_url('assets/Front/js/dat.js?v=0.3')?>"></script>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Araç Ağacı Düzenleme
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=admin_url('Aracagaci')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Araç Yönetimi
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=$this->agent->referrer()?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Geri Dön
                        </span>
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
                <form class="m-form m-form--fit m-form--label-align-right" target="_blank" action="<?=admin_url('Aracagaci/list')?>" method="POST">
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="form-group m-form__group">
                                <label>
                                    Araç Tipi
                                </label>
                                <select class="form-control" id="carType" name="carType">
                                    <option value="0">- Araç Türünü Seçiniz </option>
                                    <?php foreach ($types as $key => $val) { ?>
                                        <?php if ($first) { ?>
                                            <option value="<?=$val['key']?>"><?=($val['value'])?></option>
                                        <?php }else{ if ($val->status == 1) { ?>
                                            <option value="<?=($val->key)?>"><?=($val->name)?></option>
                                        <?php } ?>
                                    <?php } } ?>
                                </select>

                                <select class="form-control mt-2 carAlt" id="carBrands" name="carBrands" disabled>
                                    <option value="0">- Marka -</option>
                                </select>
                                <select class="form-control mt-2 carAlt" id="carModels" name="carModels" disabled>
                                    <option value="0">- Model -</option>
                                </select>
                                <select class="form-control mt-2 carAlt" onchange="yagEkle()" id="carSubModels" name="carSubModels" disabled>
                                    <option value="0">- Alt Tip -</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function yagEkle() {
        var data = {};
        data.carType = $('#carType').val();
        data.carBrands = $('#carBrands').val();
        data.carModels = $('#carModels').val();
        data.carSubModels = $('#carSubModels').val();

        //console.log(data);

        if (data.carType == 0 || data.carBrands == 0 || data.carSubModels == 0 || data.carModels == 0) {
            
        }else{
            window.open(
              site_url+'Admin/Aracagaci/yagEkle/'+data.carType+'/'+data.carBrands+'/'+data.carModels+'/'+data.carSubModels,
              '_blank' // <- This is what makes it open in a new window.
            );
        }
    }
</script>