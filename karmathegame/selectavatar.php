<? include("connect.php");
$TOPCONDENSE="YES";
$getAvatarsQryRs=mysql_query("SELECT * FROM avatars WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."'");
$TotgetAvatars=mysql_affected_rows();
//if($TotgetAvatars>0) {$TotgetAvatarsDevided=intval($TotgetAvatars/3);}else{header("location:index.php");exit;}

function Get_CreatePasswordXXX()
{
	$chars = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";    
	srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 11) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
} 
if($_POST['HidRegUser']=="1")
{
	$codee=$_POST['codee'];
	$email=$_POST['email'];
	$SelCustomerQry=mysql_query("select id from marketers where code='".addslashes($codee)."'");
	$TotUsername=mysql_num_rows($SelCustomerQry);
	if($TotUsername>0 || $codee=="0000")
	{
		$CopuonCode=Get_CreatePasswordXXX();
		$temppassword=Get_CreatePasswordXXX();
		$SelCustomerQry=mysql_query("select id from users where couponcode='".addslashes($CopuonCode)."'");
		$TotUsername=mysql_num_rows($SelCustomerQry);
		if($TotUsername<=0)
		{
			$InsertUserQry="INSERT INTO users set 
			email='".addslashes($_POST['email'])."',
			couponcode='".addslashes($CopuonCode)."',
			marketer='".addslashes($codee)."',
			password='".addslashes($temppassword)."',
			groupid='".addslashes($_POST['grp'])."',
			avatarid='".addslashes($_POST['HidAvatar'])."',
			ipaddress = '".get_client_ip()."',
			regdate=now()";
			mysql_query($InsertUserQry);
			$InsertId=mysql_insert_id();
			
			/*$InsertUserQry2="INSERT INTO promotional  SET
			promocode='".addslashes($CopuonCode)."',
			lifes='3',
			chklimit='N',
			notimes='1',
			disctype='1',
			userid='".addslashes($InsertId)."',
			marketer='".addslashes($codee)."'";	
			mysql_query($InsertUserQry2);*/
			
			if($codee=="0000"){ $BA_Name="Game Guru"; } else { $BA_Name=ucwords(stripslashes(GetName1("marketers","firstname","code",$codee))); }
			
			$toemail=$_POST['email'];
			$from1="noreply@karmathegame.guru";
			$subject1="VALIDATE AND PURCHASE.";
			$mailcontent1='
			<table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr>
					<td align="left">
					Hello,
					<br><br>
					THANK YOU FOR CHOOSING TO PLAY KARMA THE GAME OF DESTINY.
					<br><br>
					YOUR TOKEN NUMBER IS<br>
					'.$CopuonCode.'<br><br>
					TEMPORARY PASSWORD<br>
					'.$temppassword.'<br><br>
					<br>
					PLEASE VALIDATE AND ADD LIFE TO YOUR AVATAR BY CLICKING BELOW
					<br>
					<a href="'.$SITE_URL.'/validate_newlife.php?id='.$InsertId.'&couponcode='.$CopuonCode.'">'.$SITE_URL.'/validate_newlife.php?id='.$InsertId.'&couponcode='.$CopuonCode.'</a>
					<br><br>
					<img src="'.$SITE_URL.'/images/guru-icon.png" width=100 />
					<br><br><br>THANK YOU
					</td>
				</tr>
			</table>';
			//echo $toemail."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
			if($_SERVER['HTTP_HOST']!="yogs")
			{
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: Karma <$from1>" . "\r\n";	
				mail($toemail, $subject1, $mailcontent1, $headers);	
			}
			header("location:thank-you.php");
			exit;
		}
		else
		{
			$message="Token Already Issued";
		}
	}
	else
	{
		$message="Brand Ambassador's code is invalid.";
	}
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div>
<br />
<div id="headline_titles"> </div>
<style type="text/css">
body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}
</style>
<div id="pad_wrapper">
<form name="frmselectavatar" id="frmselectavatar" enctype="multipart/form-data" method="post" onSubmit="return frmcheck();">
  <div id="pad_newlife_fullwidth">
    
	<? if($message!=''){?><div style="color:#FF0000;" align="center"><? echo $message;?></div><? }?>
    <div id="mbook_selectavatar">
      <div id="left_column_selectavatar" class="left_column_selectavatar"  >
	  <?
	  if($TotgetAvatars>0)
	  {
			$getAvatarsQryRs1=mysql_query("SELECT * FROM avatars WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and columnn='M' order by id desc ");
			$TotgetAvatars1=mysql_affected_rows();
			if($TotgetAvatars1>0)
			{
				while($getAvatarsQryRow1=mysql_fetch_array($getAvatarsQryRs1))
				{
	  ?>
		 			<a href="#" onclick="return SelectAvatar(<? echo $getAvatarsQryRow1['id']?>);return false;"><img id="IMG_AVATAR_<? echo $getAvatarsQryRow1['id']?>" src="Avatars/<? echo $getAvatarsQryRow1['picture'];?>"  border="0" /></a>
		  	<? }?>
		  <? }?>
	  <? }?>
	  </div>
      <!-- end #left_column -->
      <div id="center_column_selectavatar" class="center_column_selectavatar"  >
	  	  <?
		  if($TotgetAvatars>0)
		  {
				$getAvatarsQryRs1=mysql_query("SELECT * FROM avatars WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."'  and columnn='F'  order by id desc   ");
				$TotgetAvatars1=mysql_affected_rows();
				if($TotgetAvatars1>0)
				{
					while($getAvatarsQryRow1=mysql_fetch_array($getAvatarsQryRs1))
					{
		  ?>
						<a href="#" onclick="return SelectAvatar(<? echo $getAvatarsQryRow1['id']?>);return false;"><img id="IMG_AVATAR_<? echo $getAvatarsQryRow1['id']?>" src="Avatars/<? echo $getAvatarsQryRow1['picture'];?>"  border="0" /></a>
				<? }?>
			  <? }?>
		  <? }?>
	  </div>
      <!-- end #center_column -->
      <div id="right_column_selectavatar" class="right_column_selectavatar">
	  	  <?
		  if($TotgetAvatars>0)
		  {
		  		$getAvatarsQryRs1=mysql_query("SELECT * FROM avatars WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."'   and columnn='I'  order by id desc  ");
				$TotgetAvatars1=mysql_affected_rows();
				if($TotgetAvatars1>0)
				{
					while($getAvatarsQryRow1=mysql_fetch_array($getAvatarsQryRs1))
					{
		  ?>
						<a href="#" onclick="return SelectAvatar(<? echo $getAvatarsQryRow1['id']?>);return false;"><img id="IMG_AVATAR_<? echo $getAvatarsQryRow1['id']?>" src="Avatars/<? echo $getAvatarsQryRow1['picture'];?>"  border="0" /></a>
				<? }?>
			  <? }?>
		  <? }?>
	  </div>
      <!-- end #right_column -->
    </div>
	<div id="bottom_border_newlife" >
      <p><h1 style="text-align:left">scroll through the avatars to see which one feels good. this is how other avatars will see you...</h1></p>
    </div>
	<div id="bottom_border_newlife" align="right" style="width:95%;max-width:95%;">
      <p align="right">PLEASE ENTER 0000 IF YOU DO NOT HAVE A AMBASSADOR CODE&nbsp;&nbsp;&nbsp;<br />AND YOUR EMAIL ADDRESS ONCE YOU HAVE CHOSEN YOUR AVATAR</p>
    </div>
  </div>
  <div align="right" style="padding-bottom:10px;">
	    <table border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" align="left" style="width:30%;vertical-align:top;"><img src="images/Daz3D001.jpg" /></td>
			<td valign="top" align="right" style="width:20%;vertical-align:top;"><img src="images/guru-icon-corner.jpg" /></td>
			<td valign="top" style="vertical-align:top;background-color:#5d4c46;width:50%;">
			<div id="login_box" style="padding-top:0px;margin-top:20px;margin:0 auto;padding-left:0px;" >
			  <div id="username" style="width:85%">CODE</div>
			  <div id="username_box" style="width:85%">
				  <label>
				  <input type="text" name="codee" id="codee" class="inputbox"  autocomplete="off" value="<?=$_POST["codee"]?>">
				  </label>
			  </div>
			  <br>
			  <div id="password" style="width:85%">EMAIL</div>
			  <div id="password_box" style="width:85%;">
				<label>
				<input type="text" name="email" id="email" class="inputbox"   autocomplete="off" value="<?=$_POST["email"]?>">
				</label>
			   </div>
			  <br />
				<input type="hidden" name="grp" id="grp" value="<?=$_REQUEST["grp"]?>"/>
				<input type="hidden" name="HidAvatar" id="HidAvatar" value="<?=$_POST["HidAvatar"]?>"/>
				<input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
				<input name="choose" type="submit" value="SUBMIT" ><br />
			</div>
		    </td>
		  </tr>
		</table>
  </div>
</form>
</div>
<script language="javascript">
function SelectAvatar(Aid)
{
	document.getElementById('HidAvatar').value=Aid;
	for(i=0;i<document.getElementsByTagName('img').length;i++)
	{
		var imgTag=document.getElementsByTagName('img')[i];
    	imgTag.style.border='0px';
		document.getElementById('IMG_AVATAR_'+Aid+'').style.width='100%';
	}
	document.getElementById('IMG_AVATAR_'+Aid+'').style.border='2px dotted #000000';
	document.getElementById('IMG_AVATAR_'+Aid+'').style.width='99%';
}

function frmcheck()
{
	form=document.frmselectavatar;
	if(document.getElementById('HidAvatar').value=='')
	{
		alert("Please select avatar.");
		return false;
	}
	if(form.codee.value=="")
	{
		alert("Please enter code.")
		form.codee.focus();
		return false;
	} 
	if(form.email.value=="")
	{
		alert("Please enter your email address.")
		form.email.focus();
		return false;
	}
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.email.value)))
	{
		alert("Please enter a proper email address.");
		form.email.focus();
		return false;
	}  
	document.frmselectavatar.HidRegUser.value='1';
	//document.frmselectavatar.submit();
	return true;    
}

</script>
<? include("googleanalytic.php");?>
</body>
</html>