var site_url = 'https://otoparcasan.com/';
var domain_name = 'otoparcasan.com';
$( document ).ready(function() {
    function formatIcon (car) {
        if (!car.id) {
            return car.text;
        }

        if (car.element.dataset.img != site_url && car.element.dataset.img != undefined) {
            var $car = $('<span><img style="float: left;margin-right: 10px;" width="25" src="'+car.element.dataset.img+'" class="img-flag" /> ' + car.text + '</span>');
            return $car;
        }else{
            return car.text;
        }
    };

    if (document.location.pathname == '/') {
        $("#carType").select2({
            templateResult: formatIcon,
            width: '100%'
        });
        $("#carBrands").select2({
            width: '100%',
            templateResult: formatIcon
        });
        $("#carModels").select2({
            width: '100%'
        });
        $("#carSubModels").select2({
            width: '100%'
        });
    }else if (document.location.pathname == '/Admin/Aracagaci'){
        console.log('select2 yapılmadı');
    }else if (document.location.pathname == '/Admin/Aracagaci/yagagaci'){
        console.log('select2 yapılmadı');
    }else{
        $("#carType").select2({
            templateResult: formatIcon
            ,width: '100%'
            ,dropdownParent: $("#carTree")
        });
        $("#carBrands").select2({
            templateResult: formatIcon
            ,width: '100%'
            ,dropdownParent: $("#carTree")
        });
        $("#carModels").select2({
            width: '100%'
            ,dropdownParent: $("#carTree")
        });
        $("#carSubModels").select2({
            width: '100%'
            ,dropdownParent: $("#carTree")
        });
    }

    //Araç Tipi
    $('#carType').on('change',function() {
        if ($(this).val() != 0) {
            carType();
        }else{
            cartypeErrors();
        }
    });

    //Araç Markası
    $('#carBrands').on('change',function() {
        if ($(this).val() != 0) {
            carBrands();
        }else{
            $('#carModels').attr('disabled','');
            $('#carModels').val('0');
            $('#carModels').trigger('change');

            $('#carSubModels').attr('disabled','');
            $('#carSubModels').val('0');
            $('#carSubModels').trigger('change');

            $('.extraArea').fadeOut();
        }
    });

    //Araç Modeli
    $('#carModels').on('change',function() {
        if ($(this).val() != 0) {
            carModels();
        }else{
            $('#carSubModels').attr('disabled','');
            $('#carSubModels').val('0');
            $('#carSubModels').trigger('change');

            $('.extraArea').fadeOut();
        }
    });

    //Araç Alt Model
    $('#carSubModels').on('change',function() {
        if ($(this).val() != 0) {
            $('[aria-labelledby="select2-carSubModels-container"]').removeClass('border-danger');
            CarDetails();
        }
        $('.extraArea').fadeOut();
    });

    //Trafiğe Çıkış
    $(document).on('change', '.getConst',function() {
        getConst();
    });

    $(document).on('change', '#car_consTime',function() {
        $('#car_consTime > option[value=0]').remove();
    });

    //alt seçenekler
    $(document).on('change', '.selectes',function() {
        //$('.searchLoading').fadeIn(500);
        var data = {};
        data.type       = $('#carType').val();
        data.brand      = $('#carBrands').val();
        data.model      = $('#carModels').val();
        data.subModel   = $('#carSubModels').val();
        //data.year     = $('#year').val();
        data.selected   = $(this).val();
        data.name       = $(this).attr('id');
        $('> option[value=0]',this).remove();

        if (data.name == 'car_gear') {
            data.engine_selected = $('#car_engine').val();
        }else if (data.name == 'car_body') {
            data.engine_selected = $('#car_engine').val();
            data.gear_selected = $('#car_gear').val();
        }else if (data.name == 'car_equipment') {
            data.engine_selected = $('#car_engine').val();
            data.gear_selected = $('#car_gear').val();
            data.body_selected = $('#car_body').val();
        }else if (data.name == 'car_wheel') {
            data.engine_selected = $('#car_engine').val();
            data.gear_selected = $('#car_gear').val();
            data.body_selected = $('#car_body').val();
            if (typeof($('#car_equipment').val()) != "undefined" && $('#car_equipment').val() !== null) {
                data.equipment_selected = $('#car_equipment').val();
            }
        }

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
                            }else{
                                $("#car_gear").select2('open');
                            }
                            $('[aria-labelledby="select2-car_engine-container"]').removeClass('border-danger');

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
                            }else{
                                $("#car_body").select2('open');
                            }
                            $('[aria-labelledby="select2-car_gear-container"]').removeClass('border-danger');
                        }else if (data.name == 'car_body') {
                            if(typeof(result.equipment) != "undefined" && result.equipment !== null) {
                                if (result.equipment.length == 1) {
                                    $.each( result.equipment, function( key, val ) {
                                        datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                    });
                                }else{
                                    datTxt += '<option value="0"> - Kasa - </option>';
                                    $.each( result.equipment, function( key, val ) {
                                        datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                    });
                                }
                                
                                $('#car_equipment').html(datTxt);
                                $('#car_equipment').removeAttr('disabled');
                                $('#car_consTime').attr('disabled','');

                                if (result.equipment.length == 1) {
                                    $('#car_equipment').trigger('change');
                                }else{
                                    $("#car_equipment").select2('open');
                                }

                                $('[aria-labelledby="select2-car_body-container"]').removeClass('border-danger');
                            }else{
                                if (result.wheel.length == 1) {
                                    $.each( result.wheel, function( key, val ) {
                                        datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                    });
                                }else{
                                    datTxt += '<option value="0"> - Kasa - </option>';
                                    $.each( result.wheel, function( key, val ) {
                                        datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                    });
                                }
                                
                                $('#car_wheel').html(datTxt);
                                $('#car_wheel').removeAttr('disabled');

                                if (result.wheel.length == 1) {
                                    $('#car_wheel').trigger('change');
                                }else{
                                    $("#car_wheel").select2('open');
                                }

                                $('[aria-labelledby="select2-car_body-container"]').removeClass('border-danger');
                            }
                        }else if (data.name == 'car_equipment') {
                            
                            if (result.wheel.length == 1) {
                                $.each( result.wheel, function( key, val ) {
                                    datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                });
                            }else{
                                datTxt += '<option value="0"> - Kasa - </option>';
                                $.each( result.wheel, function( key, val ) {
                                    datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                });
                            }
                            
                            $('#car_wheel').html(datTxt);
                            $('#car_wheel').removeAttr('disabled');

                            if (result.wheel.length == 1) {
                                $('#car_wheel').trigger('change');
                            }else{
                                $("#car_wheel").select2('open');
                            }
                            $('[aria-labelledby="select2-car_equipment-container"]').removeClass('border-danger');
                        }else if (data.name == 'car_wheel') {
                            
                            if (result.typeOfDrive.length == 1) {
                                $.each( result.typeOfDrive, function( key, val ) {
                                    datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                });
                            }else{
                                datTxt += '<option value="0"> - Kasa - </option>';
                                $.each( result.typeOfDrive, function( key, val ) {
                                    datTxt += '<option value="'+val.key+'">'+val.value+'</option>'
                                });
                            }
                            
                            $('#car_typeOfDrive').html(datTxt);
                            $('#car_typeOfDrive').removeAttr('disabled');

                            if (result.typeOfDrive.length == 1) {
                                $('#car_typeOfDrive').trigger('change');
                            }else{
                                $("#car_typeOfDrive").select2('open');
                            }
                            $('[aria-labelledby="select2-car_wheel-container"]').removeClass('border-danger');
                        }else{
                            console.log('carSelectError');
                        }
                    }
                },
                error:function(){
                    console.log('carSelectError 404');
                }
            });
        }
    });
});

