<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=9;
$Message="";
if($_REQUEST['del']!="")
{
	$qrr=$_REQUEST['del'].'= \'\'' ;
	$sql=mysql_query("UPDATE torb_questions SET torb_question='' where id='".trim($_GET['id'])."'");	
	header("location:add_truth.php?id=".$_REQUEST['id']);
	exit;
}

if($_POST['SubmitUser'])
{
	
	if($_REQUEST['id']!='')
	{
		$InsertUserQry="UPDATE torb_questions set 
					  groupid='".addslashes($_POST['groupid'])."',
					  torb_question='".addslashes($_POST['torb_question'])."' 
					  WHERE id='".$_REQUEST['id']."'";
		$InsertUserQryRs=mysql_query($InsertUserQry);
		
		$InsertId=$_REQUEST['id'];
		
		header("location:manage_truth.php?msgs=3");
		exit;
	}
	else
	{
		$InsertUserQry="INSERT INTO torb_questions set 
					   groupid='".addslashes($_POST['groupid'])."',
					  torb_question='".addslashes($_POST['torb_question'])."'";
		$InsertUserQryRs=mysql_query($InsertUserQry);
		$InsertId=mysql_insert_id();
		
		header("location:manage_truth.php?msgs=1");
		exit;
	}		
}
if($_GET['id'])
{
	$SelUserQry="SELECT * FROM torb_questions WHERE id='".$_GET['id']."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	$SelUserQryRow=mysql_fetch_array($SelUserQryRs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
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
                  <td height="35" class="form111"><? if($_GET['id']){?>
                    Edit
                    <? } else {?>
                    Add
                    <? } ?> Truth</td>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="FrmRegister" id="FrmRegister" action="#" method="post" enctype="multipart/form-data" onSubmit="return FrmChkRegister();">
                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="t-b" >
                            <? if($message!=''){?>
                            <tr>
                              <td align="center" class="a" colspan="2"><? echo $message;?></td>
                            </tr>
                            <? }?>
                            <tr>
                              <td align="right" colspan="2"><span class="a">*</span> Required field</td>
                            </tr>
                            <tr>
							  <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span>Category:&nbsp;</strong></td>
							  <td height="25" colspan="3" valign="top">
							  <select name="groupid" id="groupid" style="width:250px;" class="solidinput">
							  		<option value="0" <? if($SelUserQryRow['groupid']=="0" || $_REQUEST['id']==''){ echo "selected";}?>>--Pick an Option</option>
								  <?=GetDropdown(id,name,"groups",' where 1=1 order by name asc',stripslashes($SelUserQryRow['groupid']));?>
							   </select>
							  </td>
							</tr>
							<tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> Torb Question:</strong></td>
                              <td width="80%"><input type="text" name="torb_question" id="torb_question" value="<?=stripslashes($SelUserQryRow['torb_question']);?>" class="solidinput" style="width:600px;" /></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="right" class="black12">&nbsp;</td>
                              <td width="80%"><input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Truth";} else { echo "Add Truth";}?>" onClick="return FrmChkRegister();" class="bttn-s">
							  <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_truth.php'" class="bttn-s"></td>
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
<script language="javascript" type="text/javascript">
function FrmChkRegister()
{
	var form=document.FrmRegister;
	
	
	if(form.groupid.options[form.groupid.selectedIndex].value=="0")
	{
		alert("Please enter group id.");
		form.groupid.focus();
		return false;
	}
	if(form.torb_question.value.split(" ").join("")=="")
	{
		alert("Please enter a torb question.");
		form.torb_question.focus();
		return false;
	}
	return true;
}	
</script>
</body>
</html>