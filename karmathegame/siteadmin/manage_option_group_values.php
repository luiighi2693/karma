<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
$mlevel=3;


if($_GET["id"])
{	
	$cid=$_GET["id"];
	
	$dqry="delete from options_group_values where id=$cid";
	mysql_query($dqry);	
	header("location:manage_option_group_values.php?msgs=15");
	exit;
}

	$ORDQry=" order by id desc";

if($_REQUEST['groupid'])
{
	$andqry=" and options_group_values.groupid='".$_REQUEST['groupid']."'";
}
$order=$_GET["order"];
$strQueryPerPage="select options_group_values.*,options_group.name as groupname from options_group_values,options_group where options_group.id= options_group_values.groupid  and options_group_values.name like '$order%' 
				  $andqry order by options_group.name asc,options_group_values.id asc";
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 
$_SESSION["EXPORT_MEMBER_QRYY"]=$strQueryPerPage;



if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1 && !$_GET["start"])
{
	$Message2 = "Option Group Value Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
	$Message2 = "Option Group Value Updated Successfully!!";
}
if($_GET["msgs"]==15 && !$_GET["start"])
{
	$Message2 = "Option Group Value Deleted Successfully!!";
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
				<td align="left" height="35" class=form111>Manage Options Group Values </td>
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
					<form name="frmsrch" id="frmsrch" enctype="multipart/form-data" method="get">
                      <table cellSpacing="0" cellPadding="1" border="0"  >
                        <tbody>
						  <tr>
                            <td colspan="25" height="20"><strong>Sort By: </strong>
							<select name="groupid" id="groupid" style="width:250px;" class="solidinput" onChange="document.frmsrch.submit();">
							  <option value="">View ALL</option>
							  <?=GetDropdown(id,name,"options_group",' where 1=1 order by name asc',stripslashes($_REQUEST['groupid']));?>
						    </select>
							</td>
                          </tr>
						 </tbody>
                      </table>
					 </form> 
                    <?php if(!$strTotalPerPage) { ?>
                    <table width="70%" border="0"   cellspacing="1" cellpadding="1" align="center" >
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-a2">
                            <tr>
                              <td class=th-a><div align="center" ><strong>No Sub Group To Display</strong></div></td>
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
                              <td align="right" height="30" colspan=17><? $result=$prs_pageing->number_pageing($strQueryPerPage,100,10,"Y");?></td>
                            </tr>
                            <tr class="form_back" >
							   <td width="35%" height="20"  align="left"><strong>Options Group Name </strong></td>
							   <td width="55%" height="20"  align="left"><strong>Option Group Value </strong></td>
							   <td width="10%" align="center"><strong>Options</strong></td>
							</tr>
                            <?
						  $k=0;
						  while($row =mysql_fetch_object($result))
						  {
								$k=$k+1;
						  ?>
                            <tr>
                			  
							  <td align="left"><? echo stripslashes($row->groupname); ?></td>
							  <td align="left"><? echo stripslashes($row->name); ?></td>
							  <td  align="center" nowrap="nowrap">
							  <input name="button" type="button" onClick="window.location.href='add_option_group_values.php?id=<?php echo $row->id; ?>'" value="Edit" title="Edit Sub Group" class="bttn-s">
							  <input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete subject? \n','manage_option_group_values.php?id=<?php echo($row->id); ?>');" value="Delete" title="Delete Student" class="bttn-s">
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