//Trafiğe Çıkış
function getConst() {
    //setTimeout(function() {
        var data        = {};
        data.type       = $('#carType').val();
        data.brand      = $('#carBrands').val();
        data.model      = $('#carModels').val();
        data.subModel   = $('#carSubModels').val();

        data.body       = $('#car_body').val();
        data.engine     = $('#car_engine').val();
        data.gear       = $('#car_gear').val();
        data.equipment  = $('#car_equipment').val();
        data.wheel      = $('#car_wheel').val();
        data.typeofdrive= $('#car_typeOfDrive').val();
        $('.getConst > option[value=0]').remove();

        $(data).each(function(key,val) {
            if (val == 0) {
                return false;
            }
        });

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

                if (result.ConsTime.length != 1) {
                    $('#car_consTime').select2('open');
                }else{
                    datTxt = '';
                }

            },error:function(result) {

            }
        });
    //},1000);
}
//araç tipi seçimi hatalıysa
function cartypeErrors() {
        $('#carBrands').attr('disabled','');
        $('#carBrands').val('0');
        $('#carBrands').trigger('change');

        $('#carModels').attr('disabled','');
        $('#carModels').val('0');
        $('#carModels').trigger('change');

        $('#carSubModels').attr('disabled','');
        $('#carSubModels').val('0');
        $('#carSubModels').trigger('change');

        $('.extraArea').fadeOut();
}

//Araç Tipi DEĞİŞİNCE
function carType() {
    var type = $('#carType').val();
    $.ajax({url: site_url+'Service/getBrands/'+type,
            method:'POST',
            dataType : 'JSON',
        success: function(result){
            if (result == 'error') {
                cartypeErrors();
            }else{
                if (result.length != 1) {
                    var datTxt = '<option value="0">- Marka -</option>';
                }else{
                    var datTxt = '';
                }

                populerTxt  = '';
                normalTxt   = '';
                
                $.each( result, function( key, val ) {
                    if (val.status == 1) {
                        if (val.popular == 1) {
                            populerTxt += '<option data-img="'+site_url+val.icon+'" value="'+val.key+'">'+val.value+'</option>';
                        }else{
                            normalTxt  += '<option data-img="'+site_url+val.icon+'" value="'+val.key+'">'+val.value+'</option>';
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
                cartypeErrors();

                $('#carBrands').html(datTxt);
                $('#carBrands').removeAttr('disabled');
                $('[aria-labelledby="select2-carType-container"]').removeClass('border-danger');
                $('#carBrands').select2('open');
            }
        },
        error:function(){
            cartypeErrors();
        }
    });
}

var allProduct = '';

//araç marka değişince
function carBrands() {
    var brand = $('#carBrands').val();
    var type = $('#carType').val();

    $.ajax({url: site_url+'Service/getModels/'+type+'/'+brand,
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
                    if (val.status == 1) {
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
                    }
                });

                $('#carModels').html(datTxt);
                $('#carModels').removeAttr('disabled');

                $('#carSubModels').attr('disabled','');
                $('#carSubModels').val('0');
                $('#carSubModels').trigger('change');

                $('.extraArea').fadeOut();

                $('[aria-labelledby="select2-carBrands-container"]').removeClass('border-danger');
                if (result.length == 1) {
                    carModels();
                }else{
                    $('#carModels').select2('open');
                }           
            }
        },
        error:function(){
            $('#carModels').attr('disabled','');
            $('#carSubModels').attr('disabled','');
            $('#carMotors').attr('disabled','');
            //$('.searchLoading').fadeOut(500);
        }
    });
}

