<? include("connect.php");
$TOPCONDENSE="YES";
include("checklogin.php");
if($_POST['HidRegUser']=="1")
{
	$_SESSION['LIVESID']=$_POST['lives'];
	if($AUTHORIZEACTIVE=='Y')
	{
		header("location:payment.php");
		exit;
	}
	else
	{
		header("location:payment_passed.php");
		exit;
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
  	<div id="pad_newlife_fullwidth">
		<form name="frmselectlives" id="frmselectlives" enctype="multipart/form-data" method="post">
		<div id="">
		  <p align="center" style="padding-top:50px;text-align:center;">
		  	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="">
			  <tr>
			  	<td colspan="2" align="center">
					<table width="700" border="0" cellspacing="0" cellpadding="0" >
					  <tr>
						<td valign="top" style="vertical-align:top;width:205px;"  align="left">
						<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
							<img src="Avatars/<? echo $avatarlogo;?>" width="200" height="190" />
						<? }?>
						</td>
						<td valign="top" style="vertical-align:top;" align="left">
							<div>
							  <div id="username" style="width:92%;">CODE</div>
							  <div id="username_box" style="width:92%;">
								  <label>
								  <input type="text"  readonly="true" name="codee" id="codee" class="inputbox" placeholder="CODE" autocomplete="off" value="<?=stripslashes($CURRENTgetuserwryRow['couponcode']);?>">
								  </label>
							  </div>
							  <br>
							  <div id="password" style="width:92%;">PASSWORD</div>
							  <div id="password_box" style="width:92%;">
								<label>
								<input type="text" readonly="true"  name="passwordd" id="passwordd" class="inputbox" placeholder="PASSWORD" autocomplete="off" value="<?=stripslashes($CURRENTgetuserwryRow['password']);?>">
								</label>
							   </div>
							</div>
						</td>
					  </tr>
					</table>
				</td>
			  </tr>
			  
			  <tr>
				<td colspan="2" align="left" style="padding:20px;">
					<div id="mbook" style="width:700px;">
						<?
							$LIVES=0;
							$getLivesQryRs=mysql_query("SELECT * FROM lifes where  	active='Y' order by id asc  ");
							$TotgetLives=mysql_affected_rows();
							if($TotgetLives>0)
							{
								while($getLivesQryRow=mysql_fetch_array($getLivesQryRs))
								{
									$LIVES++;
									?>
										<div id="left_column" class="left_column" style="cursor:pointer;" onclick="SelectLife(<? echo $getLivesQryRow['id'];?>);">
											<div id="left_button" class="left_button" style="background-color:#FFFFFF;border:2px solid #0099FF;color:#0099FF;">
												<b style="font-weight:bold;"><? echo $getLivesQryRow['totallives'];?> <? if($getLivesQryRow['totallives']<=1){?>LIFE<? }else{?>LIVES<? }?></b>
												<br /><br />
												$<? echo $getLivesQryRow['amount'];?>
											</div>
											<div align="center"><input type="radio" id="RADIOOBUTTON_<? echo $getLivesQryRow['id'];?>"  name="lives" <? if($LIVES==$TotgetLives){echo "checked";}?>  value="<? echo $getLivesQryRow['id'];?>" /></div>
										</div>	
									<?
								}
							}	
					    ?>
						</div>
				</td>
			  </tr>
			  <tr><td colspan="2" align="center" height="50" valign="top">
			  <input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
			  <input name="choose" type="submit" value="SUBMIT" onClick="return frmcheck();"></td></tr>
			</table>
		  </p>
		</div>
		</form>
		
		<div id="bottom_border_newlife" >
		  <h1>I'll give you 30 Days, all the toold and 1, 6 or 9 lives to find your soulmates... the rest is up to you...</h1>
		</div>
	</div>
	<div align="right" style="padding-bottom:10px;"><img src="images/guru-icon-corner.jpg" /></div>
	
</div>
<script language="javascript">
function SelectLife(cur)
{
	document.getElementById('RADIOOBUTTON_'+cur+'').checked=true;
}
function frmcheck()
{
	form=document.frmselectlives;
	document.frmselectlives.HidRegUser.value='1';
	//document.frmselectavatar.submit();
	return true;    
}

</script>
<? include("googleanalytic.php");?>
</body>
</html>