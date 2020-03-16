var site_url = 'https://otoparcasan.kodakil.com/';
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
										carDetail += '<select id="car_'+key+'" class="custom-select mt-2 selectes">';
									}else{
										carDetail += '<select id="car_'+key+'" class="custom-select mt-2 selectes" disabled>';
									}
								}else if (key == 'body') {
									if (adetler.gear == 1) {
										carDetail += '<select id="car_'+key+'" class="custom-select mt-2 getConst">';
									}else{
										carDetail += '<select id="car_'+key+'" class="custom-select mt-2 getConst" disabled>';
									}
								}else{
									carDetail += '<select id="car_'+key+'" class="custom-select mt-2 selectes">';
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
						carDetail += '<select id="car_consTime" class="custom-select mt-2" disabled>\
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
	vin = $('#chasisNo').val();
	
	$.ajax({
			url: site_url+'Service/getVinSearch/'+vin,
			method:'POST',
			dataType : 'JSON',
			success:function(result){
				allData = result;
				var allSelect 	= '';
				var nameText 	= '';

				if (result.marka.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="markaSelect" size="15">';
						$.each(result.marka, function(key,val) {
							allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
						});
					allSelect += '</select>';
				
				}else{
					nameText += '<p>Marka : '+result.marka[0].name+'</p>';
				}

				if (result.model.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="modelSelect" size="15">';
						$.each(result.model, function(key,val) {
							allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
						});
					allSelect += '</select>';
				
				}else{
					nameText += '<p>Model : '+result.model[0].name+'</p>';
				}


				if (result.altModel.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="altModelSelect" size="15">';
						$.each(result.altModel, function(key,val) {
							allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
						});
					allSelect += '</select>';
				
				}else{
					nameText += '<p>Alt Model : '+result.altModel[0].name+'</p>';
				}

				if (result.motor.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="engineSelect" size="15">';
						$.each(result.motor, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else{
					nameText += '<p>Motor : '+result.motor[0].ns1Description+'</p>';
				}

				if (result.govde.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="sasiSelect" size="15">';
						$.each(result.govde, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else{
					nameText += '<p>Gövde : '+result.govde[0].ns1Description+'</p>';
				}

				if (result.sanziman.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="sanzimanSelect" size="15">';
						$.each(result.sanziman, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else{
					nameText += '<p>'+result.sanziman[0].ns1Description+'</p>';
				}

				if (result.aks.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="aksSelect" size="15">';
						$.each(result.aks, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else if (result.aks.length == 1) {
					nameText += '<p>'+result.aks[0].ns1Description+'</p>';
				}

				if (result.dizayn.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="dizaynSelect" size="15">';
						$.each(result.dizayn, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else if (result.dizayn.length == 1) {
					nameText += '<p> '+result.dizayn[0].ns1Description+'</p>';
				}

				if (result.tahrik.length > 1) {
					allSelect += '<select class="custom-select sasiselect sasiSearchSelects" id="tahrikSelect" size="15">';
						$.each(result.tahrik, function(key,val) {
							allSelect += '<option value="'+val.ns1DatEquipmentId+'">'+val.ns1Description+'</option>';
						});
					allSelect += '</select>';
				}else if (result.tahrik.length == 1) {
					nameText += '<p>'+result.tahrik[0].ns1Description+'</p>';
				}

				$('.allSelect').html(allSelect);
				$('.sasiSecililer').html(nameText);
				$('#carImageSasi').attr('src',result.image);
				$('.sasiSearchSelects:not(:first)').attr('disabled','');


				$('#sasiModal').modal();

				//console.log(result);
			}
	});
}


$(document).on('change','.sasiSearchSelects',function() {

	var data = {};
	data.degisen = $(this).attr('id');
	data.secili = $(this).val();
	data.sonraki = $(this).next('select').attr('id');
	var insertedSelect = '';
	var inserted = [];

	if (data.degisen == 'markaSelect') {
		$.each(allData.result, function(key,val) {
			var i = 0;
			if (val.ns1Manufacturer == data.secili) {
				if (inserted === undefined || inserted.length == 0) {
					if (data.sonraki == 'modelSelect') {
						inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
					}else if (data.sonraki == 'altModelSelect') {
						inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
					}

					$.each($val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 1) {
							if (data.sonraki == 'engineSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 2) {
							if (data.sonraki == 'sasiSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 11) {
							if (data.sonraki == 'sanzimanSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 3) {
							if (data.sonraki == 'aksSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 10) {
							if (data.sonraki == 'dizaynSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 4) {
							if (data.sonraki == 'tahrikSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}
					});
				}else{
					$.each(inserted, function(key,val2) {
						if (data.sonraki == 'modelSelect') {
							if (val2.id == val.ns1BaseModel) {
								i++;
							}
						}else if (data.sonraki == 'altModelSelect') {
							if (val2.id == val.ns1SubModel) {
								i++;
							}
						}else if (data.sonraki == 'engineSelect') {
							if (val2.id == val.equipment[0].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sasiSelect') {
							if (val2.id == val.equipment[1].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sanzimanSelect') {
							if (val2.id == val.equipment[2].ns1DatEquipmentId) {
								i++;
							}
						}
					});
					if (i == 0) {
						if (data.sonraki == 'modelSelect') {
							inserted.push({id:val.ns1BaseModel,name:val.ns1BaseModelName});
						}else if (data.sonraki == 'altModelSelect') {
							inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else if (data.sonraki == 'engineSelect') {
							inserted.push({id:val.equipment[0].ns1DatEquipmentId,name:val.equipment[0].ns1Description});
						}else if (data.sonraki == 'sasiSelect') {
							inserted.push({id:val.equipment[1].ns1DatEquipmentId,name:val.equipment[1].ns1Description});
						}else if (data.sonraki == 'sanzimanSelect') {
							inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
						}
					}
				}
			}

		});
	} else if (data.degisen == 'modelSelect') {
		$.each(allData.result, function(key,val) {
			var i = 0;
			if (val.ns1BaseModel == data.secili) {
				if (inserted === undefined || inserted.length == 0) {
					if (data.sonraki == 'altModelSelect') {
						inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
					}
					$.each($val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 1) {
							if (data.sonraki == 'engineSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 2) {
							if (data.sonraki == 'sasiSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 11) {
							if (data.sonraki == 'sanzimanSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 3) {
							if (data.sonraki == 'aksSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 10) {
							if (data.sonraki == 'dizaynSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 4) {
							if (data.sonraki == 'tahrikSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}
					});
				}else{
					$.each(inserted, function(key,val2) {
						if (data.sonraki == 'altModelSelect') {
							if (val2.id == val.ns1SubModel) {
								i++;
							}
						}else if (data.sonraki == 'engineSelect') {
							if (val2.id == val.equipment[0].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sasiSelect') {
							if (val2.id == val.equipment[1].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sanzimanSelect') {
							if (val2.id == val.equipment[2].ns1DatEquipmentId) {
								i++;
							}
						}
					});
					if (i == 0) {
						if (data.sonraki == 'altModelSelect') {
							inserted.push({id:val.ns1SubModel,name:val.ns1SubModelName});
						}else if (data.sonraki == 'engineSelect') {
							inserted.push({id:val.equipment[0].ns1DatEquipmentId,name:val.equipment[0].ns1Description});
						}else if (data.sonraki == 'sasiSelect') {
							inserted.push({id:val.equipment[1].ns1DatEquipmentId,name:val.equipment[1].ns1Description});
						}else if (data.sonraki == 'sanzimanSelect') {
							inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
						}
					}
				}
			}

		});
	} else if (data.degisen == 'altModelSelect') {
		$.each(allData.result, function(key,val) {
			var i = 0;
			if (val.ns1SubModel == data.secili) {
				if (inserted === undefined || inserted.length == 0) {
					$.each($val.equipment,function(key5,val5) {
						if (val5.ns1EquipmentClass == 2) {
							if (data.sonraki == 'sasiSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 11) {
							if (data.sonraki == 'sanzimanSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 3) {
							if (data.sonraki == 'aksSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 10) {
							if (data.sonraki == 'dizaynSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}else if (val5.ns1EquipmentClass == 4) {
							if (data.sonraki == 'tahrikSelect') {
								inserted.push({id:val5.ns1DatEquipmentId,name:val5.ns1Description});
							}
						}
					});
				}else{
					$.each(inserted, function(key,val2) {
						if (data.sonraki == 'engineSelect') {
							if (val2.id == val.equipment[0].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sasiSelect') {
							if (val2.id == val.equipment[1].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sanzimanSelect') {
							if (val2.id == val.equipment[2].ns1DatEquipmentId) {
								i++;
							}
						}
					});
					if (i == 0) {
						if (data.sonraki == 'engineSelect') {
							inserted.push({id:val.equipment[0].ns1DatEquipmentId,name:val.equipment[0].ns1Description});
						}else if (data.sonraki == 'sasiSelect') {
							inserted.push({id:val.equipment[1].ns1DatEquipmentId,name:val.equipment[1].ns1Description});
						}else if (data.sonraki == 'sanzimanSelect') {
							inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
						}
					}
				}
			}

		});
	} else if (data.degisen == 'engineSelect') {
		$.each(allData.result, function(key,val) {
			var i = 0;
			if (val.equipment[0].ns1DatEquipmentId == data.secili) {
				if (inserted === undefined || inserted.length == 0) {
					if (data.sonraki == 'sasiSelect') {
						inserted.push({id:val.equipment[1].ns1DatEquipmentId,name:val.equipment[1].ns1Description});
					}else if (data.sonraki == 'sanzimanSelect') {
						inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
					}
				}else{
					$.each(inserted, function(key,val2) {
						if (data.sonraki == 'sasiSelect') {
							if (val2.id == val.equipment[1].ns1DatEquipmentId) {
								i++;
							}
						}else if (data.sonraki == 'sanzimanSelect') {
							if (val2.id == val.equipment[2].ns1DatEquipmentId) {
								i++;
							}
						}
					});
					if (i == 0) {
						if (data.sonraki == 'sasiSelect') {
							inserted.push({id:val.equipment[1].ns1DatEquipmentId,name:val.equipment[1].ns1Description});
						}else if (data.sonraki == 'sanzimanSelect') {
							inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
						}
					}
				}
			}

		});
	} else if (data.degisen == 'sasiSelect') {
		$.each(allData.result, function(key,val) {
			var i = 0;
			if (val.equipment[1].ns1DatEquipmentId == data.secili) {
				if (inserted === undefined || inserted.length == 0) {
					if (data.sonraki == 'sanzimanSelect') {
						inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
					}
				}else{
					$.each(inserted, function(key,val2) {
						if (data.sonraki == 'sanzimanSelect') {
							if (val2.id == val.equipment[2].ns1DatEquipmentId) {
								i++;
							}
						}
					});
					if (i == 0) {
						if (data.sonraki == 'sanzimanSelect') {
							inserted.push({id:val.equipment[2].ns1DatEquipmentId,name:val.equipment[2].ns1Description});
						}
					}
				}
			}

		});
	}


	$.each(inserted, function(key,val) {
		insertedSelect += 	'<option value="'+val.id+'">'+val.name+'</option>';
	});



	$(this).next('select').html(insertedSelect);

	$('.sasiSearchSelects').attr('disabled','disabled');
	$(this).removeAttr('disabled');
	$(this).next('select').removeAttr('disabled');
	$(this).prevAll('select').removeAttr('disabled');
});