//Araç Modeli
function carModels() {
    //$('.searchLoading').fadeIn(500);
    var model   = $('#carModels').val();
    var type    = $('#carType').val();
    var brand   = $('#carBrands').val();
    //var year  = $('#year').val();
    $.ajax({url: site_url+'Service/getSubModels/'+type+'/'+brand+'/'+model,//+'/'+year,
            method:'POST',
            dataType : 'JSON',
        success: function(result){
            if (result == 'error') {
                $('#carSubModels').attr('disabled','');
            }else{

                if (result.length != 1) {
                    var datTxt = '<option value="0">- Alt Tip -</option>';
                }else{
                    var datTxt = '';
                }

                var onceki = '';
                $.each( result, function( key, val ) {
                    if (val.status == 1) {
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
                    }
                });

                $('#carSubModels').html(datTxt);
                $('#carSubModels').removeAttr('disabled');
                $('[aria-labelledby="select2-carModels-container"]').removeClass('border-danger');

                $('.extraArea').fadeOut();
                if (result.length == 1) {
                    CarDetails();
                }else{
                    $('#carSubModels').select2('open');
                }
            }
        },
        error:function(){
            $('#carSubModels').attr('disabled','');
            $('#carMotors').attr('disabled','');
            //$('.searchLoading').fadeOut(500);
        }
    });
}

//Araç Detay ilk 4 seçim sonrası ara butonuna basınca
function CarDetails() {
    var type        = $('#carType').val();
    var brand       = $('#carBrands').val();
    var model       = $('#carModels').val();
    //var year      = $('#year').val();
    var subModel    = $('#carSubModels').val();

    if (type == 0) {
        $('[aria-labelledby="select2-carType-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carBrands-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carModels-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carSubModels-container"]').addClass('border-danger');
    }else if (brand == 0) {
        $('[aria-labelledby="select2-carType-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carBrands-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carModels-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carSubModels-container"]').addClass('border-danger');
    }else if (model == 0) {
        $('[aria-labelledby="select2-carType-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carBrands-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carModels-container"]').addClass('border-danger');
        $('[aria-labelledby="select2-carSubModels-container"]').addClass('border-danger');
    }else if (subModel == 0) {
        $('[aria-labelledby="select2-carType-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carBrands-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carModels-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carSubModels-container"]').addClass('border-danger');
    }else{
        loader();
        $('[aria-labelledby="select2-carType-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carBrands-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carModels-container"]').removeClass('border-danger');
        $('[aria-labelledby="select2-carSubModels-container"]').removeClass('border-danger');
        $.ajax({url: site_url+'Service/getOptions/'+type+'/'+brand+'/'+model+'/'+subModel,//+'/'+year,
                method:'POST'
               ,dataType : 'JSON',
            success: function(result){
                if (result == 'error') {
                    console.log('Araç Hatalı');
                    $.unblockUI();
                }else{
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
                        }else if (key == 'typeOfDrive') {
                            var baslik = 'Tahrik Şekli';
                        }else if (key == 'wheel') {
                            var baslik = 'Aks Mesafesi';
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
                        }

                        carDetail += '</select>';
                    });
                    $('.carSelectDetail').html(carDetail);
                    var sonuncu = $('.carSelectDetail > select').last();
                    $(sonuncu).removeClass('selectes').addClass('getConst');


                    var consTimeTxt = '<select id="car_consTime" class="custom-select mt-2" style="margin-bottom:15px;" disabled>\
                                            <option value="0"> - Trafiğe Çıkış - </option>\
                                        </select>';
                    $('.carSelectDetail').append(consTimeTxt);

                    if (document.location.pathname == '/') {
                        $("#car_engine").select2();
                        $("#car_gear").select2();
                        $("#car_body").select2();
                        $("#car_equipment").select2();
                        $("#car_typeOfDrive").select2();
                        $("#car_wheel").select2();
                        $("#car_consTime").select2();
                    }else{
                        $("#car_engine").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_gear").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_body").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_equipment").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_typeOfDrive").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_wheel").select2({width: '100%', dropdownParent: $("#carTree")});
                        $("#car_consTime").select2({width: '100%', dropdownParent: $("#carTree")});
                    }
                    
                    $('.extraArea').fadeIn();
                    $.unblockUI();
                    if (result.engine.length != 1) {
                        $("#car_engine").select2('open');
                        i++;
                    }else if (result.gear.length != 1) {
                        $("#car_gear").select2('open');
                        i++;
                    }else if (result.body.length != 1) {
                        $("#car_body").select2('open');
                        i++;
                    }else if (result.equipment != undefined) {
                        if (result.equipment.length != 1) {
                            $("#car_equipment").select2('open');
                            i++;
                        }
                    }else if (result.wheel != undefined) {
                        if (result.wheel.length != 1) {
                            $("#car_wheel").select2('open');
                            i++;
                        }
                    }else if (result.typeOfDrive != undefined) {
                        if (result.typeOfDrive.length != 1) {
                            $("#car_typeOfDrive").select2('open');
                            i++;
                        }
                    }

                    if (i == 0) {
                        getConst();
                    }
                }
            },
            error:function(result){
                $.unblockUI();
            }
        });
    }
}


