<?php 
# Include the Autoloader (see "Libraries" for install instructions)
use Mailgun\Mailgun;
# Instantiate the client.

class Mailgunapi
{
    function send($data)
    {
        $mgClient = Mailgun::create(getenv('MAILGUN_API_KEY'), 'https://api.eu.mailgun.net/v3/mailgun.otoparcasan.com');
        $domain = "mailgun.otoparcasan.com";
        /*
        $params = array(
          'from'    => 'Excited User <info@otoparcasan.com>',
          'to'      => 'u.yetkil@kodakil.com',
          'subject' => 'Hello',
          'html'    => 'Testing some Mailgun awesomness!'
        );
        */
        # Make the call to the client.
        try {
            $response = $mgClient->messages()->send($domain, $data);
            //prex($response);
            return true;
        } catch (Exception $e) {
            //prex($e);
            return false;
        }
    }

    function register($data)
    {
        $mgClient = Mailgun::create(getenv('MAILGUN_API_KEY'), 'https://api.eu.mailgun.net/v3/mailgun.otoparcasan.com');
        $domain = "mailgun.otoparcasan.com";
        
        $params = array(
          'from'        => 'otoparcasan.com <info@otoparcasan.com>',
          'to'          => $data->to,
          'subject'     => 'otoparcasan.com\'a Hoşgeldiniz',
          'template'    => 'register',
          'v:name'      => $data->name
        );
        
        $response = $mgClient->messages()->send($domain, $params);
        //prex($response);
    }

    function password_ren($data)
    {
        $mgClient = Mailgun::create(getenv('MAILGUN_API_KEY'), 'https://api.eu.mailgun.net/v3/mailgun.otoparcasan.com');
        $domain = "mailgun.otoparcasan.com";
        
        $params = array(
          'from'        => 'otoparcasan.com <info@otoparcasan.com>',
          'to'          => $data->to,
          'subject'     => 'Otoparçasan Şifre Yenileme İsteği',
          'template'    => 'password_ren',
          'v:name'      => $data->name,
          'v:password_url' => $data->url,
          'v:user_email'   => $data->to
        );
        
        try {
            $response = $mgClient->messages()->send($domain, $params);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function bildirim($data,$vars)
    {
        $mgClient = Mailgun::create(getenv('MAILGUN_API_KEY'), 'https://api.eu.mailgun.net/v3/mailgun.otoparcasan.com');
        $domain = "mailgun.otoparcasan.com";
        
        $params = array(
          'from'        => 'otoparcasan.com <info@otoparcasan.com>',
          'to'          => $data,
          'subject'     => $vars->title,
          'template'    => 'bildirim',
          'v:baslik'    => $vars->baslik,
          'v:buton_link' => $vars->buton_link,
          'v:buton_name' => $vars->buton_name
        );

        try {
            $response = $mgClient->messages()->send($domain, $params);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>