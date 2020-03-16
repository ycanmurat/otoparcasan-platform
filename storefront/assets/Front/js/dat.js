var site_url = 'https://otoparcasan.kodakil.com/';
$( document ).ready(function() {
	$('#carType').val('0');
	//$('#year').val('0');
	$('#carBrands').val('0');
	$('#carModels').val('0');
	$('#carSubModels').val('0');


	//Araç Tipi
	$('#carType').on('change',function() {
		carType();
	});

	//Araç Yılı
	/*
	$('#year').on('change',function() {
		carYear();
	});
	*/


	//Araç Markası
	$('#carBrands').on('change',function() {
		carYear();
		//carBrands();
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
		getConst();
	});

	$(document).on('change', '#car_consTime',function() {
		$('#car_consTime > option[value=0]').remove();
	});

	

	function getConst() {
		$('.searchLoading').fadeIn(500);
		$('.getConst > option[value=0]').remove();

		var data 		= {};
		data.type 		= $('#carType').val();
		data.brand 		= $('#carBrands').val();
		data.model 		= $('#carModels').val();
		data.subModel	= $('#carSubModels').val();
		data.body		= $('#car_body').val();
		data.engine		= $('#car_engine').val();
		//data.year		= $('#year').val();
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
				$('.searchLoading').fadeOut(500);
			},error:function(result) {
				$('.searchLoading').fadeIn(500);
			}
		});
	}

	//alt seçenekler
	$(document).on('change', '.selectes',function() {
		$('.searchLoading').fadeIn(500);
		var data = {};
		data.type 		= $('#carType').val();
		data.brand 		= $('#carBrands').val();
		data.model 		= $('#carModels').val();
		data.subModel	= $('#carSubModels').val();
		//data.year		= $('#year').val();
		data.selected 	= $(this).val();
		data.name 		= $(this).attr('id');
		$('> option[value=0]',this).remove();
		if (data.name == 'car_gear') {
			data.engine_selected = $('#car_engine').val();
		}else{
			data.engine_selected = 0;
		}

		if (data.name == 'car_body') {
			data.engine_selected = $('#car_engine').val();
			data.gear_selected = $('#car_gear').val();
		}else{
			data.gear_selected = 0;
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
							if (result.gear.length == 1) {
								$.each( result.gear, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});
							}else{
								datTxt += '<option value="0"> - Şanzıman - </option>';
								$.each( result.gear, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});
							}

							$('#car_gear').html(datTxt);
							$('#car_gear').removeAttr('disabled');
							$('#car_body').attr('disabled','');
							$('#car_body').html('<option value="0"> - Kasa - </option> ');
							$('#car_equipment').attr('disabled','');
							$('#car_equipment').html('<option value="0"> - Dizayn - </option> ');
							$('#car_consTime').attr('disabled','');
							$('#car_consTime').html('<option value="0"> - Trafiğe Çıkış - </option> ');

							if (result.gear.length == 1) {
								$('#car_gear').trigger('change');
							}

						}else if (data.name == 'car_gear') {
							
							if (result.body.length == 1) {
								$.each( result.body, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});
							}else{
								datTxt += '<option value="0"> - Kasa - </option>';
								$.each( result.body, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});
							}
							
							$('#car_body').html(datTxt);
							$('#car_body').removeAttr('disabled');
							$('#car_consTime').attr('disabled','');
							$('#car_consTime').html('<option value="0"> - Trafiğe Çıkış - </option> ');

							if (result.body.length == 1) {
								$('#car_body').trigger('change');
							}
						}else if (data.name == 'car_body') {
							if (result.equipment.length == 1) {
								$.each( result.equipment, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});

								$('.getConst').trigger('change');
							}else{
								datTxt += '<option value="0"> - Dizayn - </option>';
								$.each( result.equipment, function( key, val ) {
									datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
								});
							}

							//console.log(datTxt);
							$('#car_equipment').html(datTxt);
							$('#car_equipment').removeAttr('disabled');
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

		/*
		var data55 = $('#carDetail').text();
		if (data55.length>5) {
			data55 = $.parseJSON(data55);
			carData = {};
			carData.type = data55.Vehicle.VehicleType;
			carData.marka = data55.Vehicle.Manufacturer;
			carData.model = data55.Vehicle.BaseModel;
			carData.altModel = data55.Vehicle.SubModel;

			setTimeout(function(){
				$('#carType').val(carData.type).trigger('change');
				setTimeout(function(){
					$('#carBrands').val(carData.marka).trigger('change');
						setTimeout(function(){
							$('#carModels').val(carData.model).trigger('change');
							setTimeout(function(){
								$('#carSubModels').val(carData.altModel).trigger('change');
							}, 1000);
						}, 1000);
				}, 1000);
			}, 1000);
		}
		*/
});


