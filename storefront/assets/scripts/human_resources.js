$(function(){
	var site_url = window.location.href;
	if (site_url === "https://otoparcasan.kodakil.com/Corporate/insankaynaklari") {
		var CityID = $("#city").val();
		if (CityID !== '') {
    		$.ajax({
		        method: 'post',
		        dataType: 'json',
		        url: '/Ajax/getCountiesByHumanResources/' + CityID,
		        success: function(result){
		            if (result.status) {
		            	var html = '';
		            	$.each( result.array, function( key, value ) {
							html += '<option value='+ value.CountyID +'>' + value.CountyName + '</option>';
						});
						$('#town').append(html);
		            } else {
		            	$('#town').html('');
		            	$('#town').append('<option value="">Lütfen Seçin</option>');
		            	$('#area').html('');
		            	$('#area').append('<option value="">Lütfen Seçin</option>');
		            }
		    	}, error: function() {
		    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
		    	}
    		});
    	} else {
    		$('#town').html('');
        	$('#town').append('<option value="">Lütfen Seçin</option>');
        	$('#area').html('');
        	$('#area').append('<option value="">Lütfen Seçin</option>');
    	}
	}
})