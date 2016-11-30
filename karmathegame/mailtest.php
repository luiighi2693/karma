<?php
require_once('class.phpmailer.php');

global $name,$email;
//
$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host = "mail.karmathegame.guru"; // SMTP server
$mail->SMTPDebug = true; // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Port = 25; // set the SMTP port for the GMAIL server

$mail->Username = "no-reply@karmathegame.guru"; //#### SMTP account username
$mail->Password = "DatingGame2014"; //#### SMTP account password
$mail->WordWrap = 50;
$mail->Priority = 1;
$mail->IsHTML(true);

$mail->SetFrom("no-reply@karmathegame.guru", "karmathegame"); //#### From ID
$mail->AddReplyTo("no-reply@karmathegame.guru","karmathegame"); //#### Reply to ID


$body = "<br><br>
<b>Name:</b> rpaxis<br>
<b>Email ID:</b> rpaxis1@gmail.com<br>
<br><br>";

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$mail->CharSet="UTF-8";
$address = "rpaxis1@gmail.com";
$mail->AddAddress($address, "rpaxis");
$mail->Subject = "Feedback from rpaxis";
if(!$mail->Send())
{
echo "Message was not sent <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";

$mail->ClearAddresses();
$mail->ClearAttachments();

?>
