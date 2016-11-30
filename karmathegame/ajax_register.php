<?
include("connect.php");
function Get_CreatePasswordXXX()
{
	$chars = "23456789abcdefghijklmnopqrstuvwxyz";    
	srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 6) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
} 
if($_GET['fullname']!="" && $_GET['registeremail']!="")
{
	$SelCustomerQry=mysql_query("select id from marketers where email='".addslashes($_GET['registeremail'])."'");
	$TotUsername=mysql_num_rows($SelCustomerQry);
	if($TotUsername<=0)
	{
		$password=Get_CreatePasswordXXX();
		
		$sql="INSERT INTO marketers SET 
		firstname='".addslashes($_GET["fullname"])."',password='".addslashes($password)."',
		email='".addslashes($_GET["registeremail"])."',
		phone='".addslashes($_GET["phone"])."',
		code='".addslashes($_GET["yourcode"])."',
		recruitedby='".addslashes($_GET["recruitedby"])."',
		addeddate=now()";	
		mysql_query($sql);
		$insertedid=mysql_insert_id();
		
		$subject1="Karma - New Brand Ambassador Registration";
		$from1=$ADMIN_MAIL;	
		$mailcontent1='
		<table width="100%" border="0" cellpadding=0 cellspacing=0>
			<tr>
				<td align="left">Hi,
				<br><br>A new brand ambassador registered with Karma.<br><br>
				Registration details are:
				<br><b>Full Name:</b> '.ucwords($_GET["fullname"]).'
				<br><b>Email:</b> '.$_GET["registeremail"].'
				<br><b>Password:</b> '.$password.'
				<br><b>Phone No.:</b> '.$_GET["phone"].'
				<br><b>Code:</b> '.$_GET["yourcode"].'
				<br><br>Regards,<br>Karma - the Game of Destiny
				</td>
			</tr>
		</table>';
		//echo $ADMIN_MAIL."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
		if($_SERVER['HTTP_HOST']!="abc")
		{
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: Karma <$ADMIN_MAIL>" . "\r\n";	
			mail($ADMIN_MAIL, $subject1, $mailcontent1, $headers);	
		}
		$message="Thank you, and welcome to the Karma Team.<br>You will be receiving an email with further instruction on getting paid.";
	}
	else
	{
		$message="Already Registered as a Brand Ambassador.";
	}
}
echo $message;
?>