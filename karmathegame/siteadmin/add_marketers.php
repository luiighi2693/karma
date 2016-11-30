<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=55;
$Message="";

if(isset($_POST['Submit']))
{
   if($_GET['id'])
   {
		$sql="UPDATE marketers SET 
		firstname='".addslashes($_POST["firstname"])."',
		lastname='".addslashes($_POST["lastname"])."',
		password='".addslashes($_POST["password"])."',
		email='".addslashes($_POST["email"])."',
		phone='".addslashes($_POST["phone"])."',  
		amb_tagline='".addslashes($_POST["amb_tagline"])."',  
		location_id='".addslashes($_POST["location_id"])."',  
		about01='".addslashes($_POST["about01"])."'  
		where id='".trim($_GET['id'])."'";
		$q=mysql_query($sql);

       $InsertId=$_REQUEST['id'];

       if($_FILES["picture"]['tmp_name']){
           $file=$_FILES["picture"];
           $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
           $filename1=rand().$send_name1;
           $filetoupload=$file['tmp_name'];
           $path="../ambassador/".$filename1;
           copy($filetoupload,$path);
           $extsql2=",picture='$filename1'";

           $AddPicturesQry="UPDATE marketers SET amb_picture_main='$filename1' WHERE id='".$InsertId."'";
           $AddPicturesQryRs=mysql_query($AddPicturesQry);
       }
		
		header("location:manage_marketers.php?msgs=3");
		exit;
	}
	else
	{
		$sql="INSERT INTO marketers SET 
		firstname='".addslashes($_POST["firstname"])."',
		lastname='".addslashes($_POST["lastname"])."',
		password='".addslashes($_POST["password"])."',
		email='".addslashes($_POST["email"])."',
		phone='".addslashes($_POST["phone"])."',
		amb_tagline='".addslashes($_POST["amb_tagline"])."',
		location_id='".addslashes($_POST["location_id"])."',
		about01='".addslashes($_POST["about01"])."',
		addeddate=now()";
		$q=mysql_query($sql);
		$insertedid=mysql_insert_id();

        if($_FILES["picture"]['tmp_name']){
            $file=$_FILES["picture"];
            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
            $filename1=rand().$send_name1;
            $filetoupload=$file['tmp_name'];
            $path="../ambassador/".$filename1;
            copy($filetoupload,$path);
            $extsql2=",picture='$filename1'";

            $AddUserQry="UPDATE Amb_pictures SET picture='$filename1' WHERE id='".$insertedid."'";
            $AddUserQryRs=mysql_query($AddUserQry);
        }
		
		$marketercode="MRKTR".$insertedid;
		
		$sql="UPDATE marketers SET code='".addslashes($marketercode)."' where id='".trim($insertedid)."'";	
		$q=mysql_query($sql);
		
		header("location:manage_marketers.php?msgs=1");
		exit;
	}		
}

if($_GET['id'])
{
	$Buttitle="Save changes";
	$SEL="SELECT * from marketers where id='".$_GET['id']."'";
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
<script language="javascript" type="text/javascript">
function valid()
{
	form=document.addprod;
	
	if(form.firstname.value.split(" ").join("")=="")
	{
		alert("Please enter full name.");
		form.firstname.focus();
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
                  <td height="35" class="form111"><? if($_GET['id']){?>Edit<? } else {?>Add<? } ?> Marketer</td>
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
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a">*</span> Full Name:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="firstname" id="firstname" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->firstname));?>" type="text"  class="solidinput"></td>
                        </tr><?php /*?>
						<tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> Last Name:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="lastname" id="lastname" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->lastname));?>" type="text"  class="solidinput"></td>
                        </tr><?php */?>
						<tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> Email:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="email" id="email" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->email));?>" type="text"  class="solidinput"></td>
                        </tr>
						<tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> Password:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="password" id="password" style="width:450px;"  value="<? echo (stripslashes($ROW->password));?>" type="text"  class="solidinput"></td>
                        </tr>
						<tr>
                          <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> Phone:&nbsp;</strong></td>
                          <td height="25" colspan="3" valign="top"><input name="phone" id="phone" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->phone));?>" type="text"  class="solidinput"></td>
                        </tr>
                          <tr>
                              <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> amb_tagline:&nbsp;</strong></td>
                              <td height="25" colspan="3" valign="top"><input name="amb_tagline" id="amb_tagline" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->amb_tagline));?>" type="text"  class="solidinput"></td>
                          </tr>
                          <tr>
                              <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> location_id:&nbsp;</strong></td>
                      
                               <td height="25" colspan="3" valign="top">
                               <select name="location_id" id="location_id" style="width:250px;" class="solidinput">
				
							  		<option value="0" <? if($ROW->location_id=="" || $_REQUEST['id']==''){ echo "selected";}?>>The Whole World</option>
								  <?=GetDropdown(id,name,"options_group_values",' where 1=1 and groupid=14 order by name asc',stripslashes(htmlentities($ROW->location_id)));?>
					</select>	
				</td>		
                              
                          </tr>
                          <tr>
                              <td width="19%" height="25" align="right" valign="top"><strong><span class="a"></span> about01:&nbsp;</strong></td>
                              <td height="25" colspan="3" valign="top"><input name="about01" id="about01" style="width:450px;"  value="<? echo htmlentities(stripslashes($ROW->about01));?>" type="text"  class="solidinput"></td>
                          </tr>
                           <tr>
                                                <td width="20%" height="25" align="right" class="black12"><strong>Picture:</strong></td>
                                                <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                                            </tr>
                                            <? if(htmlentities(stripslashes($ROW->amb_picture_main))!="" && file_exists("../ambassador/".htmlentities(stripslashes($ROW->amb_picture_main)))){?>
                                                <tr>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                    <td  align="left" valign="top" style="padding-bottom:5px;"> <? if(htmlentities(stripslashes($ROW->amb_picture_main))!="" && file_exists("../ambassador/".htmlentities(stripslashes($ROW->amb_picture_main)))){?><img src="../ambassador/<?=htmlentities(stripslashes($ROW->amb_picture_main));?>"  width="100"/>&nbsp;<br><br><a href="add_marketers.php?del=amb_pic_main&id=<?=trim($_REQUEST['id']);?>">Delete Current Image</a><? } ?></td>
                                                </tr>|
                                            <? } ?>
                          
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