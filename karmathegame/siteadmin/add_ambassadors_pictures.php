<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=55;
$Message="";

if($_REQUEST['del']!="")
{
    $sql=mysql_query("UPDATE Amb_pictures SET picture='' where id='".trim($_GET['id'])."'");
    header("location:add_ambassadors_pictures.php?id=".$_REQUEST['id']);
    exit;
}

if(isset($_POST['Submit']))
{
    if($_GET['id']){
        $sql="UPDATE Amb_pictures SET 
		amb_id='".addslashes($_POST["ambassador"])."'
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

            $AddPicturesQry="UPDATE Amb_pictures SET picture='$filename1' WHERE id='".$InsertId."'";
            $AddPicturesQryRs=mysql_query($AddPicturesQry);
        }

        header("location:manage_ambassadors_pictures.php?msgs=3");
        exit;
    }
    else{
        $InsertPictureQry="INSERT INTO Amb_pictures SET amb_id='".addslashes($_POST["ambassador"])."'";
        $InsertPictureQryRs=mysql_query($InsertPictureQry);
        $InsertId=mysql_insert_id();

        if($_FILES["picture"]['tmp_name']){
            $file=$_FILES["picture"];
            $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
            $filename1=rand().$send_name1;
            $filetoupload=$file['tmp_name'];
            $path="../ambassador/".$filename1;
            copy($filetoupload,$path);
            $extsql2=",picture='$filename1'";

            $AddUserQry="UPDATE Amb_pictures SET picture='$filename1' WHERE id='".$InsertId."'";
            $AddUserQryRs=mysql_query($AddUserQry);
        }

        header("location:manage_ambassadors_pictures.php?msgs=1");
        exit;
    }
}

if($_GET['id']){
    $Buttitle="Save changes";
    $SelPictureQry="SELECT * FROM Amb_pictures WHERE id='".$_GET['id']."'";
    $SelPictureQryRs=mysql_query($SelPictureQry);
    $SelPictureQryRow=mysql_fetch_array($SelPictureQryRs);
}else{
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
<table align="left" width="100%" cellpadding="0" cellspacing="0" >
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="75"><? include ("top.php"); ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" width="100%" border=0>
                <tbody >
                <tr>
                    <td width="20%"  valign="top" class="rightbdr" ><? include("left_marketers.php"); ?></td>
                    <td width="80%" valign="top" align="center">
                        <table width="100%"  border=0 cellpadding="2" cellspacing="2">
                            <tr>
                                <td height="35" class="form111"><? if($_GET['id']){?>Edit<? } else {?>Add<? } ?> Picture</td>
                            </tr>
                            <tr>
                                <td height="222" class="formbg" valign="top">
                                    <form name="addpicture" id="addpicture"  method="post" enctype="multipart/form-data" action="#">
                                        <table cellspacing="2" cellpadding="2" width=98% border="0" class="t-b">
                                            <? if($Message){?>
                                                <tr>
                                                    <td class="a" align="center" colspan="4"><?=$Message;?>&nbsp;</td>
                                                </tr>
                                            <? }?>
                                            <tr>
                                                <td width="20%" height="25" align="right" valign="top" class="black12"><strong>Ambassador</strong></td>
                                                <td width="25">
                                                    <select name="ambassador" id="ambassador" style="width:250px;" class="solidinput">
                                                        <option value="0" <? if($SelPictureQryRow['amb_id']=="0" || $_REQUEST['id']==''){ echo "selected";}?>></option>
                                                        <?=GetDropdown(id,firstname,"marketers",' where 1=1 order by firstname asc',stripslashes($SelPictureQryRow['amb_id']));?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" height="25" align="right" class="black12"><strong>Picture:</strong></td>
                                                <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                                            </tr>
                                            <? if($SelPictureQryRow['picture']!="" && file_exists("../ambassador/".$SelPictureQryRow['picture'])){?>
                                                <tr>
                                                    <td align="right" valign="middle">&nbsp;</td>
                                                    <td  align="left" valign="top" style="padding-bottom:5px;"> <? if($SelPictureQryRow['picture']!="" && file_exists("../ambassador/".$SelPictureQryRow['picture'])){?><img src="../ambassador/<?=$SelPictureQryRow['picture'];?>"  width="100"/>&nbsp;<br><br><a href="add_ambassadors_pictures.php?del=picture&id=<?=trim($_REQUEST['id']);?>">Delete Current Image</a><? } ?></td>
                                                </tr>|
                                            <? } ?>
                                            <tr>
                                                <td align="right">&nbsp;</td>
                                                <td width="81%" colspan="3">
                                                    <input type=submit name="Submit" value="<? echo $Buttitle;?>" class="bttn-s">
                                                    <input type="button" value="Cancel" onClick="window.location.href='manage_ambassadors_pictures.php'" class="bttn-s">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
</body>
</html>