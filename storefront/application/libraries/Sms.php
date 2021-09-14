<?php 
/**
* 
*/
class Sms
{

    public function NetGsmSend($data)
    {

        //prex($data);
        $mesaj  = $data->text;
        $tel    = $data->receivers; 
        $baslik = 'OTOPARCASAN';


        $username = getenv('NETGSM_USER');
        $password = urlencode(getenv('NETGSM_PASS'));

        $url= "https://api.netgsm.com.tr/sms/send/get/?dil=TR&usercode=".$username."&password=".$password."&gsmno=".$tel."&message=".$mesaj."&msgheader=".$baslik;
        $url = str_replace(" ", '%20', $url);

        $ch = curl_init($url);
        //curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        
        //prex($return);
    }
}

?>