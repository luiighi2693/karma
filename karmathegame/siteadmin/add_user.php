<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=2;
$Message="";
//if($ADMIN_TOP_customers_A!="Y"){header("location:inner.php");exit;}

if($_REQUEST['del']!="")
{
	$qrr=$_REQUEST['del'].'= \'\'' ;
	$sql=mysql_query("UPDATE users SET picture='' where id='".trim($_GET['id'])."'");	
	header("location:add_user.php?id=".$_REQUEST['id']);
	exit;
}
if($_POST['SubmitUser'])
{
	if($_REQUEST['id']!='')
	{
		
			$InsertUserQry="UPDATE users set
			  					  firstname='".addslashes($_POST['firstname'])."',
								  username='".addslashes($_POST['username'])."',
								  lastname='".addslashes($_POST['lastname'])."',
								  email='".addslashes($_POST['email'])."',
								  password='".$_POST['password']."',
								  gender='".$_POST['gender']."',
								  country='".addslashes($_POST['country'])."',
								  city='".addslashes($_POST['city'])."',
								  aboutme='".addslashes($_POST['aboutme'])."',
								  phone='".addslashes($_POST['phone'])."',
								  active='".addslashes($_POST['active'])."' WHERE id='".$_REQUEST['id']."'";
			$InsertUserQryRs=mysql_query($InsertUserQry);
			$InsertId=$_REQUEST['id'];
			
			if($_FILES["picture"]['tmp_name'])
			{
				 $file=$_FILES["picture"];	
				 $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);		
				 $filename1=rand().$send_name1;		
				 $filetoupload=$file['tmp_name'];				 
				 $path="../Users/".$filename1; 
				 copy($filetoupload,$path);
				 $extsql2=",picture='$filename1'";
				 
				
					$AddUserQry="UPDATE users SET picture='$filename1' WHERE id='".$InsertId."'";	 
					$AddUserQryRs=mysql_query($AddUserQry);
			}
			
			header("location:manage_user.php?msgs=3");
			exit;
		
	}
	else
	{
		
			$InsertUserQry="INSERT INTO users set 
								  firstname='".addslashes($_POST['firstname'])."',
								  lastname='".addslashes($_POST['lastname'])."',
								  username='".addslashes($_POST['username'])."',
								  email='".addslashes($_POST['email'])."',
								  password='".$_POST['password']."',
								  gender='".$_POST['gender']."',
								  country='".addslashes($_POST['country'])."',
								  city='".addslashes($_POST['city'])."',
								  active='".addslashes($active)."',
								  aboutme='".addslashes($_POST['aboutme'])."',
								  phone='".addslashes($_POST['phone'])."',
								  regdate=now()";
			$InsertUserQryRs=mysql_query($InsertUserQry);
			$InsertId=mysql_insert_id();
			
			if($_FILES["picture"]['tmp_name'])
			{
				 $file=$_FILES["picture"];	
				 $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);		
				 $filename1=rand().$send_name1;		
				 $filetoupload=$file['tmp_name'];				 
				 $path="../Users/".$filename1; 
				 copy($filetoupload,$path);
				 $extsql2=",picture='$filename1'";
			 
				$AddUserQry="UPDATE users SET picture='$filename1' WHERE id='".$InsertId."'";	 
				$AddUserQryRs=mysql_query($AddUserQry);
			}
			header("location:manage_user.php?msgs=1");
			exit;
		
	}		
}
if($_GET['id'])
{
	$SelUserQry="SELECT * FROM users WHERE id='".$_GET['id']."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	$SelUserQryRow=mysql_fetch_array($SelUserQryRs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet />
</head>
<script src="ajax_validation.js" type="text/javascript"></script>
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
                    <? } ?>
                    Customer </td>
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
                              <td width="20%" height="25" align="left" class="black12"><strong>First Name:</strong></td>
                              <td width="80%"><input type="text" name="firstname" id="firstname" value="<?=stripslashes($SelUserQryRow['firstname']);?>" class="solidinput" />
                                &nbsp;<span class="a"></span></td>
                            </tr>
                            <tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Last Name:</strong></td>
                              <td width="80%"><input type="text" name="lastname" id="lastname" value="<?=stripslashes($SelUserQryRow['lastname']);?>" class="solidinput"/>
                                &nbsp;<span class="a"></span></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>User Name:</strong></td>
                              <td width="80%"><input type="text" name="username" id="username" value="<?=stripslashes($SelUserQryRow['username']);?>" class="solidinput"/>
                                &nbsp;<span class="a"></span></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Code:</strong></td>
                              <td width="80%"><input type="text" name="marketer" id="marketer" value="<?=stripslashes($SelUserQryRow['marketer']);?>" class="solidinput"/>
                                &nbsp;<span class="a"></span></td>
                            </tr>
                            <tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Email:</strong></td>
                              <td width="80%"><input type="text" name="email" id="email" value="<?=stripslashes($SelUserQryRow['email']);?>" class="solidinput" style="width:250px;"/>
                                &nbsp;<span class="a">*</span> </td>
                            </tr>
                            <tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Password:</strong></td>
                              <td width="80%"><input type="password" name="password" id="password" value="<?=stripslashes($SelUserQryRow['password']);?>"  class="solidinput"/>
                                &nbsp;(minimum 5 characters)<span class="a">*</span></td>
                            </tr>
                            <?php /*?><tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Gender:</strong></td>
                              <td width="80%"><input type="radio" name="gender" <? if($SelUserQryRow['gender']=="Female"){echo "checked";}?> value="Female">Female&nbsp;&nbsp;<input type="radio" name="gender" <? if($SelUserQryRow['gender']=="Male"){echo "checked";}?> value="Male">Male&nbsp;&nbsp;<input type="radio" name="gender" value="Rather not say" <? if($SelUserQryRow['gender']=="Rather not say"){echo "checked";}?> >Rather not say&nbsp;&nbsp; </td>
                            </tr><?php */?>
                            <?php /*?><tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Country:</strong></td>
                              <td width="80%"><? if($_REQUEST['id']==""){$Country="USA";}else{$Country=stripslashes($SelUserQryRow['country']);}?>
                                <select name="country" id="country" style="width:250px;" class="solidinput">
                                  <option value="">Select Country</option>
                                  <?=GetDropdown(country_name,country_name,country,' where 1=1 order by country_name asc',stripslashes($Country));?>
                                </select></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>City:</strong></td>
                              <td width="80%"><input type="text" name="city" id="city" value="<?=stripslashes($SelUserQryRow['city']);?>" class="solidinput" style="width:250px;"/></td>
                            </tr><?php */?>
                            <tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Phone:</strong></td>
                              <td width="80%"><input type="text" name="phone" id="phone" value="<?=stripslashes($SelUserQryRow['phone']);?>" class="solidinput" style="width:250px;"/></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="left" class="black12" valign="top"><strong>About Me:</strong></td>
                              <td width="80%"><textarea name="aboutme" id="aboutme"  class="solidinput" style="width:250px;height:100px;"><?=stripslashes($SelUserQryRow['aboutme']);?></textarea></td>
                            </tr>
							
							<tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Profile Picture:</strong></td>
                              <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                            </tr>
							<? if($SelUserQryRow['picture']!="" && file_exists("../Users/".$SelUserQryRow['picture'])){?>
							<tr>
								<td align="right" valign="middle">&nbsp;</td>
								<td  align="left" valign="top" style="padding-bottom:5px;"> <? if($SelUserQryRow['picture']!="" && file_exists("../Users/".$SelUserQryRow['picture'])){?><img src="../Users/<?=$SelUserQryRow['picture'];?>"  width="100"/>&nbsp;<br><br><a href="add_user.php?del=image&id=<?=trim($_REQUEST['id']);?>">Delete Current Image</a><? } ?></td>
							</tr>
					 	  <? } ?>
						<input type="hidden" name="image_old" id="image_old" value="<?=$ROW->image;?>" />
                            <tr>
                              <td width="20%" height="25" align="left" class="black12"><strong>Active Customer:</strong></td>
                              <td width="80%"><input type="checkbox" name="active" id="active" value="Y" class="solidinput" <? if($SelUserQryRow['active']=="Y"){echo "checked";}?>/>
                                Yes</td>
                            </tr>
                      </table>
                        <input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Customer";} else { echo "Add Customer";}?>" onClick="return FrmChkRegister();" class="bttn-s">
                        <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_user.php'" class="bttn-s">
                       
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
	
	if(form.email.value.split(" ").join("")=="")
	{
		alert("Please enter email address.");
		form.email.focus();
		return false;
	}
	if(form.email.value!="")
	{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value)))
		{
				alert("Please enter a proper email address.");
				form.email.focus();
				return false;
		}
	}
	if(form.password.value.split(" ").join("")=="")
	{
		alert("Please enter password.");
		form.password.select();
		form.password.focus();
		return false;
	}
	if(form.password.value.length<5)
	{
		alert("Password must be minimum 5 character.");
		form.password.focus();
		return false;
	}
	
	
	return true;
}	
</script>
</body>
</html>