$(function(){

	//Contact Module
    $('#sendContactForm').click(function(){
		var contactInformation = {};
		contactInformation.contactNameSurname = $('#contactNameSurname').val();	
		contactInformation.contactMail = $('#contactMail').val();	
		contactInformation.contactPhone = $('#contactPhone').val();	
		contactInformation.contactSubject = $('#contactSubject').val();	
		contactInformation.contactMessage = $('#contactMessage').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : contactInformation,
	        url: '/Ajax/sendContactForm',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({type: 'success', title: 'Başarılı !', html: 'Bilgilerinizi Aldık, En Kısa Zamanda Size Geri Dönüş Sağlayacağız.', animation: false, customClass: 'animated tada'});
	            	$('.swal2-confirm').click(function(){
	            		window.location.href = window.location.href;
	            	});
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
    	});
	});
});