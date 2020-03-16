<?if(!defined('BASEPATH'))exit('No direct script access allowed');?>
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Dvn Eşleşmeleri
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
                	<!--
                    <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
                    <table class="table m-table m-table--head-bg-primary table-responsive">
                    <thead>
                        <tr>
                           <th>Dvn</th>
                           <th>Dvn İsim</th>
                           <th>Kod 3</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($dvns as $key => $val) { ?>
	                        <tr>
	                           <td><?=$val->dvn?></td>
	                           <td><?=$val->name?></td>
	                           <td><input type="number" class="form-control kod3" dat-code="<?=$val->dvn?>" value="<?=$val->kod3??''?>"></td>
	                        </tr>
                    	<?php } ?>
                     </tbody>
                  </table>
               </div>
           		-->
           		<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">

				    <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
				        <ul class="m-datatable__pager-nav">
				            <li>
				            	<a title="First" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled"  href="<?=site_url('Admin/Dvnlist/DvnAdd/1')?>">
				            		<i class="la la-angle-double-left"></i>
				            	</a>
				            </li>
				            <li>
				            	<a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--prev"  href="<?=site_url('Admin/Dvnlist/DvnAdd/'.((int)$page-1))?>">
				            		<i class="la la-angle-left"></i>
				            	</a>
				            </li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 1 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/1')?>">1</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 2 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/2')?>">2</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 3 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/3')?>">3</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 4 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/4')?>">4</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 5 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/5')?>">5</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 6 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/6')?>">6</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 7 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/7')?>">7</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 8 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/8')?>">8</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 9 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/9')?>">9</a></li>
				            <li><a class="m-datatable__pager-link m-datatable__pager-link-number <?=$page == 10 ? 'm-datatable__pager-link--active':''?>" href="<?=site_url('Admin/Dvnlist/DvnAdd/10')?>">10</a></li>

				            <li><a title="Next" class="m-datatable__pager-link m-datatable__pager-link--next" href="<?=site_url('Admin/Dvnlist/DvnAdd/'.((int)$page+1))?>"><i class="la la-angle-right"></i></a></li>
				            <li><a title="Last" class="m-datatable__pager-link m-datatable__pager-link--last" href="<?=site_url('Admin/Dvnlist/DvnAdd/10')?>"><i class="la la-angle-double-right"></i></a></li>
				        </ul>
				        <div class="m-datatable__pager-info">
						    <span class="m-datatable__pager-detail"><?=$p->count?> Sonuçtan <?=$p->pageFirst?> - <?=$p->pageLast?> Arasındakiler Görüntüleniyor</span>
						</div>
				    </div>
				    <br>
				    <table class="m-datatable__table" id="m-datatable--254363838245" style="display: block; height: auto; overflow-x: auto;">
				        <thead class="m-datatable__head">
				            <tr class="m-datatable__row">
				                <th data-field="RecordID" class="m-datatable__cell--center m-datatable__cell m-datatable__cell--sort"><span style="width: 100px">Dvn</span></th>
				                <th data-field="OrderID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 250px">Dvn İsim</span></th>
				                <th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">Kod 3</th>
				            </tr>
				        </thead>
				        <tbody class="m-datatable__body" style="">

	                    	<?php foreach ($dvns as $key => $val) { ?>
					            <tr data-row="9" class="m-datatable__row">
					                <td data-field="RecordID" class="m-datatable__cell--center m-datatable__cell">
										<span style="width: 100px"><?=$val->dvn?></span>
					                </td>
					                <td data-field="OrderID" class="m-datatable__cell">
					                	<span style="width: 250px"><?=$val->name?></span>
					                </td>
					                <td data-field="ShipName" class="m-datatable__cell">
										<input type="number" class="form-control kod3" dat-code="<?=$val->dvn?>" value="<?=$val->kod3??''?>">
					                </td>
					            </tr>
	                    	<?php } ?>
				        </tbody>
				    </table>
				</div>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
	input.datActive{
    	-webkit-animation-name: example; /* Safari 4.0 - 8.0 */
	  -webkit-animation-duration: 1s; /* Safari 4.0 - 8.0 */
	  animation-name: example;
	  animation-duration: 1s;
	}


	@-webkit-keyframes example {
	  from {background-color: #00ff0ed4;}
	  to {background-color: #ffffff00;}
	}
</style>

<script>
	var lastVal = 0;


	$('.kod3').focus(function() {
		lastVal	= $(this).val();
	});

	$('.kod3').focusout(function() {
		data 		= {};
		data.dvn 	= $(this).attr('dat-code');
		data.value 	= $(this).val();

		var a = $(this);

		$.ajax({
			url: '/Admin/Dvnlist/add/',
			method:'POST',
			data : data,
			success: function(result){
				a.addClass('datActive');
				setTimeout(function(){
					a.removeClass('datActive');
				}, 1000);
			}
		});
	});
</script>