function SearchPart(url = '') {
    //carId
    var i = 0;

    $.each($('.selectes'), function(key,val) {
        if ($(val).val() == 0) {
            i++;
            $('[aria-labelledby="select2-'+$(val).attr('id')+'-container"]').addClass('border-danger');
        }else{
            $('[aria-labelledby="select2-'+$(val).attr('id')+'-container"]').removeClass('border-danger');
        }
    });

    if ($('#car_body').val() == 0) {
        i++;
        $('[aria-labelledby="select2-car_body-container"]').addClass('border-danger');
    }else{
        $('[aria-labelledby="select2-car_body-container"]').removeClass('border-danger');
    }

    if ($('#car_consTime').val() == 0) {
        i++;
        $('[aria-labelledby="select2-car_consTime-container"]').addClass('border-danger');
    }else{
        $('[aria-labelledby="select2-car_consTime-container"]').removeClass('border-danger');
    }

    if (i == 0) {
        var data = {};
        data.carId = $('#carId').attr('value');
        data.consTime = $('#car_consTime').val();
        $.cookie("selectedCar", JSON.stringify(data), {
            expires : 1,
            path    : '/',
            domain  : domain_name,
            secure  : true
        });
        if (url == '') {
            window.location.href = site_url+"yedek-parcalar/";
        }else{
            window.location.href = url;
        }
    }
}


