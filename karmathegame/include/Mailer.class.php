<?
class Mailer extends PHPMailer
{
	public function __construct()
	{
		#$this->PHPMailer();
		$this->IsSMTP(true);
		$this->IsHTML(true);
		$this->SMTPAuth = true;
		$this->Host = 'mail.rpaxis.net';
		$this->Port = '25';
		//$this->Username = 'email@mallcom.com';
		//$this->Password = '****';
		$this->From = 'rae@rpaxis.net';
		$this->FromName = 'rae@rpaxis.net';
	}
	public function __destruct()
	{
	}
}
?>