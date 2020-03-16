/*$('#m_login_signin_submit').click(function(){*/
$(document).on('click', '#m_login_signin_submit', function () {
    $.blockUI({ css: { border: 'none', padding: '15px', backgroundColor: '#000', '-webkit-border-radius': '30px', '-moz-border-radius': '30px', opacity: .5, color: '#fff' }, message: 'Lütfen Bekleyin' }); 
    event.preventDefault();
    m_login_signin_username = $('#admin_email').val();
    m_login_signin_password = $('#admin_password').val();
    grecaptcha.ready(function() {
        grecaptcha.execute('YOUR_RECAPTCHA_SITE_KEY', {action: '/Admin/Login'}).then(function(token) {
        $('#g-recaptcha-response').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            $.post("/Admin/Ajax/login",{m_login_signin_username:m_login_signin_username,m_login_signin_password:m_login_signin_password,token:token}, function(result) {
                $.unblockUI();
                if(result.status == true) {
                    Swal.fire({type: 'success', title: 'Başarılı', html: 'Yönlendiriliyorsunuz ..'});
                    $('.swal2-confirm').click(function(){
                        window.location.href = result.redirect_url;
                    });
                    setTimeout(function(){
                        window.location.href = result.redirect_url;
                    },3000);
                } else if (result.captcha_error == true) {
                    Swal.fire({type: 'warning', title: 'Uyarı', html: 'Bilgilerinizi Google\'dan Alamıyoruz, Lütfen Robot Olmadığınızı Manuel Olarak Onaylayın'});
                    $('.g-recaptcha').css("display", "");
                    $("#m_login_signin_submit").prop("type", "submit");
                    $('#m_login_signin_submit').removeAttr('id');
                } else {
                    Swal.fire({type: 'warning', title: 'Uyarı', html: result.error});
                }
            });
        });;
    });
});

$(document).on('keypress',function(e) {
    if(e.which == 13) { 
        $('#m_login_signin_submit').trigger('click');  
    }
});