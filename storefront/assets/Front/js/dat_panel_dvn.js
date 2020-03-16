var site_url = 'https://otoparcasan.kodakil.com/';

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
$( document ).ready(function() {
	$('#carType').val('0');
	$('#year').val('0');
	$('#carBrands').val('0');
	$('#carModels').val('0');
	$('#carSubModels').val('0');


	//Araç Tipi
	$('#carType').on('change',function() {
		carType();
	});

	//Araç Yılı
	$('#year').on('change',function() {
		carYear();
	});


	//Araç Markası
	$('#carBrands').on('change',function() {
		carBrands();
	});

	//Araç Modeli
	$('#carModels').on('change',function() {
		carModels();
	});

	//Temizleme
	$('#clearArea').on('click',function() {
		$('.carAlt').attr('disabled','');
		$('#carType').val('0');
	});

	$(document).on('change', '.getConst',function() {
		var data 		= {};
		data.type 		= $('#carType').val();
		data.brand 		= $('#carBrands').val();
		data.model 		= $('#carModels').val();
		data.subModel	= $('#carSubModels').val();
		data.body		= $('#car_body').val();
		data.engine		= $('#car_engine').val();
		data.year		= $('#year').val();
		data.gear		= $('#car_gear').val();
		data.equipment 	= $('#car_equipment').val();

		$.ajax({
			url: site_url+'Service/getCarId/',
			method:'POST',
			dataType : 'JSON',
			data : data,
			success: function(result){
				if (result.ConsTime.length != 1) {
					datTxt = '<option value="0"> - Trafiğe Çıkış - </option>';
				}else{
					datTxt = '';
				}
				$.each( result.ConsTime, function( key, val ) {
					datTxt += '<option value="'+val.value+'">'+val.name+'</option>'
				});
				datTxt += '<option style="display:none" id="carId" value="'+result.carId+'"></option>';
				$('#car_consTime').html(datTxt);
				$('#car_consTime').removeAttr('disabled');

			}
		});
	});

	//alt seçenekler
	$(document).on('change', '.selectes',function() {
		$('.searchLoading').fadeIn(500);
		var data = {};
		data.type 		= $('#carType').val();
		data.brand 		= $('#carBrands').val();
		data.model 		= $('#carModels').val();
		data.subModel	= $('#carSubModels').val();
		data.year		= $('#year').val();
		data.selected 	= $(this).val();
		data.name 		= $(this).attr('id');
		if (data.name == 'car_gear') {
			data.engine_selected = $('#car_engine').val();
		}else{
			data.engine_selected = 0;
		}
		//console.log(data);


		if (data.selected != 0) {
			$.ajax({url: site_url+'Service/getChangedOptions/',
				method:'POST',
				data : data,
				dataType : 'JSON',
				success: function(result){
					if (result == 'error') {
						$('.carAlt').attr('disabled','');
					}else{
						var datTxt = '';
						if (data.name == 'car_engine') {

							datTxt += '<option value="0"> - Şanzıman - </option>';
							$.each( result.gear, function( key, val ) {
								datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
							});

							$('#car_gear').html(datTxt);
							$('#car_gear').removeAttr('disabled');
							$('#car_body').attr('disabled','');
						}else if (data.name == 'car_gear') {
							
							datTxt += '<option value="0"> - Kasa - </option>';
							$.each( result.body, function( key, val ) {
								datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
							});

							$('#car_body').html(datTxt);
							$('#car_body').removeAttr('disabled');
						}else{
							console.log('napcaz');
						}
						$('.searchLoading').fadeOut(500);
					}
				},
				error:function(){

				}
			});
		}
	});
});




