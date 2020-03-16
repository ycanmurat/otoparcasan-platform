//Triggers//
	
$(document).on('keypress',function(e) {

	var getTriggerUrl = window.location.href;
		
	if(e.which == 13) {
		
		var site_url = 'https://otoparcasan.kodakil.com/';

		if (getTriggerUrl == site_url + 'User') {
    		$('#login').trigger('click');
		} else if (getTriggerUrl == site_url + 'User/register') {
			$('#register').trigger('click');
		} else if (getTriggerUrl == site_url + 'User/forgot_password') {
			$('#renew_password').trigger('click');
		}
	}
});

//Triggers//

$( document ).ready(function() {

	var site_url = 'https://otoparcasan.kodakil.com/';

	//Masks//

	$('#phone').inputmask('9 (999) 999 99 99');
	$('#gsm').inputmask('9 (999) 999 99 99');
	$('#register_phone').inputmask('9 (999) 999 99 99');
	$('#date_of_birth').inputmask('99/99/9999');
	$('#ibanNumber').inputmask('99 9999 9999 9999 9999 99');
	$('#transferPhone').inputmask('9 (999) 999 99 99');

	//Masks//

	//Register Module
    $('#register').click(function(){
		var registerInformation = {};
		registerInformation.register_name = $('#register_name').val();	
		registerInformation.register_last_name = $('#register_last_name').val();	
		registerInformation.register_email = $('#register_email').val();	
		registerInformation.register_phone = $('#register_phone').val();	
		registerInformation.register_password = $('#register_password').val();	
		registerInformation.register_password_again = $('#register_password_again').val();	
		registerInformation.membership_agreement = ( $('#membership_agreement').is(':checked') ) ? 1 : 0;
		registerInformation.campaign_notification = ( $('#campaign_notification').is(':checked') ) ? 1 : 0;
		if(registerInformation.membership_agreement == 0) {
			Swal.fire({type: 'error', title: 'Hata !', html: '<p style="text-align:center;">Lütfen Üyelik Sözleşmesini Onaylayın.</p>', animation: false, customClass: 'animated tada'});
		} else {
			$.ajax({
		        method: 'post',
		        dataType: 'json',
		        data : registerInformation,
		        url: site_url + 'Ajax/register',
		        success: function(result){
		            if (result.status == true) {
		            	window.location = result.redirect_url; 
		            	Swal.fire({type: 'success', title: 'Başarılı !', html: 'Kayıt İşlemi Tamamlandı Yönlendiriliyorsunuz.', animation: false, customClass: 'animated tada'});
		            } else {
		            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
		            }
	        	}, error: function() {
	        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
	        	}
	    	});
		}
	});

    //Login Module
    $('#login').click(function(){
		var loginInformation = {};
		loginInformation.login_email = $('#login_email').val();	
		loginInformation.login_password = $('#login_password').val();
		loginInformation.remember_me = ( $('#remember_me').is(':checked') ) ? 1 : 0;
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : loginInformation,
	        url: site_url + 'Ajax/login',
	        success: function(result){
	            if (result.status == true) {
	            	window.location = result.redirect_url; 
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
    	});
	});

	//Update Account Module
    $('#updateAccount').click(function(){
		var updateInformation = {};
		updateInformation.name = $('#name').val();	
		updateInformation.surname = $('#surname').val();	
		updateInformation.phone = $('#phone').val();
		updateInformation.email = $('#email').val();
		updateInformation.city = $('#city').val();
		updateInformation.town = $('#town').val();
		updateInformation.date_of_birth = $('#date_of_birth').val();
		updateInformation.gender = $('#gender').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : updateInformation,
	        url: site_url + 'Ajax/updateAccount',
	        success: function(result){
	            if (result.status == true) {
	            	window.location = result.redirect_url; 
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
    	});
	});

	//Update Account Password
    $('#updatePassword').click(function(){
		var updatePasswordInformation = {};
		updatePasswordInformation.currentPassword = $('#currentPassword').val();	
		updatePasswordInformation.newPassword = $('#newPassword').val();
		updatePasswordInformation.newPasswordRepeat = $('#newPasswordRepeat').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : updatePasswordInformation,
	        url: site_url + 'Ajax/updatePassword',
	        success: function(result){
	            if (result.status == true) {
	            	window.location = result.redirect_url; 
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
    	});
	});

	//Selected Country Value
	$('#country').change(function(){
    	var CountryID = $('#country').val();
    	if (CountryID !== '') {
    		$.ajax({
		        method: 'post',
		        dataType: 'json',
		        url: site_url + 'Ajax/getCitiesByCountry/' + CountryID,
		        success: function(result){
		            if (result.status) {
		            	var html = '';
		            	$.each( result.array, function( key, value ) {
							html += '<option value='+ value.CityID +'>' + value.CityName + '</option>';
						});
						$('#city').append(html);
		            } else {
		            	$('#city').html('');
		            	$('#city').append('<option value="">Lütfen Seçin</option>');
		            	$('#town').html('');
		            	$('#town').append('<option value="">Lütfen Seçin</option>');
		            }
		    	}, error: function() {
		    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
		    	}
    		});
    	} else {
    		$('#city').html('');
		    $('#city').append('<option value="">Lütfen Seçin</option>');
		    $('#town').html('');
		    $('#town').append('<option value="">Lütfen Seçin</option>');
    	}
	});

	//Selected Counties Value
	$('#city').change(function(){
    	var CityID = $('#city').val();
    	if (CityID !== '') {
    		$.ajax({
		        method: 'post',
		        dataType: 'json',
		        url: site_url + 'Ajax/getCountiesByCities/' + CityID,
		        success: function(result){
		            if (result.status) {
		            	$('#town').html('');
		            	var html = '';
		            	$.each( result.array, function( key, value ) {
							html += '<option value='+ value.CountyID +'>' + value.CountyName + '</option>';
						});
						$('#town').append(html);
		            } else {
		            	$('#town').html('');
		            	$('#town').append('<option value="">Lütfen Seçin</option>');
		            }
		    	}, error: function() {
		    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
		    	}
    		});
    	} else {
    		$('#town').html('');
		    $('#town').append('<option value="">Lütfen Seçin</option>');
    	}
	});

	//Selected Counties Value
	$('#town').change(function(){
    	var AreaID = $('#town').val();
    	if (AreaID !== '') {
    		$.ajax({
		        method: 'post',
		        dataType: 'json',
		        url: site_url + 'Ajax/getCountiesByArea/' + AreaID,
		        success: function(result){
		            if (result.status) {
		            	$('#area').html('');
		            	var html = '';
		            	$.each( result.array, function( key, value ) {
							html += '<option value='+ value.AreaID +'>' + value.AreaName + '</option>';
						});
						$('#area').append(html);
		            } else {
		            	$('#area').html('');
		            	$('#area').append('<option value="">Lütfen Seçin</option>');
		            }
		    	}, error: function() {
		    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
		    	}
    		});
    	}
	});

	//Add Address
	$('#addAddress').click(function(){
		var addressInformation = {};
		addressInformation.definition = $('#definition').val();
		addressInformation.name = $('#name').val();
		addressInformation.gsm = $('#gsm').val();
		addressInformation.post_code = $('#post_code').val();
		addressInformation.country = $('#country').val();
		addressInformation.city = $('#city').val();
		addressInformation.town = $('#town').val();
		addressInformation.identity_number = $('#identity_number').val();
		addressInformation.content = $('#content').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : addressInformation,
	        url: site_url + 'Ajax/addAddress',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({title:'Başarılı!', html: 'Adresiniz Sistemimize Eklendi !', type:'success'});
	            	$( '#modalSecondary' ).trigger( 'click' );
	            	$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        	}
    	});
	});

	//Update Country, City, And Town
	$('select').on('change', function (e) {
		if(window.location.href == "https://otoparcasan.kodakil.com/Account/address"){
			var country_id = $(this).attr( 'id' );
			var items = country_id.split('-');
			var CountryID = $('#country-'+items[1]).val();
	    	if (CountryID !== '') {
	    		$.ajax({
			        method: 'post',
			        dataType: 'json',
			        url: site_url + 'Ajax/getCitiesByCountry/' + CountryID,
			        success: function(result){
			            if (result.status) {
			            	var html = '';
			            	$.each( result.array, function( key, value ) {
								html += '<option value='+ value.CityID +'>' + value.CityName + '</option>';
							});
							$('#city-'+items[1]).append(html);
							$('#city-'+items[1]).change(function(){
								var CityID = $('#city-'+items[1]).val();
								if (CityID !== '') {
						    		$.ajax({
								        method: 'post',
								        dataType: 'json',
								        url: site_url + 'Ajax/getCountiesByCities/' + CityID,
								        success: function(result){
								            if (result.status) {
								            	$('#town-'+items[1]).html('');
								            	var html = '';
								            	$.each( result.array, function( key, value ) {
													html += '<option value='+ value.CountyID +'>' + value.CountyName + '</option>';
												});
												$('#town-'+items[1]).append(html);
								            } else {
								            	$('#town-'+items[1]).html('');
								            	$('#town-'+items[1]).append('<option value="">Lütfen Seçin</option>');
								            }
								    	}, error: function() {
								    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
								    	}
						    		});
						    	} else {
						    		$('#town-'+items[1]).html('');
								    $('#town-'+items[1]).append('<option value="">Lütfen Seçin</option>');
						    	}
							});
			            } else {
			            	$('#city-'+items[1]).html('');
			            	$('#city-'+items[1]).append('<option value="">Lütfen Seçin</option>');
			            	$('#town-'+items[1]).html('');
			            	$('#town-'+items[1]).append('<option value="">Lütfen Seçin</option>');
			            }
			    	}, error: function() {
			    		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
			    	}
	    		});
	    	} else {
	    		$('#city-'+items[1]).html('');
			    $('#city-'+items[1]).append('<option value="">Lütfen Seçin</option>');
			    $('#town-'+items[1]).html('');
			    $('#town-'+items[1]).append('<option value="">Lütfen Seçin</option>');
	    	}
    	}
	});

	//Update Address
	$('button').click(function() {
    	var modal_id = ($(this).attr('id'));
    	if (typeof modal_id != 'undefined') {
    		var explode = modal_id.split('-');
	    	if (explode[0]==='editAndUpdateAddress') {
	    		var updateInformation = {};
				updateInformation.definition = $('#definition-' + explode[1]).val();
				updateInformation.name = $('#name-' + explode[1]).val();
				updateInformation.gsm = $('#gsm-' + explode[1]).val();
				updateInformation.post_code = $('#post_code-' + explode[1]).val();
				updateInformation.country = $('#country-' + explode[1]).val();
				updateInformation.city = $('#city-' + explode[1]).val();
				updateInformation.town = $('#town-' + explode[1]).val();
				updateInformation.identity_number = $('#identity_number-' + explode[1]).val();
				updateInformation.content = $('#content-' + explode[1]).val();
				updateInformation.update_id = explode[1];
				$.ajax({
			        method: 'post',
			        dataType: 'json',
			        data : updateInformation,
			        url: site_url + 'Ajax/updateAddress',
			        success: function(result){
			            if (result.status == true) {
			            	Swal.fire({title:'Başarılı!', html: 'Adresiniz Güncellendi !', type:'success'});
			            	$( '.close' ).trigger( 'click' );
			            	$('.swal2-confirm').click(function(){
			            		window.location.href = result.redirect_url;
			            	});
			            } else {
			            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
			            }
		        	}, error: function() {
		        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
		        	}
		    	});
	    	}
    	}
	});

	//Password Renew 
	$('#renew_password').click(function(){
		$('#renew_password').prop('disabled', true);
		var renewInformation = {};
		renewInformation.email = $('#forgot_email').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : renewInformation,
	        url: site_url + 'Ajax/renewPassword',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({title:'Başarılı!', html: 'Şifre Sıfırlama Bağlantınız, Girdiğiniz E-Posta Adresinize Gönderildi.', type:'success'});
	            	$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            	$('.swal2-confirm').click(function(){
	            		$('#renew_password').prop('disabled', false);
	            	});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        		$('.swal2-confirm').click(function(){
	            	$('#renew_password').prop('disabled', false);
	            });
        	}
		});
	});

	//New Password Save
	$('#password_save').click(function(){
		$('#password_save').prop('disabled', true);
		var resetInformation = {};
		resetInformation.email = $('#refresh_email').val();
		resetInformation.password = $('#refresh_password').val();
		resetInformation.password_repeat = $('#refresh_password_repeat').val();
		resetInformation.remember_key = $('#refresh_key').val();
		$.ajax({
	        method: 'post',
	        dataType: 'json',
	        data : resetInformation,
	        url: site_url + 'Ajax/refreshPassword',
	        success: function(result){
	            if (result.status == true) {
	            	Swal.fire({title:'Başarılı!', html: 'Şifreniz Güncellendi, Yeni Bilgileriniz İle Giriş Yapabilirsiniz.', type:'success'});
	            	$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
	            } else {
	            	Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
	            	$('.swal2-confirm').click(function(){
	            		$('#password_save').prop('disabled', false);
	            	});
	            }
        	}, error: function() {
        		Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
        		$('.swal2-confirm').click(function(){
	            	$('#password_save').prop('disabled', false);
	            });
        	}
		});
	});

	//Notification Settings 
	$('#notification_settings_update').click(function(){
		var notificationInformation = {};
		notificationInformation.campaign_email = ( $('#campaign_email').is(':checked') ) ? 1 : 0;
		notificationInformation.campaign_sms = ( $('#campaign_sms').is(':checked') ) ? 1 : 0;
		notificationInformation.basket_email = ( $('#basket_email').is(':checked') ) ? 1 : 0;
		notificationInformation.cargo_sms = ( $('#cargo_sms').is(':checked') ) ? 1 : 0;
		notificationInformation.favorites_product_email = ( $('#favorites_product_email').is(':checked') ) ? 1 : 0;
		notificationInformation.marketing_call = ( $('#marketing_call').is(':checked') ) ? 1 : 0;
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : notificationInformation,
			url : site_url + 'Ajax/updateNotification',
			success: function(result){
				if (result.status == true) {
					Swal.fire({title:'Başarılı!', html: 'Bildirim Ayarlarınız Güncellendi.', type:'success'});
					$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
				} else {
					Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
				}
			}, error: function() {
				Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
			}
		});
	});

	//İban Add 
	$('#ibanAdd').click(function(){
		var ibanInformation = {};
		ibanInformation.ibanStatus = $("#ibanStatus option:selected").val();
		ibanInformation.ibanNumber = $('#ibanNumber').val();
		ibanInformation.ibanNameSurname = $('#ibanNameSurname').val();
		ibanInformation.ibanBank = $('#ibanBank').val();
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : ibanInformation,
			url : site_url + 'Ajax/addIbanInformation',
			success: function(result){
				if (result.status == true) {
					Swal.fire({title:'Başarılı!', html: 'İban Bilgileriniz Eklendi.', type:'success'});
					$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
				} else {
					Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
				}
			}, error: function() {
				Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
			}
		});
	});

	//Transfer Add
	$('#transferAddInformation').click(function(){
		var transferInformation = {};
		transferInformation.transferNameSurname = $('#transferNameSurname').val();
		transferInformation.transferEmail = $('#transferEmail').val();
		transferInformation.transferPhone = $('#transferPhone').val();
		transferInformation.transferOrderNumber = $('#transferOrderNumber').val();
		transferInformation.transferBankId = $("#transferBankId option:selected").val();
		transferInformation.transferAmount = $('#transferAmount').val();
		transferInformation.transferMessage = $('#transferMessage').val();
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : transferInformation,
			url : site_url + 'Ajax/transferInformationAdd',
			success: function(result){
				if (result.status == true) {
					Swal.fire({title:'Başarılı!', html: 'Havale Ödeme Bilgileriniz Eklendi.', type:'success'});
					$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
	            	});
				} else {
					Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
				}
			}, error: function() {
				Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
			}
		});
	});

	//Modal Web Site Review
	$('#modalReviewSend').click(function(){
		var modalReviewInformation = {};
		modalReviewInformation.deviceType = $('input[name=deviceType]:checked').val();
		modalReviewInformation.generalpageRate = $('input[name=generalpageRate]:checked').val();
		modalReviewInformation.modalReviewMessage = $('#modalReviewMessage').val();
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : modalReviewInformation,
			url : site_url + 'Ajax/modalReviewInformationAdd',
			success: function(result){
				if (result.status == true) {
					$('#modalReviewClose').trigger('click');
					Swal.fire({title:'Başarılı!', html: 'Değerlendirmeniz Bizim İçin Çok Önemli. Teşekkürlerimizi Sunuyoruz.', type:'success'});
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

	//Newsletter Email 
	$('#newsletterMailSend').click(function(){
		var newsletterInformation = {};
		newsletterInformation.newsletterEMail = $('#newsletterEMail').val();
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : newsletterInformation,
			url : site_url + 'Ajax/newsletterMailSend',
			success: function(result){
				if (result.status == true) {
					Swal.fire({title:'Başarılı!', html: 'Bültenimize Kayıt Olduğunuz İçin Teşekkürler.', type:'success'});
				} else {
					Swal.fire({type: 'error', title: 'Hata !', html: result.error, animation: false, customClass: 'animated tada'});
				}
			}, error: function() {
				Swal.fire({type: 'error', title: 'Hata !', text: 'Bağlantı Hatası !', animation: false, customClass: 'animated tada'});
			}
		});
	});

	//Send Requests
	$('#sendSupportRequests').click(function(){
		$('#sendSupportRequests').prop('disabled', true);
		var requestInformation = {};
		requestInformation.supportSection = $("#supportSection option:selected").val();
		requestInformation.supportSubject = $('#supportSubject').val();
		requestInformation.supportMessage = $('#supportMessage').val();
		$.ajax({
			method: 'post',
			dataType : 'json',
			data : requestInformation,
			url : site_url + 'Ajax/sendSupportRequests',
			success: function(result){
				if (result.status == true) {
					Swal.fire({title:'Başarılı!', html: 'Destek Talebiniz Oluşturuldu.', type:'success'});
					$('.swal2-confirm').click(function(){
	            		window.location.href = result.redirect_url;
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