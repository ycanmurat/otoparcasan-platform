<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Hazır Yanıt Düzenle
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
                    <a href="<?=admin_url('Comment')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Geri Bildirim Yönetimi
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
            <?if($this->session->flashdata('onay')==1){?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>
                       Başarılı
                    </strong>
                       Yanıt Başarıyla Güncellendi
                 </div>
            <?}elseif($this->session->flashdata('hata')==1){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>
                       Başarısız
                    </strong>
                       Yanıt Güncellenemiyor Lütfen Geliştiricinizden Yardım İsteyin
                </div>
            <?}?>
            <div class="m-portlet">
                <form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Comment/editReply/'.$reply->id)?>" method="POST">
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="form-group m-form__group">
                                <label>
                                Yanıt <span style="font-size:11px;"></span>
                                </label>
                                <textarea class="ckeditor" name="reply"><?=$reply->reply?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6 text-right">
                                   <button type="submit" class="btn btn-primary">
                                   Güncelle
                                   </button>
                                   <button type="reset" onclick="window.location='<?=admin_url('Comment/answerList')?>'" class="btn btn-secondary">
                                   İptal
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