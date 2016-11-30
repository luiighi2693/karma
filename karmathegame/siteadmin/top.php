<?
$username= $_COOKIE["UsErOfAdMiN"];
$userid=$_COOKIE["UsErId"];

if (!isset($userid))
{
	header("location:index.php");
}
?>
<link href="css/biz.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
function mmLoadMenus() {
  if (window.mm_menu_1229121137_0) return;
  window.mm_menu_1229121137_0 = new Menu("root",125,20,"Tahoma",11,"#000000","#000000","#F6F6F6","#FFFFFF","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
  mm_menu_1229121137_0.addMenuItem("Archieve","location='inner_archieve.php'");
  mm_menu_1229121137_0.addMenuItem("Folders","location='folder_mng.php'");
  mm_menu_1229121137_0.addMenuItem("Mails","location='admin_mails.php'");
 mm_menu_1229121137_0.hideOnMouseOut=true;
   mm_menu_1229121137_0.bgColor='#C5C5C5';
   mm_menu_1229121137_0.menuBorder=1;
   mm_menu_1229121137_0.menuLiteBgColor='#FFFFFF';
   mm_menu_1229121137_0.menuBorderBgColor='#C5C5C5';
mm_menu_1229121137_0.writeMenus();
} 
</script>
<script language="JavaScript" src="js/mm_menu.js"></script>
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td height="70" valign="top" style="background-color:#000000;"><table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="77%"><table width="94%" height="68" border="0">
			<tr>
			  <td valign="middle"><a href="inner.php" style="color:#FFFFFF;font-size:22px;text-decoration:none"><strong >Karma-Game of Destiny</strong></a></td>
			</tr>
		  </table></td>
		<td width="23%" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" background="images/login/topmenubg.jpg" class="greybdr">
		  <tr>
			<td width="52%" height="28" align="center" class="greyrightbdr"><strong>Welcome</strong> <? echo ucfirst($username); ?> </td>
			 <td width="48%" valign="bottom" align="center"><a href="logout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','images/login/logour-hover.jpg',1)"><img src="images/login/logour.jpg" name="Image6" width="50" height="24" border="0" id="Image6" /></a></td>
		  </tr>
		</table></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td height="46" valign="top" class="menubg2">
		<? include('top_admin.php');?>
	</td>
  </tr>
  <tr>
	<td height="10" valign="top"></td>
  </tr>
</table>