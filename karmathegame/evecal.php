<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/style.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
<script language="javascript" src="popup_fun.js?rnd=<? echo rand();?>"></script>
<script language="javascript" src="ajax_validation.js?rnd=<? echo rand();?>"></script>
</head>
<body style="text-align:center;">
<div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
					
<script language="javascript">
function hide_pop()
{
	window.parent.hide_pop();
} 
var xmlHttp111;
function GetXmlHttpObject1()
{ 
var objXMLHttp=null
if (window.XMLHttpRequest)
{
objXMLHttp=new XMLHttpRequest()
}
else if (window.ActiveXObject)
{
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
}
return objXMLHttp
}
function Get_Result111(divname,yr,mn,pg)
{
	document.getElementById("caltdd").innerHTML="<img src='images/loading.gif' alt='Loading...'>";
	xmlHttp111=GetXmlHttpObject1();
	if (xmlHttp111==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	} 
	var url="<?=$SITE_URL;?>/getcalander.php?<?=$AjxUrls;?>div="+divname+"&yr="+yr+"&mn="+mn+"&pg="+pg;
	xmlHttp111.onreadystatechange=stateSubChanged111;
	xmlHttp111.open("GET",url,true);
	xmlHttp111.send(null);
} 
function stateSubChanged111() 
{ 	
	if (xmlHttp111.readyState==4)
	{ 		
		document.getElementById("caltdd").innerHTML=xmlHttp111.responseText;
	}
}
function Get_Dateet(dtttt)
{
	document.bokkfrm.day.value=dtttt;document.bokkfrm.submit();
}
</script>
<?
if($_GET["sdate"]!="")
{
	$mmm=date("m",strtotime($_GET["sdate"]));$yyy=date("Y",strtotime($_GET["sdate"]));$ddd=date("d",strtotime($_GET["sdate"]));
}
else
{
	$mmm=date("m");$yyy=date("Y");$ddd=date("d");
}
?>
<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
		  <tr>
			<td class="bottmborder_white">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="8%" align="left"><img src="images/icon6.jpg" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">CALENDAR</h1></td>
					<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
				  </tr>
				</table>
			</td>
		  </tr>
		 
		  <tr>
          <td width="100%" height="230" align="left" valign="top" id="caltdd"><script language="javascript">Get_Result111('user_all','<?=$yyy;?>','<?=$mmm;?>','<?=$ddd;?>');</script></td>
        </tr>
		</table>
	</td>
  </tr>
</table>
</div>
</body>
</html>