//Araç Tipi DEĞİŞİNCE
function carType() {
	$('.searchLoading').fadeIn(500);
	var type = $('#carType').val();
	if (type != 0) {
		$.ajax({url: site_url+'Service/getBrands/'+type,
				method:'POST',
				dataType : 'JSON',
			success: function(result){
				if (result == 'error') {
					$('.carAlt').attr('disabled','');
				}else{

					if (result.length != 1) {
						var datTxt = '<option value="0">- Marka -</option>';
					}else{
						var datTxt = '';
					}

					/*
					datTxt += '<optgroup label="Favori Markalar">';
					$.each( result, function( key, val ) {
						if (val.fav) {
							datTxt += '<option value="'+val.key+'">'+val.value+'</option>';
						}
					});
					datTxt += '</optgroup>';
					*/

					//datTxt += '<optgroup label="Alfabetik">';
					$.each( result, function( key, val ) {
						//if (!val.fav) {
							datTxt += '<option value="'+val.key+'">'+val.value+'</option>';
						//}
					});
					//datTxt += '</optgroup>';

					$('#carBrands').html(datTxt);
					$('#carBrands').removeAttr('disabled');

					$('#carModels').attr('disabled','');
					$('#carSubModels').attr('disabled','');
					$('.searchLoading').fadeOut(500);
				}
			},
			error:function(){
				$('.carAlt').attr('disabled','');
				$('.searchLoading').fadeOut();
			}
		});
	}else{
		$('.carAlt').attr('disabled','');
		$('.searchLoading').fadeOut();
	}
}

function carYear() {
	$('.searchLoading').fadeIn(500);
	var brand = $('#carBrands').val();
	var year = $('#year').val();
	var type = $('#carType').val();
	if (brand != 0) {
		$.ajax({url: site_url+'Service/getModels/'+type+'/'+brand+'/'+year,
				method:'POST',
				dataType : 'JSON',
			success: function(result){
				if (result == 'error') {

					$('#carModels').attr('disabled','');
					$('#carSubModels').attr('disabled','');
				}else{

					if (result.length != 1) {
						var datTxt = '<option value="0">- Model -</option>';
					}else{
						var datTxt = '';
					}

					$.each( result, function( key, val ) {
						datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
					});

					$('#carModels').html(datTxt);
					$('#carModels').removeAttr('disabled');
					$('#carSubModels').attr('disabled','');
					if (result.length == 1) {
						carModels();
					}else{
						$('.searchLoading').fadeOut(500);
					}			
				}
			},
			error:function(){
				$('#carModels').attr('disabled','');
				$('#carSubModels').attr('disabled','');
				$('#carMotors').attr('disabled','');
				$('.searchLoading').fadeOut(500);
			}
		});
	}else{
		$('#carModels').attr('disabled','');
		$('#carSubModels').attr('disabled','');
		$('#carMotors').attr('disabled','');
		$('.searchLoading').fadeOut(500);
	}
}

//Araç Modeli
function carModels() {
	$('.searchLoading').fadeIn(500);
	var model 	= $('#carModels').val();
	var type 	= $('#carType').val();
	var brand 	= $('#carBrands').val();
	var year 	= $('#year').val();
	$.ajax({url: site_url+'Service/getSubModels/'+type+'/'+brand+'/'+model+'/'+year,
			method:'POST',
			dataType : 'JSON',
		success: function(result){
			if (result == 'error') {
				$('#carSubModels').attr('disabled','');
			}else{

				if (result.length != 1) {
					var datTxt = '<option value="0">- Alt Model -</option>';
				}else{
					var datTxt = '';
				}

				$.each( result, function( key, val ) {
					datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
				});

				$('#carSubModels').html(datTxt);
				$('#carSubModels').removeAttr('disabled');
				if (result.length == 1) {
					CarDetails();
				}else{
					$('.searchLoading').fadeOut(500);
				}
			}
		},
		error:function(){
			$('#carSubModels').attr('disabled','');
			$('#carMotors').attr('disabled','');
			$('.searchLoading').fadeOut(500);
		}
	});
}

//Araç Markası
function carBrands() {

	$('.searchLoading').fadeIn(500);
	$('#year').removeAttr('disabled');
	$('#carModels').attr('disabled','');
	$('#carSubModels').attr('disabled','');
	$('.searchLoading').fadeOut(500);
}

