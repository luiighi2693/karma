<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=10;
$Message="";
if($_REQUEST['del']!="")
{
    $qrr=$_REQUEST['del'].'= \'\'' ;
    $sql=mysql_query("UPDATE loops SET songname='' where id='".trim($_GET['id'])."'");
    header("location:add_loops.php?id=".$_REQUEST['id']);
    exit;
}

if($_POST['SubmitUser'])
{
    if($_REQUEST['id']!='')
    {
        $InsertUserQry="UPDATE loops set
					  position='".addslashes($_POST['position'])."',
					  info='".addslashes($_POST['info'])."' 
					  WHERE id='".$_REQUEST['id']."'";
        $InsertUserQryRs=mysql_query($InsertUserQry);

        if($_FILES["picture"]['tmp_name']) {
            $file = $_FILES["picture"];
//            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
//            $filename1=rand().$send_name1;
            $filename1 = $_POST['songname'];
            $filetoupload = $file['tmp_name'];
            $path = "../audio_loops/" . $filename1;
            copy($filetoupload, $path);
        }else{
            $SelUserQry="SELECT * FROM loops WHERE id='".$_REQUEST['id']."'";
            $SelUserQryRs=mysql_query($SelUserQry);
            $SelUserQryRow=mysql_fetch_array($SelUserQryRs);
            $filename1 = $_POST['songname'];
            rename("../audio_loops/" . $SelUserQryRow['songname'], "../audio_loops/" .$filename1);
        }

        $AddUserQry2="UPDATE loops SET songname='$filename1' WHERE id='".$_REQUEST['id']."'";
        $AddUserQryRs2=mysql_query($AddUserQry2);

        header("location:manage_loops.php?msgs=3");
        exit;
    }
    else
    {
        $InsertUserQry="INSERT INTO loops set
					  position='".addslashes($_POST['position'])."',
					  info='".addslashes($_POST['info'])."'";
        $InsertUserQryRs=mysql_query($InsertUserQry);
        $InsertId=mysql_insert_id();

        if($_FILES["picture"]['tmp_name'])
        {
            $file=$_FILES["picture"];
//            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
//            $filename1=rand().$send_name1;
            $filename1 = $_POST['songname'];
            $filetoupload=$file['tmp_name'];
            $path="../audio_loops/".$filename1;
            copy($filetoupload,$path);

            $AddUserQry2="UPDATE loops SET songname='$filename1' WHERE id='".$InsertId."'";
            $AddUserQryRs2=mysql_query($AddUserQry2);
        }

        header("location:manage_loops.php?msgs=1");
        exit;
    }
}
if($_GET['id'])
{
    $SelUserQry="SELECT * FROM loops WHERE id='".$_GET['id']."'";
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
                                    <? } ?> Loop</td>
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
<!--                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> songname:</strong></td>-->
<!--                                                <td width="80%"><input type="text" name="songname" id="songname" value="--><?//=stripslashes($SelUserQryRow['songname']);?><!--" class="solidinput" style="width:600px;" /></td>-->
<!--                                            </tr>-->
                                            <tr>
                                                <td width="20%" height="25" align="right" class="black12"><strong>Song:</strong></td>
                                                <? if($SelUserQryRow['songname']=="" || !file_exists("../audio_loops/".$SelUserQryRow['songname'])){?>
                                                    <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                                                <? } ?>
                                            </tr>
                                            <? if($SelUserQryRow['songname']!="" && file_exists("../audio_loops/".$SelUserQryRow['songname'])){?>
                                                <tr>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                    <td  align="left" valign="top"> <? if($SelUserQryRow['songname']!="" && file_exists("../audio_loops/".$SelUserQryRow['songname'])){?><div><?=$SelUserQryRow['songname'];?></div>&nbsp;<br><br><a href="add_loops.php?del=picture&id=<?=trim($_REQUEST['id']);?>">Delete Current Song</a><? } ?></td>
                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> songname:</strong></td>
                                                <td width="80%"><input type="text" name="songname" id="songname" value="<?=stripslashes($SelUserQryRow['songname']);?>" class="solidinput" style="width:600px;" /></td>
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
                                                <td width="80%"><input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Loop";} else { echo "Add Loop";}?>" onClick="return FrmChkRegister();" class="bttn-s">
                                                    <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_loops.php'" class="bttn-s"></td>
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