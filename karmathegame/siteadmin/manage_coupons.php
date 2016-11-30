<?php 
include_once("admin.config.inc.php"); 
include("admin.cookie.php");
include("connect.php") ;
$mlevel=6;  
if($_GET["id"])
{	
	$cid=$_GET["id"];
	$dqry="delete from promotional where id=$cid";
	mysql_query($dqry);	
	header("location:manage_coupons.php?msgs=2");
}
$order=$_GET["order"];
$strQueryPerPage="select * from promotional where promocode like '$order%' order by id desc ";

$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 

if($strTotalPerPage<1)
$Error = 1;

if($_GET["msgs"]==1 && !$_GET["start"])
{
	$Message2 = "Coupon Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
	$Message2 = "Coupon Updated Successfully!!";
}
if($_GET["msgs"]==2 && !$_GET["start"])
{
	$Message2 = "Coupon Deleted Successfully!!";
}
?>
<HTML>
<HEAD>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<SCRIPT language="javascript" src="body.js"></SCRIPT>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
<link rel="stylesheet" href="main.css" type="text/css">
</HEAD>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0" >
<TABLE align="left" width="100%" cellpadding="0" cellspacing="0">
  <TBODY>
    <TR>
      <TD height=60 valign="top"  colspan="2"><? include("top.php") ?>
      </td>
    </TR>
    <tr>
      <td width="20%" align="left" valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?></td>
      <td width="80%" align="left" valign="top"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%" height="35">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="left"  class=form111 height="35">Manage Coupons</td>
				<td align="right" height="35" class=form111><input type="button" name="addddd" value="Add Coupon" onClick="window.location.href='add_coupons.php'" class="bttn-a" ></td>
			  </tr>
			</table></td>
          </tr>
          <tr>
            <td align="center"  class="formbg"><TABLE width="100%"  border=0 cellPadding=0 cellSpacing=0 align="left">
                <TBODY>
                  <TR>
                    <TD align="center" width="100%" class="a-l" ><font color="#FF0000"><?php echo $Message2 ; ?></font></TD>
                  </TR>
                  <TR>
                    <TD background="images/vdots.gif"><IMG height=1 src="images/spacer.gif" width=1 border=0></TD>
                  </TR>
                <TD valign="top">
                    <?php if(!$strTotalPerPage) { ?>
                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                            <tr>
                              <td class=th-a><div align="center" ><strong>No Coupon To Display</strong></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                    <?php } else { ?>
                    <FORM id="passionmanage" name="passionmanage"  method="post">
                      <table width="100%" border=0 cellspacing=1 cellpadding="1" class="t-b">
                        <tbody>
                          <tr class="form_back">
                            <td width="36%"  align="left" nowrap><strong>Coupon Code </strong></td>
                            <td width="19%"  align="center" nowrap><strong>Discount</strong></td>
							<td width="19%"  align="center" nowrap><strong>Lives</strong></td>
							<td align="center"><strong>User</strong></td>
							<td align="center"><strong>Marketer</strong></td>
                            <td width="19%" align="center"><strong>Expires</strong></td>
                            <td width="7%" align="center"><strong>Options</strong></td>
                          </tr>
                          <?
						  $k=0;
						  while($row =mysql_fetch_object($strResultPerPage))
						  { $k=$k+1;$id=$row->id;
						  ?>
                          <tr>
                            <td align="left"><? echo stripslashes($row->promocode); ?>&nbsp;</td>
                            <td align="center"><? echo stripslashes($row->discamt); ?>&nbsp;<? if($row->disctype=="1"){ echo "$";}else{echo "%";} ?></td>
							<td align="center"><? echo stripslashes($row->lifes); ?>&nbsp;</td>
							<td align="center" nowrap><? echo stripslashes(GetName1("users","email","id",$row->userid)); ?>&nbsp;<?php /*?><? echo stripslashes(GetName1("users","lastname","id",$row->userid)); ?><?php */?></td>
							<td align="center" nowrap><? echo stripslashes($row->marketer); ?>&nbsp;</td>
                            <td align="center" nowrap><? if($row->neverexp=="Y"){echo "Never Expires";}if($row->enddate!="" && $row->enddate!="0000-00-00"){ echo date("m/d/Y",strtotime($row->enddate));  } ?>&nbsp;</td>
                            <td  align="center" nowrap >
							<input name="button" type="button" onClick="window.location.href='add_coupons.php?id=<?php echo $row->id; ?>'" value="Edit" class="bttn-s">
                            &nbsp;<input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete Coupon.\n','manage_coupons.php?id=<?php echo($row->id); ?>');" value="Delete" class="bttn-s">
							</td>
                          </tr>
                          <? } ?>
                        </tbody>
                      </table>
                    </FORM>
                    <?php } ?></TD>
                </TR>
              </TABLE></td>
          </tr>
        </table></td>
    </tr>
  </TBODY>
</TABLE>
</BODY>
</HTML>