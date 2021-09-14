<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Gelen Ürün Onayı Bekleyenler
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
                    <a href="<?=admin_url('Order?s=1')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Sipariş Listele
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
                    <!--begin: Datatable -->
                    <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
                        <table class="table m-table m-table--head-bg-metal table-detail">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ürün Adı</th>
                                    <th>Satış Fiyatı</th>
                                    <th>Ürün Adeti</th>
                                    <th>Stok Kodu</th>
                                    <th>Cari Kodu</th>
                                    <th>Ürüne Git</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderLines as $key => $val) { ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$val->name?></td>
                                    <td><b style="color:green"><?=number_format($val->price,2,',','.')?> TL </b></td>
                                    <td><b style="color:red"><?=(int)$val->count?></b></td>
                                    <td><?=$val->stok_id?></td>
                                    <td><?=$val->cari_id?></td>
                                    <td><a href="<?=site_url($val->url)?>" target="_blank">Ürüne Git</a></td>
                                    <!--
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="number" class="form-control" id="ProductAdet" min="0" step="1" value="0" placeholder="Sipariş Verilern Adet">
                                                </div>
                                                <div class="col-6">
                                                    <button onclick="adetlisiparis('<?=$val->cari_id?>','<?=$val->stok_id?>','<?=$val->count?>')" class="btn btn-outline-warning">Adetli Sipariş Edildi</button>
                                                </div>
                                            </div>
                                        </td>
                                    -->
                                    <td class="pull-right"><a href="<?=admin_url('Order/changeOutgoingCheck/'.$val->cari_id.'/'.$val->stok_id.'/1')?>" class="btn btn-outline-success">Ürün Faturaya Hazır</a></td>
                                    <td class="pull-right"><a href="<?=admin_url('Order/changeOutgoingCheck/'.$val->cari_id.'/'.$val->stok_id.'/2')?>" class="btn btn-outline-danger">Ürün İptal Edildi</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff',
                baseZ: '99999999999'
            },
            message: 'Yükleniyor...'
        });
        location.reload();
    },120000);
</script>