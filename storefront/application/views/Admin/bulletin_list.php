<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                E-Bülten Listesi
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
                    <a href="<?=admin_url('Notification')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Bildirim Yönetimi
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
                <div class="m-portlet__body">
                    <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
                        <table class="table m-table m-table--head-bg-primary table-responsive">
                            <thead>
                                <tr>
                                 <th>#</th>
                                 <th>E-Posta</th>
                                 <th>İp Adresi</th>
                                 <th style="text-align:right;">Görülme</th>
                                 <th style="text-align:right;">İşlem</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?if($bulletin==0){?><tr><td><font color="red">Şuanda Yüklü Bir Mail Listesi Yok</font></td></tr><?}else{
                                foreach ($bulletin as $key => $bulletinInfo){if($bulletinInfo->status==1){$new=0;}else{$new=1;}?>
                                <tr>
                                 <td><?=$bulletinInfo->id?></td>
                                 <td><?=$bulletinInfo->user_email?></td>
                                 <td><?=$bulletinInfo->user_ip?></td>
                                 <?if($bulletinInfo->status == 0){?>
                                    <td style="text-align:right;">
                                        <button style="background-color: #FFCE54;border-color:#FCBB42;" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Form/seenStatusBulletin/'.$bulletinInfo->id.'/1')?>'">
                                            Görülmedi
                                        </button>
                                    </td>
                                    <?}else{?>
                                        <td style="text-align:right;">
                                            <button style="background-color: #A0D468; border-color: #8CC152" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Form/seenStatusBulletin/'.$bulletinInfo->id.'/0')?>'">
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
                                                    <a class="dropdown-item" onclick="deleteConfirm('<?=admin_url('Form/deleteBulletin/'.$bulletinInfo->id)?>')">Sil</a>
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