$(document).mouseup(function(e) {
	var divSelect = $(".extraArea");
  	if (!divSelect.is(e.target) && divSelect.has(e.target).length === 0) {
		$('.extraArea').fadeOut();
	}
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

					populerTxt 	= '';
					normalTxt 	= '';
					
					$.each( result, function( key, val ) {
						var count = 0;
						for (var k in val) {
						    if (val.hasOwnProperty(k)) {
						       ++count;
						    }
						}
						
						if (count == 2) {
							datTxt += '<option value="'+val.key+'">'+val.value+'</option>';
						}else{
							if (val.status == 1) {
								if (val.popilar == 1) {
									populerTxt += '<option value="'+val.key+'">'+val.name+'</option>';
								}else{
									normalTxt  += '<option value="'+val.key+'">'+val.name+'</option>';
								}
							}	
						}
					});

					if (populerTxt.length > 0) {
						datTxt += '<optgroup label="Popüler Markalar">';
						datTxt += populerTxt;
						datTxt += '</optgroup>';

						datTxt += '<optgroup label="Diğer">';
						datTxt += normalTxt;
						datTxt += '</optgroup>';
					}else{
						datTxt += normalTxt;
					}
					//datTxt += '</optgroup>';

					$('#carBrands').html(datTxt);
					$('#carBrands').removeAttr('disabled');

					$('#carModels').attr('disabled','');
					$('#carSubModels').attr('disabled','');
					$('#carModels').val('0');
					$('#carSubModels').val('0');
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

var allProduct = '';

function carYear() {
	$('.searchLoading').fadeIn(500);
	var brand = $('#carBrands').val();
	//var year = $('#year').val();
	var type = $('#carType').val();
	if (brand != 0) {
		$.ajax({url: site_url+'Service/getModels/'+type+'/'+brand,//+'/'+year,
				method:'POST',
				dataType : 'JSON',
			success: function(result){
				allProduct = result; 
				if (result == 'error') {
					$('#carModels').attr('disabled','');
					$('#carSubModels').attr('disabled','');
				}else{
					if (result.length != 1) {
						var datTxt = '<option value="0">- Model -</option>';
					}else{
						var datTxt = '';
					}

					var onceki = '';
					$.each( result, function( key, val ) {

						var count = 0;
						for (var k in val) {
						    if (val.hasOwnProperty(k)) {
						       ++count;
						    }
						}

						if (count == 2) {

							var baslik = val.value.split('(',1);

							if (onceki == '') {
								onceki = baslik[0].trim();
								datTxt += '<optgroup label="'+baslik+'">';
							}else if (onceki != baslik[0].trim()) {
								datTxt += '</optgroup>';
								onceki = baslik[0].trim();
								datTxt += '<optgroup label="'+baslik+'">';
							}

							datTxt += '<option value="'+val.key+'">'+val.value+'</option>';
						}else{
							if (val.status == 1) {
								var baslik = val.name.split('(',1);
								if (onceki == '') {
									onceki = baslik[0].trim();
									datTxt += '<optgroup label="'+baslik+'">';
								}else if (onceki != baslik[0].trim()) {
									datTxt += '</optgroup>';
									onceki = baslik[0].trim();
									datTxt += '<optgroup label="'+baslik+'">';
								}
								datTxt += '<option value="'+val.key+'">'+val.name+'</option>';
							}	
						}
					});

					$('#carModels').html(datTxt);
					$('#carModels').removeAttr('disabled');
					$('#carSubModels').val('0');
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
	//var year 	= $('#year').val();
	$.ajax({url: site_url+'Service/getSubModels/'+type+'/'+brand+'/'+model,//+'/'+year,
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

				var onceki = '';
				$.each( result, function( key, val ) {

					var baslik = val.value.split(' ',1);
					if (onceki == '') {
						onceki = baslik[0].trim();
						datTxt += '<optgroup label="'+baslik+'">';
					}else if (onceki != baslik[0].trim()) {
						datTxt += '</optgroup>';
						onceki = baslik[0].trim();
						datTxt += '<optgroup label="'+baslik+'">';
					}
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
/*
function carBrands() {

	$('.searchLoading').fadeIn(500);
	$('#year').removeAttr('disabled');
	$('#carModels').attr('disabled','');
	$('#carSubModels').attr('disabled','');
	$('.searchLoading').fadeOut(500);
}
*/

//Araç Detay
function CarDetails() {
	$('.searchLoading').fadeIn(500);
	var type 		= $('#carType').val();
	var brand 		= $('#carBrands').val();
	var model 		= $('#carModels').val();
	//var year 		= $('#year').val();
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
		$.ajax({url: site_url+'Service/getOptions/'+type+'/'+brand+'/'+model+'/'+subModel,//+'/'+year,
				method:'POST'
,				dataType : 'JSON',
			success: function(result){
				if (result == 'error') {
					console.log('Araç Hatalı');
					$('.searchLoading').fadeOut(500);
				}else{
					console.log(result);
					var carDetail = '';
					var oncekiLength = 0;
					var i = 0;
					$.each(result, function(key,val) {
						if (key == 'engine') {
							var baslik = 'Motor';
						}else if (key == 'gear') {
							var baslik = 'Şanzıman';
						}else if (key == 'body') {
							var baslik = 'Kasa';
						}else if (key == 'equipment') {
							var baslik = 'Dizayn';
						}

						if ((oncekiLength == 0 || oncekiLength == 1) && i == 0) {
							carDetail += '<select id="car_'+key+'" class="custom-select mt-2 selectes">';
							if (val.length > 1) {
								carDetail += '<option value="0"> - ' + baslik + ' - </option>';
							}

							oncekiLength = val.length;
							$.each(val, function(key2,val2) {
								carDetail += '<option value="'+val2.key+'">'+val2.value+'</option>'
							});
						}else{
							carDetail += '<select id="car_'+key+'" class="custom-select mt-2 selectes" disabled>';
							carDetail += '<option value="0"> - ' + baslik + ' - </option>';
							i++;
						}

						carDetail += '</select>';
					});
					$('.carSelectDetail').html(carDetail);
					var sonuncu = $('.carSelectDetail > select').last();
					$(sonuncu).removeClass('selectes').addClass('getConst');


					var consTimeTxt = '<select id="car_consTime" class="custom-select mt-2" disabled>\
										<option value="0"> - Trafiğe Çıkış - </option>\
								  	   </select>';
					$('.carSelectDetail').append(consTimeTxt);

					if (i == 0) {
						$('.getConst').trigger('change');
					}

					$('.searchLoading').fadeOut(500);
					$('.extraArea').fadeIn();
				}
			},
			error:function(result){
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
	setCookie('selectedCar', JSON.stringify(data), 1);
	window.location.href = site_url+"Category/";
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

var allData = {};

function sasiSearch() {
	vin = $('#chasisNo').val().trim();
	$('.big-searchLoading').removeClass('gizle');
	
	if (vin.length == 17) {
		$.ajax({
				url: site_url+'Service/getVinSearch/'+vin,
				method:'POST',
				dataType : 'JSON',
				success:function(result){
					allData = result;
					var allSelect 	= '';
					var allBaslik 	= '';
					var nameText 	= '';

					$('.sasiSearchSasiNumber').text(vin.toUpperCase());

					if (result.marka.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Marka</div>';
						allSelect += '<select class="form-control custom-select sasiselect sasiSearchSelects" id="markaSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Marka</option>';
					   	}
						$.each(result.marka, function(key,val) {
							allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
						});
						allSelect += '</select>';
					
					}else{
						nameText += '<p>Marka : '+result.marka[0].name+'</p>';
					}

					if (result.model.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Model</div>';
						allSelect += '<select data-text="Model" class="form-control custom-select sasiselect sasiSearchSelects" id="modelSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Model</option>';
					   	}
							$.each(result.model, function(key,val) {
								allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
							});
						allSelect += '</select>';
					
					}else{
						nameText += '<p>Model : '+result.model[0].name+'</p>';
					}


					if (result.altModel.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Alt Model</div>';
						allSelect += '<select data-text="Alt Model" class="form-control custom-select sasiselect sasiSearchSelects" id="altModelSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Alt Model</option>';
					   	}
							$.each(result.altModel, function(key,val) {
								allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
							});
						allSelect += '</select>';
					
					}else{
						nameText += '<p>Alt Model : '+result.altModel[0].name+'</p>';
					}

					if (result.motor.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Motor Tipi</div>';
						allSelect += '<select data-text="Motor Tipi" class="form-control custom-select sasiselect sasiSearchSelects" id="engineSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Motor Tipi</option>';
					   	}
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled>  Motor Tipi</option>';
					   	}
							$.each(result.motor, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else{
						nameText += '<p>Motor : '+result.motor[0].ns1Description+'</p>';
					}

					if (result.govde.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Gövde</div>';
						allSelect += '<select data-text="Gövde" class="custom-select sasiselect sasiSearchSelects" id="sasiSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Gövde</option>';
					   	}
							$.each(result.govde, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else{
						nameText += '<p>Gövde : '+result.govde[0].ns1Description+'</p>';
					}

					if (result.sanziman.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Şanzıman Tipi</div>';
						allSelect += '<select data-text="Şanzıman" class="custom-select sasiselect sasiSearchSelects" id="sanzimanSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Şanzıman Tipi</option>';
					   	}
							$.each(result.sanziman, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else{
						nameText += '<p>'+result.sanziman[0].ns1Description+'</p>';
					}

					if (result.aks.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Aks Mesafesi</div>';
						allSelect += '<select data-text="Aks Mesafesi" class="custom-select sasiselect sasiSearchSelects" id="aksSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Aks Mesafesi</option>';
					   	}
							$.each(result.aks, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else if (result.aks.length == 1) {
						nameText += '<p>'+result.aks[0].ns1Description+'</p>';
					}

					if (result.dizayn.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Dizayn</div>';
						allSelect += '<select data-text="Dizayn" class="custom-select sasiselect sasiSearchSelects" id="dizaynSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Dizayn</option>';
					   	}
							$.each(result.dizayn, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else if (result.dizayn.length == 1) {
						nameText += '<p> '+result.dizayn[0].ns1Description+'</p>';
					}

					if (result.tahrik.length > 1) {
						allBaslik += '<div class="sasiSelectBaslik">Tahrik Şekli</div>';
						allSelect += '<select data-text="Tahrik Şekli" class="custom-select sasiselect sasiSearchSelects" id="tahrikSelect" size="15">';
						if(window.innerWidth <= 800 && window.innerHeight <= 600) {
							allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Tahrik Şekli</option>';
					   	}
							$.each(result.tahrik, function(key,val) {
								allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
							});
						allSelect += '</select>';
					}else if (result.tahrik.length == 1) {
						nameText += '<p>'+result.tahrik[0].ns1Description+'</p>';
					}

					$('.allBaslik').html(allBaslik);
					$('.allSelect').html(allSelect);
					$('.sasiSecililer').html(nameText);
					$('#carImageSasi').attr('src',result.image);
					$('.sasiSearchSelects:not(:first)').attr('disabled','');


					$('#sasiModal').modal();

					$('.big-searchLoading').addClass('gizle');
					//console.log(result);
				},error:function(data) {
					$('.big-searchLoading').addClass('gizle');
					Swal.fire({type: 'error', title: 'Hata !', html: '<p style="text-align:center;">Girilen Şase Numarası ile ilgili bir sonuca ulaşamadık. Şase numaranızı kontrol edebilir veya araç ağacından arama yapmayı deneyebilirsiniz.</p>', animation: false, customClass: 'animated tada'});
				}
		});
	}else{
		$('.big-searchLoading').addClass('gizle');
		Swal.fire({type: 'error', title: 'Hata !', html: '<p style="text-align:center;">Girilen Şase Numarası 17 hane olmak zorundadır.</p>', animation: false, customClass: 'animated tada'});
	}

}


$(document).on('change','[name="garaggeCars"]',function() {
	garaggeData = {};
	garaggeData.carId = $(this).val();
	garaggeData.consTime = $('> option:selected',this).attr('cons_time');
	setCookie('selectedCar', JSON.stringify(garaggeData), 1);
	location.reload();
});

$(document).on('change','.sasiSearchSelects',function() {

	var data = {};
	data.degisen = $(this).attr('id');
	data.secili = $(this).val();
	data.sonraki = $(this).next('select').attr('id');
	data.insertedSelect = '';
	data.inserted = [];
	data.prevAll = [];
	//console.log(data);

	if (data.sonraki == 'markaSelect') {
		data.sonrakiName = 'Marka';
	}else if (data.sonraki == 'modelSelect') {
		data.sonrakiName = 'Model';
	}else if (data.sonraki == 'altModelSelect') {
		data.sonrakiName = 'Alt Model';
	}else if (data.sonraki == 'engineSelect') {
		data.sonrakiName = 'Motor';
	}else if (data.sonraki == 'sasiSelect') {
		data.sonrakiName = 'Gövde';
	}else if (data.sonraki == 'sanzimanSelect') {
		data.sonrakiName = 'Şanzıman';
	}else if (data.sonraki == 'aksSelect') {
		data.sonrakiName = 'Aks Mesafesi';
	}else if (data.sonraki == 'dizaynSelect') {
		data.sonrakiName = 'Dizayn Türü';
	}else if (data.sonraki == 'tahrikSelect') {
		data.sonrakiName = 'Tahrik Şekli';
	}

	$.each($(this).prevAll('select'), function(key,val) {
		var id = $(val).attr('id');
		var value = $(val).val();
		data.prevAll.push({id:id,val:value});
	});


	if (data.prevAll == false || data.prevAll.length == 0) {
		if (data.degisen == 'markaSelect') {
			$.each(allData.result, function(key,val) {
				if (val.ns1Manufacturer == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'modelSelect') { // Bir sonraki selectin içinde ne olduğuna göre dolduruyoruz içerisini 
						if (data.inserted  == false || data.inserted.length == 0) { //doldurulacak dizi boşsa ilk veriyi içine at
							data.inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
						}else{ // doldurulacak verinin içerisinde bir veri varsa tekrara düşmemek için sorgulamalar
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1BaseModel) {//kaydedilecek veri içerde var mı yok mu kontrolü
									i++;
								}
							});
							if (i == 0) { // yoksa i = 0 olarak geliyo veriyi yanına ekliyorum
								data.inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
							}
						}
					}else if (data.sonraki == 'altModelSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1SubModel) {
									i++;
								}
							});
							if (i == 0) {
								data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
							}
						}
					}else if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'modelSelect') {
			$.each(allData.result, function(key,val) {
				if (val.ns1BaseModel == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'altModelSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1SubModel) {
									i++;
								}
							});
							if (i == 0) {
								data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
							}
						}
					}else if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'altModelSelect') {
			$.each(allData.result, function(key,val) {
				if (val.ns1SubModel == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'engineSelect') {
			$.each(allData.result, function(key,val) {
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 1) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'sasiSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'sanzimanSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'sasiSelect') {
			$.each(allData.result, function(key,val) {
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 2) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'sanzimanSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'sanzimanSelect') {
			$.each(allData.result, function(key,val) {
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 11) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});
			});
		}else if (data.degisen == 'aksSelect') {
			$.each(allData.result, function(key,val) {
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 3) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'dizaynSelect') {
			$.each(allData.result, function(key,val) {
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 10) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}
	}else{
		if (data.degisen == 'markaSelect') {
			$.each(allData.result, function(key,val) {
				if (val.ns1Manufacturer == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'modelSelect') { // Bir sonraki selectin içinde ne olduğuna göre dolduruyoruz içerisini 
						if (data.inserted  == false || data.inserted.length == 0) { //doldurulacak dizi boşsa ilk veriyi içine at
							data.inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
						}else{ // doldurulacak verinin içerisinde bir veri varsa tekrara düşmemek için sorgulamalar
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1BaseModel) {//kaydedilecek veri içerde var mı yok mu kontrolü
									i++;
								}
							});
							if (i == 0) { // yoksa i = 0 olarak geliyo veriyi yanına ekliyorum
								data.inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
							}
						}
					}else if (data.sonraki == 'altModelSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1SubModel) {
									i++;
								}
							});
							if (i == 0) {
								data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
							}
						}
					}else if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'modelSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				if (val.ns1BaseModel == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'altModelSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								if (val2.id == val.ns1SubModel) {
									i++;
								}
							});
							if (i == 0) {
								data.inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
							}
						}
					}else if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'altModelSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}

				if (val.ns1SubModel == data.secili) { //secilen variant tutuyosa işleme al
					if (data.sonraki == 'engineSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sasiSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'sanzimanSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'aksSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'dizaynSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}else if (data.sonraki == 'tahrikSelect') {
						if (data.inserted  == false || data.inserted.length == 0) {
							$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
								if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
									data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
								}
							});
						}else{
							var i = 0;
							$.each(data.inserted,function(key2,val2) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										if (val2.id == val5.ns1DatEquipmentId) {
											i++;
										}
									}
								});
							});
							if (i == 0) {
								$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
									if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
										data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
									}
								});
							}
						}
					}
				}
			});	
		}else if (data.degisen == 'engineSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 1) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'sasiSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'sanzimanSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'sasiSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 2) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'sanzimanSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'sanzimanSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 11) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'aksSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});
			});
		}else if (data.degisen == 'aksSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 3) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'dizaynSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}else if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}else if (data.degisen == 'dizaynSelect') {
			$.each(allData.result, function(key,val) {
				var r = false;
				$.each(data.prevAll, function(key77,val77) {
					if (val77.id == 'markaSelect') {
						if (val77.val != val.ns1Manufacturer) {
							r = true;
						}
					}else if (val77.id == 'modelSelect') {
						if (val77.val != val.ns1BaseModel) {
							r = true;
						}
					}else if (val77.id == 'altModelSelect') {
						if (val77.val != val.ns1SubModel) {
							r = true;
						}
					}else if (val77.id == 'engineSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 1) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sasiSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 2) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'sanzimanSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 11) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'aksSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 3) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'dizaynSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 10) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}else if (val77.id == 'tahrikSelect') {
						$.each(val.equipment,function(key5,val5) {
							if (val5.ns1EquipmentClass == 4) {
								if (val77.val != val5.ns1DatEquipmentId) {
									r = true;
								}
							}
						});
					}
				});
				if (r) {
					return true;
				}
				$.each(val.equipment, function(key55,val55) {
					if (val55.ns1EquipmentClass == 10) {
						if (val55.ns1DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
							if (data.sonraki == 'tahrikSelect') {
								if (data.inserted  == false || data.inserted.length == 0) {
									$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
										if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
											data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
										}
									});
								}else{
									var i = 0;
									$.each(data.inserted,function(key2,val2) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												if (val2.id == val5.ns1DatEquipmentId) {
													i++;
												}
											}
										});
									});
									if (i == 0) {
										$.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
											if (val5.ns1EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
												data.inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
											}
										});
									}
								}
							}
						}
					}
				});	
			});	
		}
	}



	if(window.innerWidth <= 800 && window.innerHeight <= 600) {
		data.insertedSelect += '<option value="" default disabled selected>'+data.sonrakiName+'</option>';
   	}
   	
	$.each(data.inserted, function(key,val) {
		data.insertedSelect += 	'<option value="'+val.id+'">'+val.name+'</option>';
	});



	$(this).next('select').html(data.insertedSelect);
	if ($(this).next('select').length>0) {
		$('.allSelect').scrollTo($(this).next('select'), 700);
	}

	$('.sasiSearchSelects').attr('disabled','disabled');
	$(this).removeAttr('disabled');
	$(this).next('select').removeAttr('disabled');
	$(this).prevAll('select').removeAttr('disabled');
});

