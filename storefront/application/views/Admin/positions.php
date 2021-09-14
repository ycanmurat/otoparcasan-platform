<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
   <div class="d-flex align-items-center">
      <div class="mr-auto">
         <h3 class="m-subheader__title m-subheader__title--separator">
           Pozisyonlar
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
      <div style="margin-right:10px;">
        <div>
          <button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Form/positionList')?>'">Pozisyon Ekle</button>
        </div>
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
                           <th>Ad</th>
                           <th>Durum</th>
                           <th style="text-align:right;">İşlem</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?if($positions==0){?><tr><td><font color="red">Şuanda Yüklü Bir Pozisyon Yok</font></td></tr><?}else{
                        foreach ($positions as $key => $info){
                           if ($info->status == 1){
                              $newInfo = 0;
                           }elseif($info->status == 0){
                              $newInfo = 1;
                           }?>
                        <tr>
                           <td><?=$info->id?></td>
                           <td><?=$info->name?></td>
                           <td>
                              <span class="m-switch m-switch--outline m-switch--icon m-switch--primary">
                              <label>
                              <input type="checkbox" <?=$info->status==1?'checked="checked"':''?> onclick="window.location='<?=admin_url('Form/positionStatusUpdate/'.$info->id.'/'.$newInfo)?>'">
                              <span></span>
                              </label>
                              </span>
                           </td>
                           <td style="text-align:right;">
                              <div class="dropdown d-inline">
                                 <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 İşlem Seçin
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" onclick="deleteConfirm('<?=admin_url('Form/deletePosition/'.$info->id)?>')">Sil</a>
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