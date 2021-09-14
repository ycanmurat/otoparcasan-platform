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
                <form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Aracagaci/add')?>" method="POST" enctype="multipart/form-data">
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row" style="color:red">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">İsim</div>
                                <div class="col-md-2">Durum</div>
                                
                                <?php if (!isset($noneIcon)) { ?>
                                    <div class="col-md-2">İcon</div>
                                <?php } ?>

                                <?php if (isset($brand)) { ?>
                                    <div class="col-md-2">Popüler</div>
                                <?php } ?>
                            </div>
                            <div class="form-group m-form__group">
                                <?php foreach ($selects as $key => $val) { ?>
                                    <input type="hidden" name="<?=$key?>" value="<?=$val?>">
                                <?php } ?>
                                <?php foreach ($list as $key => $val) { ?>
                                    <?php if (!isset($noneIcon)) { ?>
                                        <input type="hidden" value="<?=$val->icon?>" name="icon[<?=$key?>]">
                                    <?php } ?>
                                    <input type="hidden" value="<?=$val->key?>" name="key[<?=$key?>]" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""><?=$val->value?></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="list_<?=$key?>" name="list[<?=$key?>]" value="<?=$val->value?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="checkbox" <?=$val->status == 1?'checked="checked"':''?>  name="status[<?=$key?>]">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>

                                        <?php if (!isset($noneIcon)) { ?>
                                            <div class="col-md-2">
                                                <?php if ($val->icon != '') { ?>
                                                    <img src="<?=site_url($val->icon)?>" width="20">
                                                    <br>
                                                <?php } ?>
                                                <input type="file" name="file[<?=$key?>]">
                                            </div>
                                        <?php } ?>

                                        <?php if (isset($brand)) { ?>
                                            <div class="col-md-2">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" <?=$val->popular == 1 ? 'checked="checked"':''?> name="popular[<?=$key?>]">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($image)) { ?>
                                            <div class="col-6 m--padding-left-30 m--padding-right-30">
                                                <label for="">Yüklü Fotoğraflar</label> <br>
                                                <?php foreach ($images as $key2 => $val2) { ?>
                                                    <?php if ($val2->model == $val->key) {  ?>
                                                        <div class="row">
                                                            <?php foreach ($val2->img as $key3 => $val3) {?>
                                                                <div class="col-md-4">
                                                                    <img width="100" src="<?=site_url($val3)?>" alt="">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php   break;
                                                    } ?>
                                                <?php } ?>
                                            </div>
                                            <div class="col-6 m--padding-left-30 m--padding-right-30">
                                                <div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=admin_url('Aracagaci/image/'.$selects->carType.'/'.$selects->carBrands.'/'.$val->key.'/1')?>" id="m-dropzone-one">
                                                    <div class="m-dropzone__msg dz-message needsclick">
                                                        <h3 class="m-dropzone__msg-title">
                                                            Resim Yükle
                                                        </h3>
                                                        <span class="m-dropzone__msg-desc">
                                                            <i class="fa fa-picture-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <hr>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Kaydet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>