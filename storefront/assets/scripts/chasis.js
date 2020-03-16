
/*
$( document ).ready(function() {

	var site_url = 'https://otoparcasan.kodakil.com/';

	//Chasis Number Get
	$('#chasisSearch').click(function(){
		var chasisInformation = {};
		chasisInformation.chasisNo = $('#chasisNo').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : chasisInformation,
	        url: site_url + 'Ajax/chasisSearch',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({title:'Başarılı!', html: 'Sorgulama Yapılıyor ...', type:'success'});
	            } else {
	            	Swal.fire({type: 'warning', title: 'Uyarı', html: result.error});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
	    });
	});
});
*/