<?PHP

$username = $_POST['username'];
$pass = $_POST['password'];

$con = mysql_connect("www.karmathegame.org","karmathe_KarmaAI","Reality2012") or ("Cannot connect!"  . mysql_error());
if (!$con)
	die('Could not connect: ' . mysql_error());
	
mysql_select_db("karmathe_databox_karma" , $con) or die ("could not load the database" . mysql_error());

$check = mysql_query("SELECT * FROM users WHERE `username`='".$username."'");
$numrows = mysql_num_rows($check);
if ($numrows == 0)
{
	die ("Username does not exist \n");
}
else
{
	//$pass = md5($pass);
	$pass = $pass;
	while($row = mysql_fetch_assoc($check))
	{
		if ($pass == $row['pass'])
			die("login-SUCCESS");
		else
			die("Password does not match \n");
	}
}

?>