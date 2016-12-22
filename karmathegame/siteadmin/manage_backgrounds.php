<?php
include("admin.config.inc.php");
include("connect.php");
include("admin.cookie.php");
$mlevel=10;
if($_GET["id"])
{
    $cid=$_GET["id"];
    $dqry="delete from backgrounds where id=$cid";
    mysql_query($dqry);
    header("location:manage_backgrounds.php?msgs=15");
//    header("location:manage_backgrounds.php?msgs=15&subgroupid=".$_REQUEST['subgroupid']."");
    exit;
}

//if($_REQUEST['subgroupid'])
//{
//    $andqry=" and ideas.subgroupid='".$_REQUEST['subgroupid']."'";
//}
$strQueryPerPage="select * from backgrounds
					order by id desc ";

$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows();

if($strTotalPerPage<1)
    $Error = 1;

if($_GET["msgs"]==1)
{
    $Message2 = " Background Added Successfully!!";
}
if($_GET["msgs"]==3)
{
    $Message2 = " Background Updated Successfully!!";
}
if($_GET["msgs"]==15)
{
    $Message2 = " Background Deleted Successfully!!";
}
if($_GET["msgs"]==5)
{
    $Message2 = "Featured Users have been changed Successfully!!";
}
if($_GET["msgs"]==333)
{
    $Message2 = " Background Setted Successfully!!";
}
if($_GET["msgs"]==3333)
{
    $Message2 = "Display Order has been updated successfully";
}
if($_GET["msgs"]==4)
{
    $Message2 = " Background has been updated successfully";
}
?>
<html>
<HEAD>
    <title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
    <SCRIPT language="javascript" src="body.js"></SCRIPT>
    <META http-equiv=Content-Type content="text/html; charset=utf-8">
    <META content="MSHTML 6.00.2600.0" name=GENERATOR>
    <link rel="stylesheet" href="main.css" type="text/css">
</HEAD>
<body>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
        </td>
    </tr>
    <tr>
        <td width="20%" valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
        </td>
        <td width="80%" valign="top"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                <tr>
                    <td width="100%" height="35" class=form111>Manage Backgrounds</td>
                </tr>
                <tr>
                    <td align="center"  class="formbg"><table width="100%"  border=0 cellPadding=0 cellSpacing=0 align="left">
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
                                        <td colspan="25" height="20"><b>View By Title </b></td>
                                    </tr>
                                    <?=$prs_pageing->order();?>
                                    </tbody>
                                </table>
                                <?php if(!$strTotalPerPage) { ?>
                                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                                                    <tr>
                                                        <td class=th-a><div align="center" ><strong>There are no ideas to display</strong></div></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table>
                                <?php } else { ?>
                                    <form id="passionmanage" name="passionmanage"  method="post" enctype="multipart/form-data">
                                        <table width="100%" border=0 cellspacing=0 cellpadding="0" class="t-b">
                                            <tbody>
                                            <!--DWLayoutTable-->
                                            <tr>
                                                <td align="right" height="30" colspan=12><? $result=$prs_pageing->number_pageing($strQueryPerPage,100,10,"Y","Y"); echo $result[1];?></td>
                                            </tr>
                                            <tr class="form_back">
                                                <td width="20%" align="left" nowrap="nowrap"><strong>Id</strong></td>
                                                <td width="60%" align="left" nowrap="nowrap"><strong>Img</strong></td>
                                                <td width="20%" align="center"><strong>Options</strong></td>
                                            </tr>
                                            <?
                                            $k=0;
                                            $count = 0;
                                            while($row =mysql_fetch_object($result[0]))
                                            {

                                                $k=$k+1;
                                                $count++;
                                                if($colorflg==1)
                                                {
                                                    $colorflg=0;
                                                    ?>
                                                    <tr>
                                                <? } ?>
                                                <td align="left" valign="top"  ><? echo stripslashes($row->id); ?></td>
                                                <td align="left" valign="top"  ><? echo stripslashes($row->img); ?></td>
                                                <td  align="center"  nowrap="nowrap"  valign="top">
                                                    <input name="button3" type="button" onClick="window.location.href='add_backgrounds.php?id=<?php echo($row->id); ?>'" value="Edit" class="bttn-s">
                                                    <input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete this Background? \n','manage_backgrounds.php?id=<?php echo($row->id); ?>');" value="Delete" class="bttn-s">
                                                    <input type="hidden" name="pid<?=$count; ?>" value="<?=$row->id;?>" >
                                                    <input type="hidden" name="count" value="<?=$count; ?>" >
                                                </td>

                                                </tr>
                                            <? } ?>
                                            <tr>
                                                <td align="right" height="30" colspan=12><? echo $result[1];?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                <?php } ?>
                                <!--/content--></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>
    </tbody>
</table>
</body>
</html>