function addGarrage() {

    var i = 0;

    $.each($('.selectes'), function(key,val) {
        if ($(val).val() == 0) {
            i++;
            $(val).addClass('border-danger');
        }else{
            $(val).removeClass('border-danger');
        }
    });

    if ($('#getConst').val() == 0) {
        i++;
        $('#getConst').addClass('border-danger');
    }else{
        $('#getConst').removeClass('border-danger');
    }

    if ($('#car_consTime').val() == 0) {
        i++;
        $('#car_consTime').addClass('border-danger');
    }else{
        $('#car_consTime').removeClass('border-danger');
    }

    if (i == 0) {
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
}

function agacDoldur(cartype,brand,model,subModel) {
    $('#carType').val(cartype);
    $('#carType').trigger('change');
    setTimeout(function() {
        $('#carBrands').select2('close');
        $('#carBrands').val(brand);
        $('#carBrands').trigger('change');
         setTimeout(function() {
            $('#carModels').select2('close');
            $('#carModels').val(model);
            $('#carModels').trigger('change');
            setTimeout(function() {
                $('#carSubModels').select2('close');
                $('#carSubModels').val(subModel);
                $('#carSubModels').trigger('change');
                if (document.location.pathname == '/') {
                    return true;
                }else{
                    $('#carTree').modal();
                    return true;
                }
            },1000);
        },1000);
    },1000);
}

var allData = {};

function sasiSearch() {
    vin = $('#chasisNo').val().trim();
    loader();
    
    if (vin.length == 17) {
        $.ajax({
                url: site_url+'Service/getVinSearch/'+vin,
                method:'POST',
                dataType : 'JSON',
                success:function(result){
                    if (result.status == 'true') {
                        result = result.data;
                    }else if (result.status == 'fault') {
                        if (result.faultCode == 'Authentication') {
                            $.unblockUI();
                            Swal.fire({ type: 'warning',
                                        title: 'Uyarı !', 
                                        html: '<p style="text-align:center;">Girmiş olduğunuz şase numarası bilgi veritabanımızda bulunamamıştır. Araç bilgilerine göre arama adımı ile aracınızı bulabilirsiniz.</p>',
                                        animation: false,
                                        confirmButtonText: 'Tamam',
                                        customClass: 'animated tada'});
                            return 1;
                        }else if(result.faultCode == 'Ecode'){
                            if ($(window).width() <= 575) {
                                $('#mobileSelectBtn').trigger('click');
                            }
                            if (agacDoldur(result.data.ns2VehicleType,result.data.ns2Manufacturer,result.data.ns2BaseModel,result.data.ns2SubModel)) {
                                $.unblockUI();
                                Swal.fire({ type: 'warning',
                                    title: 'Uyarı !', 
                                    html: '<p style="text-align:center;">Aradığınız Şase İle İlgili Net Sonuca Ulaşamadık Ulaştığımız Bilgileri Araç Ağacına Ekledik Araç Seçiminize Oradan Devam Edebilirsiniz.</p>',
                                    animation: false,
                                    confirmButtonText: 'Tamam',
                                    customClass: 'animated tada'
                                });
                            }
                            return 1;
                        }else{
                           $.unblockUI();
                            Swal.fire({type: 'error', title: 'Hata !'
                                , html: '<p style="text-align:center;">Girdiğiniz Şase Numarası Hatalı Veya yanlış.</p>'
                                ,confirmButtonText: 'Tamam'
                                , animation: false, customClass: 'animated tada'});
                
                        }
                    }
                    allData = result;
                    var allSelect   = '';
                    var allBaslik   = '';
                    var nameText    = '';
                    $('.sasiSearchSasiNumber').text(vin.toUpperCase());

                    if (result.marka.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Marka</div>';
                        allSelect += '<select class="form-control custom-select sasiselect sasiSearchSelects" id="markaSelect" size="15">';
                        if(window.innerWidth <= 800) {
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
                        if(window.innerWidth <= 800) {
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
                        allBaslik += '<div class="sasiSelectBaslik">Alt Tip</div>';
                        allSelect += '<select data-text="Alt Tip" class="form-control custom-select sasiselect sasiSearchSelects" id="altModelSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Alt Tip</option>';
                        }
                            $.each(result.altModel, function(key,val) {
                                allSelect += '<option value="'+val.id+'">'+val.name+'</option>';
                            });
                        allSelect += '</select>';
                    
                    }else{
                        nameText += '<p>Alt Tip : '+result.altModel[0].name+'</p>';
                    }

                    if (result.motor.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Motor Tipi</div>';
                        allSelect += '<select data-text="Motor Tipi" class="form-control custom-select sasiselect sasiSearchSelects" id="engineSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Motor Tipi</option>';
                        }
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled>  Motor Tipi</option>';
                        }
                            $.each(result.motor, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else{
                        nameText += '<p>Motor : '+result.motor[0].Description+'</p>';
                    }

                    if (result.govde.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Gövde</div>';
                        allSelect += '<select data-text="Gövde" class="custom-select sasiselect sasiSearchSelects" id="sasiSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Gövde</option>';
                        }
                            $.each(result.govde, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else{
                        nameText += '<p>Gövde : '+result.govde[0].Description+'</p>';
                    }

                    if (result.sanziman.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Şanzıman Tipi</div>';
                        allSelect += '<select data-text="Şanzıman" class="custom-select sasiselect sasiSearchSelects" id="sanzimanSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Şanzıman Tipi</option>';
                        }
                            $.each(result.sanziman, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else{
                        nameText += '<p>'+result.sanziman[0].Description+'</p>';
                    }

                    if (result.aks.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Aks Mesafesi</div>';
                        allSelect += '<select data-text="Aks Mesafesi" class="custom-select sasiselect sasiSearchSelects" id="aksSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Aks Mesafesi</option>';
                        }
                            $.each(result.aks, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else if (result.aks.length == 1) {
                        nameText += '<p>'+result.aks[0].Description+'</p>';
                    }

                    if (result.dizayn.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Dizayn</div>';
                        allSelect += '<select data-text="Dizayn" class="custom-select sasiselect sasiSearchSelects" id="dizaynSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Dizayn</option>';
                        }
                            $.each(result.dizayn, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else if (result.dizayn.length == 1) {
                        nameText += '<p> '+result.dizayn[0].Description+'</p>';
                    }

                    if (result.tahrik.length > 1) {
                        allBaslik += '<div class="sasiSelectBaslik">Tahrik Şekli</div>';
                        allSelect += '<select data-text="Tahrik Şekli" class="custom-select sasiselect sasiSearchSelects" id="tahrikSelect" size="15">';
                        if(window.innerWidth <= 800) {
                            allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Tahrik Şekli</option>';
                        }
                            $.each(result.tahrik, function(key,val) {
                                allSelect += '<option value="'+val.DatEquipmentId+'">'+val.Description+'</option>';
                            });
                        allSelect += '</select>';
                    }else if (result.tahrik.length == 1) {
                        nameText += '<p>'+result.tahrik[0].Description+'</p>';
                    }

                  allBaslik += '<div class="sasiSelectBaslik">Trafiğe Çıkış Tarihi</div>';
                    allSelect += '<select data-text="Trafiğe Çıkış Tarihi" class="form-control custom-select sasiselect sasiSearchSelects" id="consTime" size="15">';
                    if(window.innerWidth <= 800) {
                        allSelect += '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Trafiğe Çıkış Tarihi</option>';
                    }
                    allSelect += '</select>';

                    $('.allBaslik').html(allBaslik);
                    $('.allSelect').html(allSelect);
                    $('.sasiSecililer').html(nameText);
                    if (result.image == false) {
                        $('#carImageSasi').attr('src',site_url+'assets/Front/images/defaultcar.png');
                    }else{
                        $('#carImageSasi').attr('src',site_url+result.image);
                    }
                    $('.sasiSearchSelects:not(:first)').attr('disabled','');


                    $('#sasiModal').modal();

                    $.unblockUI();

                    if ($('.sasiSearchSelects').length == 1) {
                        getConstTimeSasi(0);
                    }
                    setTimeout(function() {
                        $('.allSelect').scrollTo(0);
                    },500);
                    //console.log(result);
                },error:function(data) {
                    $.unblockUI();
                    Swal.fire({type: 'error', title: 'Hata !' ,confirmButtonText: 'Tamam', html: '<p style="text-align:center;">Girilen Şase Numarası ile ilgili bir sonuca ulaşamadık. Şase numaranızı kontrol edebilir veya araç ağacından arama yapmayı deneyebilirsiniz.</p>', animation: false, customClass: 'animated tada'});
                }
        });
    }else{
        $.unblockUI();
        Swal.fire({type: 'error', title: 'Hata !',confirmButtonText: 'Tamam', html: '<p style="text-align:center;">Girilen Şase Numarası 17 hane olmak zorundadır.</p>', animation: false, customClass: 'animated tada'});
    }
}

$(document).on('change','[name="garaggeCars"]',function() {
    loader();
    garaggeData = {};
    garaggeData.carId = $(this).val();
    garaggeData.consTime = $('> option:selected',this).attr('cons_time');
    $.cookie("selectedCar", JSON.stringify(garaggeData), {
        expires : 1,
        path    : '/',
        domain  : domain_name,
        secure  : true
    });
    //setCookie('selectedCar', JSON.stringify(garaggeData), 1);
    location.reload();
});

$(document).on('change','.sasiSearchSelects',function() {

    if ($('.allSelect select:not(:last):last').val() == $(this).val()) {
        getConstTimeSasi();
        return 1;
    }

    var data = {};
    data.degisen = $(this).attr('id');
    data.secili = $(this).val();
    data.sonraki = $(this).next('select').attr('id');
    data.insertedSelect = '';
    data.inserted = [];
    data.prevAll = [];

    if (data.sonraki == 'markaSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Marka';
    }else if (data.sonraki == 'modelSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Model';
    }else if (data.sonraki == 'altModelSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Alt Tip';
    }else if (data.sonraki == 'engineSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Motor';
    }else if (data.sonraki == 'sasiSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Gövde';
    }else if (data.sonraki == 'sanzimanSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Şanzıman';
    }else if (data.sonraki == 'aksSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Aks Mesafesi';
    }else if (data.sonraki == 'dizaynSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Dizayn Türü';
    }else if (data.sonraki == 'tahrikSelect') {
        data.sonrakiName = '&nbsp;&nbsp;&nbsp;Tahrik Şekli';
    }

    $.each($(this).prevAll('select'), function(key,val) {
        var id = $(val).attr('id');
        var value = $(val).val();
        data.prevAll.push({id:id,val:value});
    });


    if (data.prevAll == false || data.prevAll.length == 0) {
        if (data.degisen == 'markaSelect') {
            $.each(allData.result, function(key,val) {
                if (val.Manufacturer == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'modelSelect') { // Bir sonraki selectin içinde ne olduğuna göre dolduruyoruz içerisini 
                        if (data.inserted  == false || data.inserted.length == 0) { //doldurulacak dizi boşsa ilk veriyi içine at
                            data.inserted.push({id:val.BaseModel,name:val.BaseModelName});
                        }else{ // doldurulacak verinin içerisinde bir veri varsa tekrara düşmemek için sorgulamalar
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.BaseModel) {//kaydedilecek veri içerde var mı yok mu kontrolü
                                    i++;
                                }
                            });
                            if (i == 0) { // yoksa i = 0 olarak geliyo veriyi yanına ekliyorum
                                data.inserted.push({id:val.BaseModel,name:val.BaseModelName});
                            }
                        }
                    }else if (data.sonraki == 'altModelSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            data.inserted.push({id:val.SubModel,name:val.SubModelName});
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.SubModel) {
                                    i++;
                                }
                            });
                            if (i == 0) {
                                data.inserted.push({id:val.SubModel,name:val.SubModelName});
                            }
                        }
                    }else if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }
                }
            }); 
        }else if (data.degisen == 'modelSelect') {
            $.each(allData.result, function(key,val) {
                if (val.BaseModel == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'altModelSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            data.inserted.push({id:val.SubModel,name:val.SubModelName});
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.SubModel) {
                                    i++;
                                }
                            });
                            if (i == 0) {
                                data.inserted.push({id:val.SubModel,name:val.SubModelName});
                            }
                        }
                    }else if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }
                }
            }); 
        }else if (data.degisen == 'altModelSelect') {
            $.each(allData.result, function(key,val) {
                if (val.SubModel == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                    if (val55.EquipmentClass == 1) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'sasiSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'sanzimanSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                    if (val55.EquipmentClass == 2) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'sanzimanSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                    if (val55.EquipmentClass == 11) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                    if (val55.EquipmentClass == 3) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                    if (val55.EquipmentClass == 10) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                if (val.Manufacturer == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'modelSelect') { // Bir sonraki selectin içinde ne olduğuna göre dolduruyoruz içerisini 
                        if (data.inserted  == false || data.inserted.length == 0) { //doldurulacak dizi boşsa ilk veriyi içine at
                            data.inserted.push({id:val.BaseModel,name:val.BaseModelName});
                        }else{ // doldurulacak verinin içerisinde bir veri varsa tekrara düşmemek için sorgulamalar
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.BaseModel) {//kaydedilecek veri içerde var mı yok mu kontrolü
                                    i++;
                                }
                            });
                            if (i == 0) { // yoksa i = 0 olarak geliyo veriyi yanına ekliyorum
                                data.inserted.push({id:val.BaseModel,name:val.BaseModelName});
                            }
                        }
                    }else if (data.sonraki == 'altModelSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            data.inserted.push({id:val.SubModel,name:val.SubModelName});
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.SubModel) {
                                    i++;
                                }
                            });
                            if (i == 0) {
                                data.inserted.push({id:val.SubModel,name:val.SubModelName});
                            }
                        }
                    }else if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }
                });
                if (r) {
                    return true;
                }
                if (val.BaseModel == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'altModelSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            data.inserted.push({id:val.SubModel,name:val.SubModelName});
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                if (val2.id == val.SubModel) {
                                    i++;
                                }
                            });
                            if (i == 0) {
                                data.inserted.push({id:val.SubModel,name:val.SubModelName});
                            }
                        }
                    }else if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }
                });
                if (r) {
                    return true;
                }

                if (val.SubModel == data.secili) { //secilen variant tutuyosa işleme al
                    if (data.sonraki == 'engineSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 1) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sasiSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'sanzimanSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'aksSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'dizaynSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                    }
                                });
                            }
                        }
                    }else if (data.sonraki == 'tahrikSelect') {
                        if (data.inserted  == false || data.inserted.length == 0) {
                            $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                    data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                }
                            });
                        }else{
                            var i = 0;
                            $.each(data.inserted,function(key2,val2) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        if (val2.id == val5.DatEquipmentId) {
                                            i++;
                                        }
                                    }
                                });
                            });
                            if (i == 0) {
                                $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                    if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                        data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
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
                    if (val55.EquipmentClass == 1) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'sasiSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 2) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'sanzimanSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
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
                    if (val55.EquipmentClass == 2) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'sanzimanSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 11) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
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
                    if (val55.EquipmentClass == 11) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'aksSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 3) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
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
                    if (val55.EquipmentClass == 3) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'dizaynSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 10) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                            }
                                        });
                                    }
                                }
                            }else if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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
                        if (val77.val != val.Manufacturer) {
                            r = true;
                        }
                    }else if (val77.id == 'modelSelect') {
                        if (val77.val != val.BaseModel) {
                            r = true;
                        }
                    }else if (val77.id == 'altModelSelect') {
                        if (val77.val != val.SubModel) {
                            r = true;
                        }
                    }else if (val77.id == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val77.val != val5.DatEquipmentId) {
                                    r = true;
                                }
                            }
                        });
                    }else if (val77.id == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val77.val != val5.DatEquipmentId) {
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
                    if (val55.EquipmentClass == 10) {
                        if (val55.DatEquipmentId == data.secili) { //secilen variant tutuyosa işleme al
                            if (data.sonraki == 'tahrikSelect') {
                                if (data.inserted  == false || data.inserted.length == 0) {
                                    $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                        if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                            data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
                                        }
                                    });
                                }else{
                                    var i = 0;
                                    $.each(data.inserted,function(key2,val2) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                if (val2.id == val5.DatEquipmentId) {
                                                    i++;
                                                }
                                            }
                                        });
                                    });
                                    if (i == 0) {
                                        $.each(val.equipment,function(key5,val5) { //equipment leri döngü ile döndürüp doğru olanı seçmek için bütün equipment leri döndürüyorum
                                            if (val5.EquipmentClass == 4) { // motorun 1 e eşit olduğunu bildiğimden gelen motorları ayırt ediyorum
                                                data.inserted.push({id:val5.DatEquipmentId,name:val5.Description});
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

    if(window.innerWidth <= 800) {
        data.insertedSelect += '<option value="" default disabled selected>'+data.sonrakiName+'</option>';
    }
    
    if (data.inserted.length > 0) {
        $.each(data.inserted, function(key,val) {
            data.insertedSelect +=  '<option value="'+val.id+'">'+val.name+'</option>';
        });
        $(this).next('select').html(data.insertedSelect);
    }else{
        $(this).next('select').html('<option value="0">-</option>');
    }



    if ($(this).next('select').length>0) {
        $('.allSelect').scrollTo($(this).next('select'), 700);
    }

    $('.sasiSearchSelects').attr('disabled','disabled');
    $(this).removeAttr('disabled');
    $(this).next('select').removeAttr('disabled');
    $(this).prevAll('select').removeAttr('disabled');

    if (data.inserted.length <= 0) {
        $(this).next('select').val(0);
        $(this).next('select').trigger('change');
    }
});


function getConstTimeSasi(type = 1) {
    if (type == 0) {
        $('#consTime').attr('disabled','disabled');
        carId = allData.result[0].DatECode;
        console.log(allData.result);
        var times = '';
        $.ajax({url: site_url+'Service/getConsTime/'+carId,
            method:'POST',
            data: {},
            dataType:'JSON',
            success:function(result){
                $.each(result,function(key9999,val9999) {
                    //console.log(val9999);
                    times += '<option value="'+val9999.value+'">'+val9999.name+'</option>'
                });

                $('#consTime').removeAttr('disabled');
                
                $('#consTime').html(times);
                //
            },error:function(result) {

            }
        });
    }else{
        $('#consTime').attr('disabled','disabled');
        data = [];
        var ir = 0;
        $.each($('.sasiSearchSelects:not(:last)'),function(key,val) {
            if ($(this).val() == null) {
                $(this).attr('style','border:1px solid red;');
                ir++;
            }else{
                $(this).attr('style','border:1px solid #ced4da;');
                var val     = $(this).val();
                var name    = $(this).attr('id');
                data.push({name:name,val:val});
            }
        });

        if (ir == 0) {
            $.each(allData.result,function(key,val) {
                var i = 0;
                $.each(data,function(key2,val2) {
                    if (val2.name == 'markaSelect') {
                        if (val2.val != val.Manufacturer) {
                            i++;
                        }
                    }else if (val2.name == 'modelSelect') {
                        if (val2.val != val.BaseModel) {
                            i++;
                        }
                    }else if (val2.name == 'altModelSelect') {
                        if (val2.val != val.SubModel) {
                            i++;
                        }
                    }else if (val2.name == 'engineSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 1) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }else if (val2.name == 'sasiSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 2) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }else if (val2.name == 'sanzimanSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 11) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }else if (val2.name == 'aksSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 3) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }else if (val2.name == 'dizaynSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 10) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }else if (val2.name == 'tahrikSelect') {
                        $.each(val.equipment,function(key5,val5) {
                            if (val5.EquipmentClass == 4) {
                                if (val2.val != val5.DatEquipmentId) {
                                    i++;
                                }
                            }
                        });
                    }
                });
                if (i == 0) {
                    var carData = {};
                    carData.carId = val.DatECode;

                    var oilItems        = {};
                    oilItems.carId       = val.DatECode;
                    oilItems.type       = val.VehicleType;
                    oilItems.brand      = val.Manufacturer;
                    oilItems.model      = val.BaseModel;
                    oilItems.subModel   = val.SubModel;
                    if (allData.motor.length == 1) {
                        oilItems.engine     = allData.motor[0].DatEquipmentId;
                    }else{
                        oilItems.engine     = $('#engineSelect').val();
                    }
                    if (allData.sanziman.length == 1) {
                        oilItems.gear     = allData.sanziman[0].DatEquipmentId;
                    }else{
                        oilItems.gear     = $('#sanzimanSelect').val();
                    }

                    $.ajax({
                        url: site_url+'Service/addCarData/',
                        method:'POST',
                        data: oilItems,
                        dataType:'JSON'
                    });


                    if(window.innerWidth <= 800) {
                        var times = '<option value="" default disabled selected>&nbsp;&nbsp;&nbsp;Trafiğe Çıkış</option>';
                    }else{
                        var times = '';
                    }

                    $.ajax({url: site_url+'Service/getConsTime/'+val.DatECode,
                        method:'POST',
                        data: {},
                        dataType:'JSON',
                        success:function(result){
                            $.each(result,function(key9999,val9999) {
                                times += '<option value="'+val9999.value+'">&nbsp;&nbsp;&nbsp;'+val9999.name+'</option>'
                            });
                            
                            $('.allSelect').scrollTo($('.allSelect select:not(:last):last').next('select'), 700);
                            $('#consTime').removeAttr('disabled');
                            $('#consTime').html(times);
                        },error:function(result) {
                        }
                    });
                    //carData.consTime = val.ns1ConstructionTimeFrom;
                    //setCookie('selectedCar', JSON.stringify(carData), 1);
                    //window.location.href = url;
                    //$('#sasiSearchErrorText').addClass('gizle');
                }
            });
        }else{
            $('#sasiSearchErrorText').removeClass('gizle');
        }
    }
}

