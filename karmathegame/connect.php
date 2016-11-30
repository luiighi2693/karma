<?php
session_start();
include ("include/config.inc.php");
include ("include/functions.php");
include ("include/prs_function.php");
include ("class.phpmailer.php");

$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD) or die(mysql_error());
mysql_select_db($DATABASENAME,$db);
$linkpath="http://".$_SERVER['HTTP_HOST']."/".$folder."/index.php";

$ADMIN_MAIL=GetName1("admin","adminmail","id","1");
$AUTHORIZEACTIVE='N';

function SendHTMLMail($to,$subject,$mailcontent,$from1)
{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.karmathegame.guru";
	$mail->SMTPDebug = 2;
	$mail->SMTPAuth = true;
	$mail->Port = 25;
	$mail->Username = "no-reply@karmathegame.guru";
	$mail->Password = "DatingGame2014";
	$mail->WordWrap = 50;
	$mail->SMTPDebug = false;
	$mail->Priority = 1;
	$mail->IsHTML(true);
	$mail->SetFrom("no-reply@karmathegame.guru", "KARMA - the Game of Destiny");
	$mail->AddReplyTo("no-reply@karmathegame.guru","KARMA - the Game of Destiny");
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
	$mail->MsgHTML($mailcontent);
	$mail->CharSet="UTF-8";
	$mail->AddAddress($to,"");
	$mail->Subject = $subject;
	if(!$mail->Send())
	{
	}
	$mail->ClearAddresses();
}


function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>