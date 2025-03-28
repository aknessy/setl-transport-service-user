<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

//Load Composer's autoloader
require APPPATH . '../vendor/autoload.php';

//header("Content-Type: application/json");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer extends CI_Model {

	public $_app_name = "";
	public $_email = "";
	public $_password = "";
  	public $_mail_server = "";
	public $_mail_port = "";

	public function __construct(){
		parent::__construct();

    $this->_app_name = $this->settings_m->getOne(array('skey' => 'app_name'))->value;
    $this->_email = $this->settings_m->getOne(array('skey' => 'smtp_username'))->value;
    $this->_mail_port = $this->settings_m->getOne(array('skey' => 'smtp_port'))->value;
    $this->_password = $this->settings_m->getOne(array('skey' => 'smtp_password'))->value;
	$this->_mail_server = $this->settings_m->getOne(array('skey' => 'smtp_host'))->value;

	}

	public function send($email, $name, $body, $subject){

		// Passing `true` enables exceptions
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = $this->_mail_server;  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = $this->_email;                 // SMTP username
			$mail->Password = $this->_password;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = $this->_mail_port;                                   // TCP port to connect to

			//Recipients
			$mail->setFrom($this->_email, $this->_app_name);
			$mail->addAddress($email, $name);     // Add a recipient
			$mail->addReplyTo($this->_email, $this->_app_name);

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body = $body;

			$mail->send();
			// echo "string";
		} catch (Exception $e) {
			// echo json_encode(array("error" => true, "message" => 'Message could not be sent.', "error" => $mail->ErrorInfo, "data" => $data));
		}
	}
}