function sasiAra(url) {
	data = [];
	var ir = 0;
	$.each($('.sasiSearchSelects'),function(key,val) {
		if ($(this).val() == null) {
			$(this).attr('style','border:1px solid red;');
			ir++;
		}else{
			$(this).attr('style','border:1px solid #ced4da;');
			var val		= $(this).val();
			var name 	= $(this).attr('id');
			data.push({name:name,val:val});
		}
	});

	if (ir == 0) {
		$.each(allData.result,function(key,val) {
			var i = 0;
			$.each(data,function(key2,val2) {
				if (val2.name == 'markaSelect') {
					if (val2.val != val.ns1Manufacturer) {
						i++;
					}
				}else if (val2.name == 'modelSelect') {
					if (val2.val != val.ns1BaseModel) {
						i++;
					}
				}else if (val2.name == 'altModelSelect') {
					if (val2.val != val.ns1SubModel) {
						i++;
					}
				}else if (val2.name == 'engineSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 1) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'sasiSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 2) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'sanzimanSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 11) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'aksSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 3) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'dizaynSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 10) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'tahrikSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 4) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}
			});
			if (i == 0) {
				var carData = {};
				carData.carId = val.ns1DatECode;
				carData.consTime = val.ns1ConstructionTimeFrom;
				setCookie('selectedCar', JSON.stringify(carData), 1);
				window.location.href = url;
				$('#sasiSearchErrorText').addClass('gizle');
			}
		});
	}else{
		$('#sasiSearchErrorText').removeClass('gizle');
	}
}

