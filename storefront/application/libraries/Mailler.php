<?

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailler
{

	public function Send($data)
	{
		require 'vendor/autoload.php';
		$mail = new PHPMailer(true);
		
		//$mail->SMTPDebug = 3;                               	// Enable verbose debug outputa

		$mail->isSMTP();                                      	// Set mailer to use SMTP
		$mail->Host = getenv('SMTP_HOST');  					  	// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               	// Enable SMTP authentication
		$mail->Username = getenv('SMTP_USER');              		// SMTP username
		$mail->Password = getenv('SMTP_PASS');                      	// SMTP password
		$mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    	// TCP port to connect to
		$mail->CharSet = 'UTF-8';
		
		$mail->SMTPOptions = array (
		    'ssl' => array(
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true)
		);

		$mail->setFrom(getenv('SMTP_FROM'), $data->kimdenName);

		foreach ($data->kime as $value) {
			$mail->addAddress($value['email'], $value['name']);     // Add a recipient
		}

		$mail->addReplyTo($data->yanitEmail, 'Yanıt : ');

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $data->konu;
		$mail->Body    = $data->icerik;

		if(!$mail->send()) {
		   return false;
		   //return array('status' => 'error','error_code' => 0,'error_message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo) ;
		} else {
		    return true;
		    //return array('status' => 'success','error_code' => 1,'error_message' => 'Message has been sent') ;
		}
	}

	public function sendAtachment($data)
	{
		//Load Composer's autoloader
		require 'vendor/autoload.php';
		$mail = new PHPMailer(true);
		
		//$mail->SMTPDebug = 3;                               	// Enable verbose debug outputa

		$mail->isSMTP();                                      	// Set mailer to use SMTP
		$mail->Host = getenv('SMTP_HOST');  					  	// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               	// Enable SMTP authentication
		$mail->Username = getenv('SMTP_USER');              		// SMTP username
		$mail->Password = getenv('SMTP_PASS');                      	// SMTP password
		$mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    	// TCP port to connect to
		$mail->CharSet = 'UTF-8';
		
		$mail->SMTPOptions = array (
		    'ssl' => array(
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true)
		);


		$mail->setFrom(getenv('SMTP_FROM'), $data->kimdenName);
		$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);

		foreach ($data->kime as $value) {
			$mail->addAddress($value['email'], $value['name']);     // Add a recipient
		}

		$mail->addReplyTo($data->yanitEmail, 'Yanıt : ');

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $data->konu;
		$mail->Body    = $data->icerik;

		if(!$mail->send()) {
		   return false;
		   //return array('status' => 'error','error_code' => 0,'error_message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo) ;
		} else {
		    return true;
		    //return array('status' => 'success','error_code' => 1,'error_message' => 'Message has been sent') ;
		}
	}
}