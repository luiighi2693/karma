<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=10;
$Message="";
if($_REQUEST['del']!="")
{
    $qrr=$_REQUEST['del'].'= \'\'' ;
    $sql=mysql_query("UPDATE anim_loops SET animname='' where id='".trim($_GET['id'])."'");
    header("location:add_anim_loops.php?id=".$_REQUEST['id']);
    exit;
}

if($_POST['SubmitUser'])
{
    if($_REQUEST['id']!='')
    {
        $InsertUserQry="UPDATE anim_loops set
					  position='".addslashes($_POST['position'])."',
					  info='".addslashes($_POST['info'])."' 
					  WHERE id='".$_REQUEST['id']."'";
        $InsertUserQryRs=mysql_query($InsertUserQry);

        if($_FILES["picture"]['tmp_name']) {
            $file = $_FILES["picture"];
//            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
//            $filename1=rand().$send_name1;
            $filename1 = $_POST['animname'];
            $filetoupload = $file['tmp_name'];
            $path = "../anim_backgrounds/" . $filename1;
            copy($filetoupload, $path);
        }else{
            $SelUserQry="SELECT * FROM anim_loops WHERE id='".$_REQUEST['id']."'";
            $SelUserQryRs=mysql_query($SelUserQry);
            $SelUserQryRow=mysql_fetch_array($SelUserQryRs);
            $filename1 = $_POST['animname'];
            rename("../anim_backgrounds/" . $SelUserQryRow['animname'], "../anim_backgrounds/" .$filename1);
        }

        $AddUserQry2="UPDATE anim_loops SET animname='$filename1' WHERE id='".$_REQUEST['id']."'";
        $AddUserQryRs2=mysql_query($AddUserQry2);

        header("location:manage_anim_loops.php?msgs=3");
        exit;
    }
    else
    {
        $InsertUserQry="INSERT INTO anim_loops set
					 animname='".addslashes($_POST['animname'])."',
					  position='".addslashes($_POST['position'])."',
					  info='".addslashes($_POST['info'])."'";
        $InsertUserQryRs=mysql_query($InsertUserQry);
        $InsertId=mysql_insert_id();

        if($_FILES["picture"]['tmp_name'])
        {
            $file=$_FILES["picture"];
//            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
//            $filename1=rand().$send_name1;
            $filename1 = $_POST['animname'];
            $filetoupload=$file['tmp_name'];
            $path="../anim_backgrounds/".$filename1;
            copy($filetoupload,$path);

            $AddUserQry2="UPDATE anim_loops SET animname='$filename1' WHERE id='".$InsertId."'";
            $AddUserQryRs2=mysql_query($AddUserQry2);
        }

        header("location:manage_anim_loops.php?msgs=1");
        exit;
    }
}
if($_GET['id'])
{
    $SelUserQry="SELECT * FROM anim_loops WHERE id='".$_GET['id']."'";
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
                                    <? } ?> Anim Loop</td>
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
<!--                                            <tr>-->
<!--                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> animname:</strong></td>-->
<!--                                                <td width="80%"><input type="text" name="animname" id="animname" value="--><?//=stripslashes($SelUserQryRow['animname']);?><!--" class="solidinput" style="width:600px;" /></td>-->
<!--                                            </tr>-->
                                            <tr>
                                                <td width="20%" height="25" align="right" class="black12"><strong>Anim:</strong></td>
                                                <? if($SelUserQryRow['animname']=="" || !file_exists("../anim_backgrounds/".$SelUserQryRow['animname'])){?>
                                                    <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                                                <? } ?>
                                            </tr>
                                            <? if($SelUserQryRow['animname']!="" && file_exists("../anim_backgrounds/".$SelUserQryRow['animname'])){?>
                                                <tr>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                    <td  align="left" valign="top"> <? if($SelUserQryRow['animname']!="" && file_exists("../anim_backgrounds/".$SelUserQryRow['animname'])){?><div><?=$SelUserQryRow['animname'];?></div>&nbsp;<br><br><a href="add_anim_loops.php?del=picture&id=<?=trim($_REQUEST['id']);?>">Delete Current Anim</a><? } ?></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> animname:</strong></td>
                                                <td width="80%"><input type="text" name="animname" id="animname" value="<?=stripslashes($SelUserQryRow['animname']);?>" class="solidinput" style="width:600px;" /></td>
                                            </tr>
                                            <tr>
                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> position:</strong></td>
                                                <td width="80%"><input type="text" name="position" id="position" value="<?=stripslashes($SelUserQryRow['position']);?>" class="solidinput" style="width:600px;" /></td>
                                            </tr>
                                            <tr>
                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> info:</strong></td>
                                                <td width="80%"><input type="text" name="info" id="info" value="<?=stripslashes($SelUserQryRow['info']);?>" class="solidinput" style="width:600px;" /></td>
                                            </tr>
                                            <tr>
                                                <td width="20%" height="25" align="right" class="black12">&nbsp;</td>
                                                <td width="80%"><input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Anim Loop";} else { echo "Add Anim Loop";}?>" onClick="return FrmChkRegister();" class="bttn-s">
                                                    <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_anim_loops.php'" class="bttn-s"></td>
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