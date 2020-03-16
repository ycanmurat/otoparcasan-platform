var site_url = 'https://otoparcasan.kodakil.com/';
$( document ).ready(function() {
	//Araç Tipi
	$('#carType').on('change',function() {
		carType();
	});

	//Araç Markası
	$('#carBrands').on('change',function() {
		carBrands();
	});

	//Araç Modeli
	$('#carModels').on('change',function() {
		carModels();
	});

	$(document).on('change', '.getConst',function() {
		var data 		= {};
		data.type 		= $('#carType').val();
		data.brand 		= $('#carBrands').val();
		data.model 		= $('#carModels').val();
		data.subModel	= $('#carSubModels').val();
		data.body		= $('#car_body').val();
		data.engine		= $('#car_engine').val();
		data.gear		= $('#car_gear').val();
		data.equipment 	= $('#car_equipment').val();
		//console.log(data);


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

});

//Araç Tipi
function carType() {
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
								datTxt += '<option value="'+val.key+'">'+val.name+'</option>';
							}	
						}
					});

					$('#carBrands').html(datTxt);
					$('#carBrands').removeAttr('disabled');

					$('#carModels').attr('disabled','');
					$('#carSubModels').attr('disabled','');
				}
			},
			error:function(){
				$('.carAlt').attr('disabled','');
			}
		});
	}else{
		$('.carAlt').attr('disabled','');
		$('.searchLoading').fadeOut();
	}
}

//Araç Modeli
function carModels() {
	var model 	= $('#carModels').val();
	var type 	= $('#carType').val();
	var brand 	= $('#carBrands').val();
	$.ajax({url: site_url+'Service/getSubModels/'+type+'/'+brand+'/'+model,
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
			}
		},
		error:function(){
			$('#carSubModels').attr('disabled','');
			$('#carMotors').attr('disabled','');
		}
	});
}

//Araç Markası
function carBrands() {
	var brand = $('#carBrands').val();
	var type = $('#carType').val();
	if (brand != 0) {
		$.ajax({url: site_url+'Service/getModels/'+type+'/'+brand,
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
						var count = 0;
						for (var k in val) {
						    if (val.hasOwnProperty(k)) {
						       ++count;
						    }
						}
						
						if (count == 2) {
							datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
						}else{
							if (val.status == 1) {
								datTxt += '<option value="'+val.key+'">'+val.name+'</option>';
							}	
						}
					});

					$('#carModels').html(datTxt);
					$('#carModels').removeAttr('disabled');
					$('#carSubModels').attr('disabled','');
					if (result.length == 1) {
						carModels();
					}else{
					}			
				}
			},
			error:function(){
				$('#carModels').attr('disabled','');
				$('#carSubModels').attr('disabled','');
				$('#carMotors').attr('disabled','');
			}
		});
	}else{
		$('#carModels').attr('disabled','');
		$('#carSubModels').attr('disabled','');
		$('#carMotors').attr('disabled','');
	}
}