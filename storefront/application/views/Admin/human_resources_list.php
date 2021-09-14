<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
   <div class="d-flex align-items-center">
      <div class="mr-auto">
         <h3 class="m-subheader__title m-subheader__title--separator">
            Başvuruları Görüntüle
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
         <div class="m-portlet">
            <div class="m-portlet__body">
               <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
                  <table class="table m-table m-table--head-bg-primary table-responsive">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Ad Soyad</th>
                           <th>E-Posta</th>
                           <th>Telefon</th>
                           <th>Diğer Tüm Bilgiler</th>
                           <th style="text-align:right;">İşlem</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?if($application==0){?><tr><td><font color="red">Şuanda Herhangi Bir Kayıt Yok</font></td></tr><?}else{
                        foreach ($application as $key => $info){?>
                        <tr>
                           <td><?=$info->id?></td>
                           <td><?=$info->name_surname?></td>
                           <td><?=$info->email?></td>
                           <td><?=$info->phone?></td>
                           <td>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$info->id?>">
                                 Tüm Bilgiler
                              </button>
                           </td>
                           <div class="modal fade" id="m_modal_<?=$info->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">
                                          Bilgiler
                                       </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">
                                             &times;
                                          </span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       Kişisel Bilgiler
                                       <hr>
                                       <p><b>Ad Soyad : </b><?=$info->name_surname?></p>
                                       <p><b>T.C. : </b><?=$info->identification_number?></p>
                                       <p><b>E-Posta : </b><?=$info->email?></p>
                                       <p><b>Telefon : </b><?=$info->phone?></p>
                                       <p><b>Cinsiyet : </b><?=($info->gender==1)?'Kadın':'Erkek'?></p>
                                       <p><b>Medeni Durumu : </b><?=($info->marital_status==1)?'Evli':'Bekar'?></p>
                                       <p><b>Askerlik Durumu : </b><?=$info->military_status == '1' ? 'Yapmadı' : ($info->military_status == '2' ? 'Yaptı' : 'Muaf')?></p>
                                       <p><b>Eğitim Durumu : </b><?=$info->educational_status == '1' ? 'İlokul' : ($info->educational_status == '2' ? 'Lise' : ($info->educational_status == '3' ? 'Üniversite' : 'Yüksek Lisans ve Üstü'))?></p>
                                       <hr>
                                       Doğum Tarihi ve Yeri
                                       <hr>
                                       <p><b>Yaşadığınız Şehir : </b><?=$info->CityName?></p>
                                       <p><b>Doğum Tarihi : </b><?=$info->birth_date?></p>
                                       <p><b>Yaşadığınız İlçe : </b><?=$info->CountyName?></p>
                                       <p><b>Ev Adresiniz : </b><?=$info->address?></p> 
                                       <hr>
                                       Eğitim Geçmişi
                                       <hr>
                                       <p><b>Okul : </b><?=$info->education_school?></p> 
                                       <p><b>Bölüm : </b><?=$info->education_department?></p> 
                                       <p><b>Başlangıç : </b><?=$info->education_start_date?></p> 
                                       <p><b>Bitiş : </b><?=$info->education_end_date?></p>
                                       <hr> 
                                       İş Geçmişi
                                       <hr>
                                       <p><b>İşyerinin adı : </b><?=$info->job_name?></p> 
                                       <p><b>Görev : </b><?=$info->job_mission?></p> 
                                       <p><b>Başlama Tarihi : </b><?=$info->job_start_date?></p> 
                                       <p><b>Bitiş Tarihi : </b><?=$info->job_end_date?></p> 
                                       <p><b>Ayrılma Sebebi : </b><?=$info->job_reason?></p>
                                       <hr> 
                                       Referanslar
                                       <hr>
                                       1. Referans Bilgileri
                                       <hr>
                                       <p><b>Ad Soyad : </b><?=(!empty($info->r1_name_surname)?$info->r1_name_surname:'Referans Yok')?></p> 
                                       <p><b>İşyeri : </b><?=(!empty($info->r1_job)?$info->r1_job:'Referans Yok')?></p> 
                                       <p><b>Görevi : </b><?=(!empty($info->r1_mission)?$info->r1_mission:'Referans Yok')?></p> 
                                       <p><b>Telefonu : </b><?=(!empty($info->r1_phone)?$info->r1_phone:'Referans Yok')?></p> 
                                       <hr>
                                       2. Referans Bilgileri
                                       <hr>
                                       <p><b>Ad Soyad : </b><?=(!empty($info->r2_name_surname)?$info->r2_name_surname:'Referans Yok')?></p> 
                                       <p><b>İşyeri : </b><?=(!empty($info->r2_job)?$info->r2_job:'Referans Yok')?></p> 
                                       <p><b>Görevi : </b><?=(!empty($info->r2_mission)?$info->r2_mission:'Referans Yok')?></p> 
                                       <p><b>Telefonu : </b><?=(!empty($info->r2_phone)?$info->r2_phone:'Referans Yok')?></p> 
                                       <hr>
                                       3. Referans Bilgileri
                                       <hr>
                                       <p><b>Ad Soyad : </b><?=(!empty($info->r3_name_surname)?$info->r3_name_surname:'Referans Yok')?></p> 
                                       <p><b>İşyeri : </b><?=(!empty($info->r3_job)?$info->r3_job:'Referans Yok')?></p> 
                                       <p><b>Görevi : </b><?=(!empty($info->r3_mission)?$info->r3_mission:'Referans Yok')?></p> 
                                       <p><b>Telefonu : </b><?=(!empty($info->r3_phone)?$info->r3_phone:'Referans Yok')?></p> 
                                       <hr>
                                       Diğer Bilgiler
                                       <hr>
                                       <p><b>Sigara Kullanıyor musunuz ? </b><?=$info->smoke == '1' ? 'Evet' : ($info->smoke == '2' ? 'Hayır' : 'Çok Nadir')?></p>
                                       <p><b>Ehliyetiniz Var mı ? </b><?=($info->driving_licence==1)?'Var':'Yok'?></p> 
                                       <p><b>Çalışmak İstediğiniz Pozisyon : </b><?=$info->name?></p> 
                                       <p><b>Beklenen Ücret (Net) : </b><?=$info->fee?></p> 
                                       <p><b>Eklemek İstedikleriniz : </b><?=(!empty($info->message)?$info->message:'Mesaj Yok')?></p> 
                                       <p>Fotoğraf : <br><center><img src="<?=site_url('assets/uploads/'.$info->image)?>" style="width:100%;"></center></p> 
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                          Geri Çık
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <td style="text-align:right;">
                              <div class="dropdown d-inline">
                                 <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 İşlem Seçin
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" onclick="deleteConfirm('<?=admin_url('Form/deleteApplication/'.$info->id)?>')">Sil</a>
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