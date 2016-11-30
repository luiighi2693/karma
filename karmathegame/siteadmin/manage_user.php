<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
$mlevel=2;
if($_GET["id"])
{	
	$cid=$_GET["id"];
	
	$dqry="delete from users where id=$cid";
	mysql_query($dqry);	
	header("location:manage_user.php?msgs=15");
	exit;
}
if($_POST["ApproveUser"])
{
	$active = $_POST["active"];
	$idary = $_POST["id"];
	$totid = $_POST["totid"];
	for($i=1;$i<=$totid;$i++)
	{
		if($active[$i]=='Y')
		{
			$Uqry = " update users set active='Y' where id=".$idary[$i];
			$Ures = mysql_query($Uqry);		
		}
		else
		{
			$Uqry = " update users set active='N' where id=".$idary[$i];
			$Ures = mysql_query($Uqry);
		}
	}
	$Message2 = "Customer Status Updated Successfully" ; 	
}
if(trim($_REQUEST['keyword'])!="")
{
	$ANDQRY2.=" and ( username like '".trim($_REQUEST['keyword'])."%' or firstname like '".trim($_REQUEST['keyword'])."%' or lastname like '".trim($_REQUEST['keyword'])."%' or email like '".trim($_REQUEST['keyword'])."%' or marketer like '".trim($_REQUEST['keyword'])."%'      )";
}
if(trim($_REQUEST['left_name'])!="")
{
	$ANDQRY2.=" and ( firstname='".trim($_REQUEST['left_name'])."' or lastname='".trim($_REQUEST['left_name'])."' or concat(firstname,' ',lastname)='".trim($_REQUEST['left_name'])."'  or concat(lastname,' ',firstname)='".trim($_REQUEST['left_name'])."')";
}
if(trim($_REQUEST['left_email'])!="")
{
	$ANDQRY2.=" and ( email='".trim($_REQUEST['left_email'])."' )";
}

if(trim($_REQUEST['left_active'])!="")
{
	$ANDQRY2.=" and ( active='".trim($_REQUEST['left_active'])."' )";
}


$order=$_GET["order"];
$strQueryPerPage="select * from users where 1=1 and  firstname like '$order%' $ANDQRY2 order by id desc  ";
$_SESSION["EXPORT_MEMBER_QRYY"]=$strQueryPerPage;
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 
	

if ($_REQUEST['db_pages']==''){ $db_pages=50; }else{ $db_pages=$_REQUEST['db_pages'];} 

if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1 && !$_GET["start"])
{
	$Message2 = "Customer Added Successfully!!";
}
if($_GET["msgs"]==3 && !$_GET["start"])
{
	$Message2 = "Customer Updated Successfully!!";
}
if($_GET["msgs"]==15 && !$_GET["start"])
{
	$Message2 = "Customer Deleted Successfully!!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link rel="stylesheet" href="main.css" type="text/css"></head>
<body bgColor="#ffffff" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<script language="javascript" src="body.js"></script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height=60 valign="top"  colspan="2"><? include("top.php") ?>
      </td>
    </tr>
    <tr>
      <td width="20%" valign="top" class="rightbdr" ><? include("left_users.php"); ?>
      </td>
      <td width="80%" valign="top"><table width="100%"  border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="100%" height="35">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td  class=form111 height="35">Manage Customers</td>
					<td height="35" class=form111  align="right"><input type="button" class="bttn-a" value="EXPORT" onClick="window.location.href='exportusers.php'"></td>
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
                              <td class=th-a><div align="center" ><strong>No Customers To Display</strong></div></td>
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
                              <td align="right" height="30" colspan=12><? $result=$prs_pageing->number_pageing($strQueryPerPage,$db_pages,10,"Y");?></td>
                            </tr>
                            <tr class="form_back" >
							  <td width="7%" height="20"  align="center"><strong>Active</strong></td>
							  <td width="19%" height="20"  align="left"><strong>User Name</strong></td>
							  <td width="19%" height="20"  align="left"><strong>Code</strong></td>
                              <td width="24%"  align="left" ><strong>Email</strong></td>
							  <td width="24%"  align="center" ><strong>Token</strong></td>
							  <td width="20%"  align="center" ><strong>Date</strong></td>
							 <td width="11%" align="center"><strong>Options</strong></td>
                            </tr>
                            <?
						  $k=0;
						  while($row =mysql_fetch_object($result))
						  {
								$k=$k+1;
						  ?>
                            <tr>
                			  <td width="7%" height="20"  align="center"><input type="checkbox" name="active[<?php echo $k ;?>]" value="Y" <? if($row->active=='Y'){ echo checked; } ?>  style="border:0;background-color:#F6F6F6" ><input type="hidden" name="id[<?php echo $k;?>]" value="<?php echo $row->id;?>">
							  </td>	
                              <td align="left"><a href="add_user.php?id=<?php echo $row->id; ?>" title="Click to edit" class="folder_linkn" ><? echo stripslashes($row->username); ?></a></td>
							  <td align="left"><? echo stripslashes($row->marketer); ?>&nbsp;</td>
                              <td align="left"><a href="mailto:<? echo $row->email; ?>"><? echo $row->email; ?></a>&nbsp;</td>
							  <td align="center"><? echo stripslashes($row->couponcode); ?>&nbsp;</td>
							  <td align="center" nowrap="nowrap"><? echo date("m/d/Y H:i:s",strtotime($row->regdate)); ?>&nbsp;</td>
							  <td  align="center" nowrap="nowrap">
							  <input name="button" type="button" onClick="window.location.href='add_user.php?id=<?php echo $row->id; ?>'" value=" Edit " class="bttn-s">
							  <input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete customer? \n','manage_user.php?id=<?php echo($row->id); ?>');" value="Delete" class="bttn-s">
							  </td>
                            </tr>
                            <? } ?>
							<tr>
                            <td colspan="10" align="left">
								<input type="submit" name="ApproveUser" value="Activate" class="bttn-s" />
								<input type="hidden" name="totid" value="<?=$k;?>">
							</td>
                          </tr>
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