function changeSelectedCar(id,time) {
	var carData = {};
	carData.carId = id;
	carData.consTime = time;
	setCookie('selectedCar', JSON.stringify(carData), 1);
	window.location.href = site_url+"Category/";
}


function sasiGarajaEkle() {
	data = [];
	var ir = 0;
	$.each($('.sasiSearchSelects'),function(key,val) {
		if ($(this).val() == null) {
			$(this).attr('style','border:1px solid red;');
			ir++;
		}else{
			$(this).attr('style','border:1px solid #ced4da;');
			var val		= $(this).val();
			var name 	= $(this).attr('id');
			data.push({name:name,val:val});
		}
	});

	if (ir == 0) {
		$.each(allData.result,function(key,val) {
			var i = 0;
			$.each(data,function(key2,val2) {
				if (val2.name == 'markaSelect') {
					if (val2.val != val.ns1Manufacturer) {
						i++;
					}
				}else if (val2.name == 'modelSelect') {
					if (val2.val != val.ns1BaseModel) {
						i++;
					}
				}else if (val2.name == 'altModelSelect') {
					if (val2.val != val.ns1SubModel) {
						i++;
					}
				}else if (val2.name == 'engineSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 1) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'sasiSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 2) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'sanzimanSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 11) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'aksSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 3) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'dizaynSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 10) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}else if (val2.name == 'tahrikSelect') {
					$.each(val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 4) {
							if (val2.val != val5.ns1DatEquipmentId) {
								i++;
							}
						}
					});
				}
			});
			if (i == 0) {
				var carData = {};
				carData.carId = val.ns1DatECode;
				carData.consTime = val.ns1ConstructionTimeFrom;
				$.ajax({url: site_url+'Service/addGarrage',
					method:'POST',
					data: carData,
					success:function(result){
						if (result == 'Err') {
							Swal.fire({type: 'error', title: 'Hata !', html: '<p style="text-align:center;">Bu araç garajınızda zaten var.</p>', animation: false, customClass: 'animated tada'});
						}else{
							setCookie('selectedCar', JSON.stringify(carData), 1);
							$('#sasiSearchErrorText').addClass('gizle');
							window.location.href = site_url+"Account/garage";
						}
					},error:function(result) {
						$('#sasiSearchErrorText').addClass('gizle');
						window.location.href = site_url+"User";
					}
				});
			}
		});
	}else{
		$('#sasiSearchErrorText').removeClass('gizle');
	}
}