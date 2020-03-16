<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
  <div class="d-flex align-items-center">
    <div class="mr-auto">
      <h3 class="m-subheader__title m-subheader__title--separator">
        Destek Talepleri
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
                   <th>Destek Talep Numarası</th>
                   <th>İsim Soyisim</th>
                   <th style="text-align:right;">Bölüm</th>
                   <th style="text-align:right;">Bilgiler</th>
                   <th style="text-align:right;">Durum</th>
                   <th style="text-align:right;">Tarih</th>
                   <th style="text-align:right;">İşlem</th>
               </tr>
           </thead>
           <tbody>
              <?if($supportRequests==0){?><tr><td><font color="red">Şuanda Yüklü Bir Talep Yok</font></td></tr><?}else{
                foreach ($supportRequests as $key => $supportInfo){if($supportInfo->status==1){$new=0;}else{$new=1;}?>
                <tr>
                  <td><?=$supportInfo->id?></td>
                  <td><?=$supportInfo->uname.' '.$supportInfo->usurname?></td>
                  <td style="text-align:right;"><?=$supportInfo->title?></td>
                  <td style="text-align:right;">
                    <button type="button" class="btn btn-primary">
                      Bilgiler
                  </button>
              </td>
              <td style="text-align:right;">
                <button style="
                <?$style = button_info($supportInfo->seen);
                if(isset($style->style)){echo $style->style;}
                ?>
                " type="button" class="btn btn-primary">
                <?
                $write = button_info($supportInfo->seen);
                if(isset($write->info)){echo $write->info;}
                ?>
            </button>
        </td>
        <td style="text-align:right;"><?=$supportInfo->added_time?></td>
        <td style="text-align:right;cursor:pointer;">
          <div class="dropdown d-inline">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              İşlem Seçin
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" onclick="deleteConfirm('<?=admin_url('Support/deleteRequest/'.$supportInfo->id)?>')">Sil</a>
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