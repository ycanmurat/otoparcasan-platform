<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Ürün Kontrol
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
                    <a href="<?=admin_url('Product?s=1')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Ürünler
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
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-bottom-30">
                        <form action="<?=admin_url('Order')?>?s=1" method="GET">
                            <div><h6>Filtrele</h6></div>
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-8">
                                    <select class="form-control form-control-sm m-input" name="order_status" placeholder="Sipariş Durumu">
                                        <option value="">Ürün Kontrol</option>
                                        <option value="" selected>OEM Eşleşmeyen Ürünler</option>
                                        <option value="">API Sorunlu Ürünler</option>
                                        <option value="">Fiyat Bilgisi Olmayan Ürünler</option>
                                        <option value="">SEO Bilgisi Olmayan Ürünler</option>
                                        <option value="">KDV Bilgisi Olmayan Ürünler</option>
                                        <option value="">Açıklama Bilgisi Olmayan Ürünler</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn m-btn--air btn-info btn-sm" style="width: 100%;"><i class="la la-search"></i> Ara</button>
                                </div>
                            </div>
                        </form>
                    </div><!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
                        <table class="table m-table m-table--head-bg-metal table-detail">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dat Ürün Adı</th>
                                    <th>Dat Oem</th>
                                    <th>Tarih</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($list as $key => $val) { ?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$val->name?></td>
                                        <td><?=$val->oem?></td>
                                        <td><?=$val->added_time?></td>
                                        <td style="text-align:right;cursor:pointer;">
                                            <div class="dropdown d-inline show">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    İşlem Seçin
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 30px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item" onclick="deleteConfirm('https://otoparcasan.com/Admin/ServiceProblem/oemFaultDelete/<?=$val->oem?>')">Sil</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!--Sayfalama-->
                        <!--
                        <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
                            <ul class="m-datatable__pager-nav">
                                <li>
                                    <a href="<?=get_url('Admin/Order')?>s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
                                </li>
                                <li>
                                    <a href="<?=get_url('Admin/Order')?>s=<?=$prevPage?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
                                </li>
                                <?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
                                    <li style="">
                                        <a href="<?=get_url('Admin/Order')?>s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
                                    </li>
                                <?php } ?>
                                    <li>
                                        <a href="<?=get_url('Admin/Order')?>s=<?=$nextPage?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?=get_url('Admin/Order')?>s=<?=ceil($pageCount)?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
                                    </li>
                            </ul>
                        </div>
                    -->
                        <!--Sayfalama-->
                    </div><!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
</div>