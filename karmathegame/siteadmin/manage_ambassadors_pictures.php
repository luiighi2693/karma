<?php
include("admin.config.inc.php");
include("connect.php");
include("admin.cookie.php");
$mlevel=55;
if($_GET["id"])
{
    $cid=$_GET["id"];

    $dqry="delete from Amb_pictures where id=$cid";
    mysql_query($dqry);
    header("location:manage_ambassadors_pictures.php?msgs=15");
    exit;
}
if(trim($_REQUEST['keyword'])!="")
{
    $ANDQRY2.=" and ( firstname like '".trim($_REQUEST['keyword'])."%' or lastname like '".trim($_REQUEST['keyword'])."%' or email like '".trim($_REQUEST['keyword'])."%' or phone like '".trim($_REQUEST['keyword'])."%' or code like '".trim($_REQUEST['keyword'])."%'     )";
}
if(trim($_REQUEST['left_name'])!="")
{
    $ANDQRY2.=" and ( firstname='".trim($_REQUEST['left_name'])."' or lastname='".trim($_REQUEST['left_name'])."' or concat(firstname,' ',lastname)='".trim($_REQUEST['left_name'])."'  or concat(lastname,' ',firstname)='".trim($_REQUEST['left_name'])."')";
}
if(trim($_REQUEST['left_email'])!="")
{
    $ANDQRY2.=" and ( email='".trim($_REQUEST['left_email'])."' )";
}

$ORDQry=" order by id desc";


$order=$_GET["order"];
$strQueryPerPage="select Amb_pictures.*, marketers.firstname from Amb_pictures left join marketers on Amb_pictures.amb_id=marketers.id where 1=1";
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows();


if($_GET["msgs"]==1 && !$_GET["start"])
{
    $Message2 = "Pictures Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
    $Message2 = "Pictures Updated Successfully!!";
}
if($_GET["msgs"]==15 && !$_GET["start"])
{
    $Message2 = "Pictures Deleted Successfully!!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
    <title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
    <link rel="stylesheet" href="main.css" type="text/css">
</head>
<body bgColor="#ffffff" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<script language="javascript" src="body.js"></script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
        </td>
    </tr>
    <tr>
        <td width="20%" valign="top" class="rightbdr" ><? include("left_marketers.php"); ?>
        </td>
        <td width="80%" valign="top"><table width="100%"  border="0" cellpadding="2" cellspacing="2">
                <tr>
                    <td width="100%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" height="35" class=form111>Manage Marketer Pictures </td>
                                <td align="right" height="35" class=form111><input type="button" name="addddd" value="Add Picture" onClick="window.location.href='add_ambassadors_pictures.php'" class="bttn-a" ></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center"  class="formbg"><table width="100%"  border="0" cellPadding="0" cellSpacing="0" align="left">
                            <tbody>
                            <tr>
                                <td align="center" width="100%" class="a-l" ><font color="#FF0000"><?php echo $Message2 ; ?></font></td>
                            </tr>
                            <tr>
                                <td background="images/vdots.gif"><IMG height=1  src="images/spacer.gif" width=1 border=0></td>
                            </tr>
                            <td valign="top">
                                <table cellSpacing="0" cellPadding="1" border="0"  >
                                    <tbody>
                                    <tr>
                                        <td colspan="25" height="20"><b>View By  Name </b></td>
                                    </tr>
                                    <?=$prs_pageing->order();?>
                                    </tbody>
                                </table>
                                <?php if(!$strTotalPerPage) { ?>
                                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                                                    <tr>
                                                        <td class=th-a><div align="center" ><strong>No Pictures To Display</strong></div></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table>
                                <?php } else { ?>
                                    <form id="passionmanage" name="passionmanage"  method="post" action="#" enctype="multipart/form-data">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-b">
                                            <tbody>
                                            <? if($_REQUEST['db_pages']!=''){$db_pages=$_REQUEST['db_pages'];}else{$db_pages=50;}?>
                                            <!--DWLayoutTable-->
                                            <tr>
                                                <td align="right" height="30" colspan=17><? $result=$prs_pageing->number_pageing_admin($strQueryPerPage,$db_pages,10,"Y");?></td>
                                            </tr>
                                            <tr class="form_back" >
                                                <td width="46%" height="20"  align="left"><strong>Ambassador </strong></td>
                                                <td width="48%" height="20"  align="left"><strong>Picture</strong></td>
                                                <td width="10%" align="center"><strong></strong></td>
                                            </tr>
                                            <?
                                            $k=0;
                                            while($row =mysql_fetch_object($result))
                                            {
                                                $k=$k+1;
                                                ?>
                                                <tr>
                                                    <td align="left"><? echo stripslashes($row->firstname); ?>&nbsp;</td>
                                                    <td align="left"><? echo stripslashes($row->picture); ?>&nbsp;</td>
                                                    <td  align="center" nowrap="nowrap">
                                                        <input name="button" type="button" onClick="window.location.href='add_ambassadors_pictures.php?id=<?php echo $row->id; ?>'" value="Edit" title="Edit" class="bttn-s">
                                                        <input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete Picture? \n','manage_ambassadors_pictures.php?id=<?php echo($row->id); ?>');" value="Delete" title="Delete" class="bttn-s">
                                                    </td>
                                                </tr>
                                            <? } ?>

                                            </tbody>
                                        </table>
                                    </form>
                                <?php } ?>                 </td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>
    </tbody>
</table>
</body>
</html>