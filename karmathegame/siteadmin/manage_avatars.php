<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
$mlevel=3;


if($_GET["id"])
{	
	$cid=$_GET["id"];
	
	$dqry="delete from groups where id=$cid";
	mysql_query($dqry);	
	header("location:manage_avatars.php?msgs=15");
	exit;
}

	$ORDQry=" order by id desc";


$order=$_GET["order"];
$strQueryPerPage="select groups.*  from groups  where groups.name like '$order%' $ANDQRY2 order by groups.name asc";
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 
$_SESSION["EXPORT_MEMBER_QRYY"]=$strQueryPerPage;



if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1 && !$_GET["start"])
{
	$Message2 = " Group Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
	$Message2 = " Group Updated Successfully!!";
}
if($_GET["msgs"]==15 && !$_GET["start"])
{
	$Message2 = " Group Deleted Successfully!!";
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
      <td width="20%" valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
      </td>
      <td width="80%" valign="top"><table width="100%"  border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="left" height="35" class=form111>Manage Groups Avatars</td>
				<td align="right" height="35" class=form111>&nbsp;</td>
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
                      
                    <?php if(!$strTotalPerPage) { ?>
                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                            <tr>
                              <td class=th-a><div align="center" ><strong>No Group To Display</strong></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                    <?php } else { ?>
                      <form id="passionmanage" name="passionmanage"  method="post" action="#" enctype="multipart/form-data">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-b">
                          <tbody>
                            <!--DWLayoutTable-->
                            <tr>
                              <td align="right" height="30" colspan=17><? $result=$prs_pageing->number_pageing($strQueryPerPage,50,10,"Y");?></td>
                            </tr>
                            <tr class="form_back" >
							   <td width="55%" height="20"  align="left"><strong>Group Name </strong></td>
                               <td width="10%" align="center"><strong>Options</strong></td>
							</tr>
                            <?
						  $k=0;
						  while($row =mysql_fetch_object($result))
						  {
								$k=$k+1;
						  ?>
                            <tr>
                			  <td align="left"><? echo stripslashes($row->name); ?></td>
							  <td  align="center" nowrap="nowrap">
							  <?
								$cntimg=0;
								$cntres=mysql_query("SELECT count(id) from avatars where groupid='".$row->id."'");
								$cntrow=mysql_fetch_row($cntres);
								$cntimg=$cntrow[0];
								?>
								<input name="button" type="button" onClick="window.location.href='add_moreimages.php?pid=<?php echo $row->id; ?>'" value="<?=$cntimg;?> Avatars" class="bttn-s" title="Images">
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