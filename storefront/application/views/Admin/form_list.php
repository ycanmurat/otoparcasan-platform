<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                İletişim Talepleri
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                   <a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
                   <i class="m-nav__link-icon la la-home"></i>
                   </a>
                </li>
                <li class="m-nav__separator">
                   -
                </li>
                <li class="m-nav__item">
                   <a href="<?=admin_url('')?>" class="m-nav__link">
                   <span class="m-nav__link-text">
                   Anasayfa
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
                <div class="m-portlet__body">
                    <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
                    <table class="table m-table m-table--head-bg-primary table-responsive">
                    <thead>
                        <tr>
                           <th>#</th>
                           <th>İsim Soyisim</th>
                           <th style="text-align:right;">E-Posta</th>
                           <th style="text-align:right;">Telefon</th>
                           <th>Tüm Bilgiler</th>
                           <th style="text-align:right;">Görülme</th>
                           <th style="text-align:right;">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?if($contacts==0){?><tr><td><font color="red">Şuanda Yüklü Bir İletişim Talebi Yok</font></td></tr><?}else{
                        foreach ($contacts as $key => $contactInfo){if($contactInfo->status==1){$new=0;}else{$new=1;}?>
                        <tr>
                           <td><?=$contactInfo->id?></td>
                           <td><?=$contactInfo->name_surname?></td>
                           <td style="text-align:right;"><?=$contactInfo->email?></td>
                           <td style="text-align:right;"><?=$contactInfo->phone?></td>
                           <td style="text-align:right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$contactInfo->id?>">
                                    Tüm Bilgiler
                                </button>
                           </td>
                           <div class="modal fade" id="m_modal_<?=$contactInfo->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <?=$contactInfo->name_surname?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ad Soyad :  <b><?=$contactInfo->name_surname?></b></p>
	                                    	<p>E-Posta :  <b><?=$contactInfo->email?></b></p>
	                                    	<p>Telefon :  <b><?=$contactInfo->phone?></b></p>
	                                    	<p>Konu :  <b><?=$contactInfo->subject?></b></p>
	                                    	<p>Mesaj :  <b><?=$contactInfo->message?></b></p>
	                                    	<p>İp Adresi :  <b><?=$contactInfo->ip_address?></b></p>
	                                    	<p>Tarih :  <b><?=$contactInfo->added_time?></b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Geri Çık
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?if($contactInfo->status == 0){?>
                                <td style="text-align:right;">
                                    <button style="background-color: #FFCE54;border-color:#FCBB42;" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Form/seenStatus/'.$contactInfo->id.'/1')?>'">
                                        Görülmedi
                                    </button>
                                </td>
                            <?}else{?>
                                <td style="text-align:right;">
                                    <button style="background-color: #A0D468; border-color: #8CC152" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Form/seenStatus/'.$contactInfo->id.'/0')?>'">
                                        Görüldü
                                    </button>
                                </td>
                           <?}?>
                           <td style="text-align:right;cursor:pointer;">
                                <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        İşlem Seçin
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="deleteConfirm('<?=admin_url('Form/delete/'.$contactInfo->id)?>')">Sil</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?}}?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>