//Araç Detay
function CarDetails() {
	$('.searchLoading').fadeIn(500);
	var type 		= $('#carType').val();
	var brand 		= $('#carBrands').val();
	var model 		= $('#carModels').val();
	var year 		= $('#year').val();
	var subModel	= $('#carSubModels').val();

	if (type == 0) {
		$('#carType').addClass('border-danger');
					$('.searchLoading').fadeOut(500);
	}else if (brand == 0) {
		$('#carBrands').addClass('border-danger');
		$('#carType').removeClass('border-danger');
					$('.searchLoading').fadeOut(500);
	}else if (model == 0) {
		$('#carModels').addClass('border-danger');
		$('#carType').removeClass('border-danger');
		$('#carBrands').removeClass('border-danger');
					$('.searchLoading').fadeOut(500);
	}else if (subModel == 0) {
		$('#carSubModels').addClass('border-danger');
		$('#carModels').removeClass('border-danger');
		$('#carBrands').removeClass('border-danger');
		$('#carType').removeClass('border-danger');
					$('.searchLoading').fadeOut(500);
	}else{
		$('#carSubModels').removeClass('border-danger');
		$('#carModels').removeClass('border-danger');
		$('#carBrands').removeClass('border-danger');
		$('#carType').removeClass('border-danger');
		$.ajax({url: site_url+'Service/getOptions/'+type+'/'+brand+'/'+model+'/'+subModel+'/'+year,
				method:'POST',
				dataType : 'JSON',
			success: function(result){
				if (result == 'error') {

				}else{
					var i = 0;
					$.each(result, function(key,val) {
						if (val != '') {
							i++;
						}
					});

					var carDetail = '';
					if (i == 0) {
						carDetail = '<h3>Bir Hata Oluştu</h3>';
					}else{
						var adetler = {gear : 0, engine : 0, body : 0};
						$.each(result, function(key,val) {

							if (key == 'engine') {
								var baslik = 'Motor';
								adetler.engine = val.length;
							}else if (key == 'gear') {
								var baslik = 'Şanzıman';
								adetler.gear = val.length;
							}else if (key == 'body') {
								var baslik = 'Kasa';
								adetler.body = val.length;
							}
							//
							if (val != '') {
								if (key == 'gear') {
									if (adetler.engine == 1) {
										carDetail += '<select id="car_'+key+'" class="form-control mt-2 selectes">';
									}else{
										carDetail += '<select id="car_'+key+'" class="form-control mt-2 selectes" disabled>';
									}
								}else if (key == 'body') {
									if (adetler.gear == 1) {
										carDetail += '<select id="car_'+key+'" class="form-control mt-2 getConst">';
									}else{
										carDetail += '<select id="car_'+key+'" class="form-control mt-2 getConst" disabled>';
									}
								}else{
									carDetail += '<select id="car_'+key+'" class="form-control mt-2 selectes">';
								}

								if (val.length != 1 || key == 'body') {
									carDetail += '<option value="0"> - '+baslik+' - </option>';	
								}

								$.each(val, function(key2,val2) {
									carDetail += '<option value="'+val2.key+'">'+val2.value+'</option>'
								});
								carDetail += '</select>';
							}
						});
						carDetail += '<select id="car_consTime" class="form-control mt-2" disabled>\
										<option value="0"> - Trafiğe Çıkış - </option>\
									  </select>';
						//console.log(adetler);
					}

					$('.carSelectDetail').html(carDetail);
					$('.searchLoading').fadeOut(500);
					$('.extraArea').fadeIn();
				}
			},
			error:function(result){
				alert('Hata carDetails');
					$('.searchLoading').fadeOut(500);
			}
		});
	}
}

function SearchPart() {
	//carId
	var data = {};
	data.carId = $('#carId').attr('value');
	data.consTime = $('#car_consTime').val();
	setCookie('selectedCarAdmin', JSON.stringify(data), 1);
	window.location.href = site_url+"/Admin/Dvnlist/DvnInstall";
}


function addGarrage() {
	var data = {};
	data.carId = $('#carId').attr('value');
	data.consTime = $('#car_consTime').val();
	
	$.ajax({url: site_url+'Service/addGarrage',
			method:'POST',
			data: data,
			success:function(result){
				window.location.href = site_url+"Account/garage";
			},error:function(result) {
				window.location.href = site_url+"User";
			}
	});
}