function sasiAra(url) {
    data = [];
    var ir = 0;
    $.each($('.sasiSearchSelects'),function(key,val) {
        if ($(this).val() == null) {
            $(this).attr('style','border:1px solid red;');
            ir++;
        }else{
            $(this).attr('style','border:1px solid #ced4da;');
            var val     = $(this).val();
            var name    = $(this).attr('id');
            data.push({name:name,val:val});
        }
    });

    if (ir == 0) {
        $.each(allData.result,function(key,val) {
            var i = 0;
            $.each(data,function(key2,val2) {
                if (val2.name == 'markaSelect') {
                    if (val2.val != val.Manufacturer) {
                        i++;
                    }
                }else if (val2.name == 'modelSelect') {
                    if (val2.val != val.BaseModel) {
                        i++;
                    }
                }else if (val2.name == 'altModelSelect') {
                    if (val2.val != val.SubModel) {
                        i++;
                    }
                }else if (val2.name == 'engineSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 1) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'sasiSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 2) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'sanzimanSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 11) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'aksSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 3) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'dizaynSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 10) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'tahrikSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 4) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }
            });
            if (i == 0) {
                var carData = {};
                $('#sasiSearchErrorText').addClass('gizle');
                carData.carId = val.DatECode;
                carData.consTime = $('#consTime').val();
                $.cookie("selectedCar", JSON.stringify(carData), {
                    expires : 1,
                    path    : '/',
                    domain  : domain_name,
                    secure  : true
                });
                //setCookie('selectedCar', JSON.stringify(carData), 1);
                window.location.href = url;
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
    $.cookie("selectedCar", JSON.stringify(carData), {
        expires : 1,
        path    : '/',
        domain  : domain_name,
        secure  : true
    });
    //setCookie('selectedCar', JSON.stringify(carData), 1);
    window.location.href = site_url+"yedek-parcalar/";
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
            var val     = $(this).val();
            var name    = $(this).attr('id');
            data.push({name:name,val:val});
        }
    });

    if (ir == 0) {
        $.each(allData.result,function(key,val) {
            var i = 0;
            $.each(data,function(key2,val2) {
                if (val2.name == 'markaSelect') {
                    if (val2.val != val.Manufacturer) {
                        i++;
                    }
                }else if (val2.name == 'modelSelect') {
                    if (val2.val != val.BaseModel) {
                        i++;
                    }
                }else if (val2.name == 'altModelSelect') {
                    if (val2.val != val.SubModel) {
                        i++;
                    }
                }else if (val2.name == 'engineSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 1) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'sasiSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 2) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'sanzimanSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 11) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'aksSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 3) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'dizaynSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 10) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }else if (val2.name == 'tahrikSelect') {
                    $.each(val.equipment,function(key5,val5) {
                        if (val5.EquipmentClass == 4) {
                            if (val2.val != val5.DatEquipmentId) {
                                i++;
                            }
                        }
                    });
                }
            });
            if (i == 0) {
                var carData = {};
                carData.carId = val.DatECode;
                carData.consTime = $('#consTime').val();
                $.ajax({url: site_url+'Service/addGarrage',
                    method:'POST',
                    data: carData,
                    success:function(result){
                        if (result == 'Err') {
                            Swal.fire({type: 'error', title: 'Hata !',confirmButtonText: 'Tamam', html: '<p style="text-align:center;">Bu araç garajınızda zaten var.</p>', animation: false, customClass: 'animated tada'});
                        }else if (result == 'Usr'){
                            Swal.fire({type: 'error', title: 'Hata !',confirmButtonText: 'Tamam', html: '<p style="text-align:center;">Garajınıza araç eklemek için Üye girişi yapmalısınız !</p>', animation: false, customClass: 'animated tada'});
                        }else{
                            $.cookie("selectedCar", JSON.stringify(carData), {
                                expires : 1,
                                path    : '/',
                                domain  : domain_name,
                                secure  : true
                            });
                            //setCookie('selectedCar', JSON.stringify(carData), 1);
                            $('#sasiSearchErrorText').addClass('gizle');
                            window.location.href = site_url+"hesabim/garajim";
                        }
                    },error:function(result) {
                        $('#sasiSearchErrorText').addClass('gizle');
                        window.location.href = site_url+"giris-yap";
                    }
                });
            }
        });
    }else{
        $('#sasiSearchErrorText').removeClass('gizle');
    }
}