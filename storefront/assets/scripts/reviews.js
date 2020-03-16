$( document ).ready(function() {

	var site_url = 'https://otoparcasan.kodakil.com/';

	var star = '';
	$('.star').on('click', function() {
		star = $(this).data('value');
	});	

	$('#sendReview').click(function(){
		reviewInformation = {};
		reviewInformation.star = star;
		reviewInformation.product_quality = ( $('#product_quality').is(':checked') ) ? 0 : 1;
		reviewInformation.ease_of_use = ( $('#ease_of_use').is(':checked') ) ? 0 : 1;
		reviewInformation.fast_shipping = ( $('#fast_shipping').is(':checked') ) ? 0 : 1;
		reviewInformation.price_range = ( $('#price_range').is(':checked') ) ? 0 : 1;
		reviewInformation.product_packaging = ( $('#product_packaging').is(':checked') ) ? 0 : 1;
		reviewInformation.message = $('#message').val();
		$.ajax({
			method : 'post',
			dataType : 'json',
			data : reviewInformation,
	        url: site_url + 'Ajax/sendReview',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({title:'Başarılı!', html: 'Bizi Değerlendirdiğiniz İçin Teşekkür Ederiz.', type:'success'});
					$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
	            } else {
	            	Swal.fire({title:'Uyarı !', html: result.error, type:'warning'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
		});
	});
});