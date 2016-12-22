<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=8;
$Message="";
if($_REQUEST['del']!="")
{
    $qrr=$_REQUEST['del'].'= \'\'' ;
    $sql=mysql_query("UPDATE backgrounds SET img='' where id='".trim($_GET['id'])."'");
    header("location:add_backgrounds.php?id=".$_REQUEST['id']);
    exit;
}

if($_POST['SubmitUser'])
{
    if($_REQUEST['id']!='')
    {
//        $InsertUserQry="UPDATE ideas set
//					  startdate='".addslashes($startdate)."',
//					  enddate='".addslashes($enddate)."',
//					  title='".addslashes($_POST['title'])."',
//					  description='".addslashes($_POST['description'])."',
//					  place='".addslashes($_POST['place'])."',
//					  email='".addslashes($_POST['email'])."',
//					  link='".addslashes($_POST['link'])."',
//					  groupid='".addslashes($_POST['groupid'])."',
//					  ambassador='".addslashes($_POST['ambassador'])."',
//					  location_id='".addslashes($_POST['location_id'])."',
//					  cost='".addslashes(str_replace("$","",$_POST['cost']))."'
//					  WHERE id='".$_REQUEST['id']."'";
//        $InsertUserQryRs=mysql_query($InsertUserQry);

        $InsertId=$_REQUEST['id'];

        if($_FILES["picture"]['tmp_name'])
        {
            $file=$_FILES["picture"];
            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
            $filename1=rand().$send_name1;
            $filetoupload=$file['tmp_name'];
            $path="../backgrounds/".$filename1;
            copy($filetoupload,$path);
            $extsql2=",picture='$filename1'";

            $AddUserQry="UPDATE backgrounds SET img='$filename1' WHERE id='".$InsertId."'";
            $AddUserQryRs=mysql_query($AddUserQry);
        }

        header("location:manage_backgrounds.php?msgs=3");
        exit;
    }
    else
    {
//        $InsertUserQry="INSERT INTO ideas set
//					  startdate='".addslashes($startdate)."',
//					  enddate='".addslashes($enddate)."',
//					  title='".addslashes($_POST['title'])."',
//					  description='".addslashes($_POST['description'])."',
//					  place='".addslashes($_POST['place'])."',
//					  email='".addslashes($_POST['email'])."',
//					  link='".addslashes($_POST['link'])."',
//					  groupid='".addslashes($_POST['groupid'])."',
//					  ambassador='".addslashes($_POST['ambassador'])."',
//					  location_id='".addslashes($_POST['location_id'])."',
//					  cost='".addslashes(str_replace("$","",$_POST['cost']))."',
//					  addeddate=now()";
//        $InsertUserQryRs=mysql_query($InsertUserQry);
//        $InsertId=mysql_insert_id();

        if($_FILES["picture"]['tmp_name'])
        {
            $file=$_FILES["picture"];
            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
            $filename1=rand().$send_name1;
            $filetoupload=$file['tmp_name'];
            $path="../backgrounds/".$filename1;
            copy($filetoupload,$path);
            $extsql2=",picture='$filename1'";

            $AddUserQry="INSERT INTO backgrounds SET img='$filename1'";
            $AddUserQryRs=mysql_query($AddUserQry);
        }

        header("location:manage_backgrounds.php?msgs=1");
        exit;
    }
}
if($_GET['id'])
{
    $SelUserQry="SELECT * FROM backgrounds WHERE id='".$_GET['id']."'";
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
                                    <? } ?> Background</td>
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
                                                <td width="20%" height="25" align="right" class="black12"><strong>Picture:</strong></td>
                                                <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                                            </tr>
                                            <? if($SelUserQryRow['img']!="" && file_exists("../backgrounds/".$SelUserQryRow['img'])){?>
                                                <tr>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                    <td  align="left" valign="top" style="padding-bottom:5px;"> <? if($SelUserQryRow['img']!="" && file_exists("../backgrounds/".$SelUserQryRow['img'])){?><img src="../backgrounds/<?=$SelUserQryRow['img'];?>"  width="100"/>&nbsp;<br><br><a href="add_backgrounds.php?del=picture&id=<?=trim($_REQUEST['id']);?>">Delete Current Image</a><? } ?></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="20%" height="25" align="right" class="black12">&nbsp;</td>
                                                <td width="80%"><input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Background";} else { echo "Add Background";}?>" onClick="return FrmChkRegister();" class="bttn-s">
                                                    <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_backgrounds.php'" class="bttn-s"></td>
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


        if(form.startdate.value=="")
        {
            alert("Please select start date.");
            form.startdate.focus();
            return false;
        }
        if(form.enddate.value=="")
        {
            alert("Please select end date.");
            form.enddate.focus();
            return false;
        }
        if(form.title.value.split(" ").join("")=="")
        {
            alert("Please enter title.");
            form.title.focus();
            return false;
        }
        if(form.place.value.split(" ").join("")=="")
        {
            alert("Please enter place.");
            form.place.focus();
            return false;
        }
        if(form.cost.value.split(" ").join("")=="")
        {
            alert("Please enter cost.");
            form.cost.focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>