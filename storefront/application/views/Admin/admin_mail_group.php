<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                İşlem Mailleri
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
        <!--
        <div>
            <div>
                <button type="button" class="btn m-btn--air btn-success" onclick="window.location = '<?=get_url('Admin/Order/ExportExcel')?>'"><i class="fa fa-file-excel-o"></i></button>
            </div>
        </div>
    -->
    </div>
</div>
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <form action="<?=current_url()?>" method="POST">
                        <!--begin: Datatable -->
                        <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
                            <table class="table m-table m-table--head-bg-metal table-detail">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>İşlem Adı</th>
                                        <th>Durum</th>
                                        <th>Mail Adresleri (, ile ayırın)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mails as $key => $val) { ?>
                                    <tr>
                                        <th><?=$val->id?></th>
                                        <td><?=$val->name?></td>
                                        <td>
                                            <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> name="status[<?=$val->id?>]">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td><textarea class="form-control" name="mail[<?=$val->id?>]"><?=$val->mails?></textarea></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <?php  ?>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Güncelle
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>