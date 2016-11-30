<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
//include("fckeditor/fckeditor.php") ;
$mlevel=3;
$Message="";

if(isset($_POST['Submit']))
{
   if($_GET['id'])
   {
		$sql="UPDATE options_group_values SET 
				name='".addslashes($_POST["name"])."',
				groupid='".addslashes($_POST["groupid"])."' where id='".trim($_GET['id'])."'";	
		$q=mysql_query($sql);
		
		header("location:manage_option_group_values.php?msgs=3");
		exit;
	}
	else
	{
		$sql="INSERT INTO options_group_values SET 
				name='".addslashes($_POST["name"])."',
				groupid='".addslashes($_POST["groupid"])."'";	
		$q=mysql_query($sql);
		$insertedid=mysql_insert_id();
		
		header("location:manage_option_group_values.php?msgs=1");
		exit;
	}		
}

if($_GET['id'])
{
	$Buttitle="Save changes";
	$SEL="SELECT * from options_group_values where id='".$_GET['id']."'";
	$SELRs=mysql_query($SEL);
	$ROW=mysql_fetch_object($SELRs);
}
else
{
	$Buttitle="Add";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet />
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<script language=javascript src="body.js"></script>
<link rel="stylesheet" href="dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="dhtmlgoodies_calendar.js?random=20060118"></script>
<script language="javascript" type="text/javascript">
function valid()
{
	form=document.addprod;
	
	if(form.name.value.split(" ").join("")=="")
	{
		alert("Please enter value.");
		form.name.focus();
		return false;
	}	
	
	else
	{
		return  true;	
	}	
}
</script>
<table align="left" width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellspacing="0" cellpadding="0" width="100%" border=0>
        <tbody >
          <tr>
            <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                <tr>
                  <td height="35" class="form111"><? if($_GET['id']){?>Edit<? } else {?>Add<? } ?> Options Group Value</td>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top">
				  	<form name="addprod" id="addprod"  method="post" enctype="multipart/form-data" action="#">
                      <table cellspacing="2" cellpadding="2" width=98% border="0" class="t-b">
                        <tr>
                          <td class="a" align="right" colspan="4">*= Required Information</td>
                        </tr>
                        <? if($Message){?>
                        <tr>
                          <td class="a" align="center" colspan="4"><?=$Message;?>
                            &nbsp;</td>
                        </tr>
                        <? }?>
						<tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a">*</span> Option Group:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top">
						  <select name="groupid" id="groupid" style="width:250px;" class="solidinput">
							  <?=GetDropdown(id,name,"options_group",' where 1=1 order by name asc',stripslashes($ROW->groupid));?>
						   </select>
						  </td>
                        </tr>
                        <tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a">*</span> Option Value:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="name" id="name" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->name));?>" type="text"  class="solidinput"></td>
                        </tr>
					
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td width="81%" colspan="3"><INPUT type=submit name="Submit" value="<? echo $Buttitle;?>" onClick="return valid();" class="bttn-s">                          </td>
                        </tr>
                      </table>
                    </form></td>
                </tr>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>
</html>