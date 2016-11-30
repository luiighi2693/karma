<?php 
include("admin.config.inc.php"); 
include("connect.php");
include("admin.cookie.php");
$mlevel=4;
if($_GET["id"])
{	
	$cid=$_GET["id"];	
	$dqry="delete from questions where id=$cid";
	mysql_query($dqry);	
	header("location:manage_question.php?msgs=15&subgroupid=".$_REQUEST['subgroupid']."");
	exit;
}

if($_REQUEST['subgroupid'])
{
	$andqry=" and questions.subgroupid='".$_REQUEST['subgroupid']."'";
}
$strQueryPerPage="select questions.*,groups.name as groupname from questions,groups  
					where groups.id=questions.groupid  
					$andqry
					order by groups.id desc,questions.subgroupid  asc,questions.displayorder asc  ";
$strResultPerPage=mysql_query($strQueryPerPage);
$strTotalPerPage=mysql_affected_rows(); 

if($strTotalPerPage<1)
$Error = 1;
	
if($_GET["msgs"]==1)
{
	$Message2 = " Question Added Successfully!!";
}
if($_GET["msgs"]==3)
{
	$Message2 = " Question Updated Successfully!!";
}
if($_GET["msgs"]==15)
{
	$Message2 = " Question Deleted Successfully!!";
}
if($_GET["msgs"]==5)
{
	$Message2 = "Featured Users have been changed Successfully!!";
}
if($_GET["msgs"]==333)
{
	$Message2 = " Question Setted Successfully!!";
}
if($_GET["msgs"]==3333)
{
	$Message2 = "Display Order has been updated successfully"; 
}	
if($_GET["msgs"]==4)
{
	$Message2 = " Question has been updated successfully"; 
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
            <td width="100%" height="35" class=form111>Manage Questions </td>
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
					<form name="frmsrch" id="frmsrch" enctype="multipart/form-data" method="get">
                      <table cellSpacing="0" cellPadding="1" border="0"  >
                        <tbody>
						  <tr>
                            <td colspan="25" height="20"><strong>Sort By: </strong>
							<select name="subgroupid"  id="subgroupid" class="solidinput"  onChange="document.frmsrch.submit();">
								  <option value="">Select Group</option>
									  <? 
										$rs11=mysql_query("select * from  groups_subcategory   order by groupid asc, displayorder asc");
										$tot11=mysql_affected_rows();
										for($m=0;$m<$tot11;$m++)
										{
											$gr=mysql_fetch_object($rs11);
									  ?>
									  <option value="<?=$gr->id?>" <? if($_REQUEST['subgroupid']==$gr->id){ echo "selected";}?> ><? echo ucfirst(stripslashes(GetName1("groups","name","id",$gr->groupid)));?> - <?=stripslashes($gr->name); ?></option>
									  <? }?>
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
                              <td class=th-a><div align="center" ><strong>There are no questions to display</strong></div></td>
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
						    <td width="15%" align="left" nowrap="nowrap"><strong>Group</strong></td>
							<td width="17%" align="left" nowrap="nowrap"><strong>Sub Group</strong></td>
						  	<td width="55%" height="26"  align="left"  nowrap="nowrap"><strong>Question</strong></td>
							<td width="55%" height="26"  align="left"  nowrap="nowrap"><strong>Order</strong></td>
                            <td width="13%" align="center"><strong>Options</strong></td>
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
							<td align="left" valign="top"  nowrap="nowrap"><? echo stripslashes($row->groupname); ?></td>
							<td align="left" nowrap="nowrap" valign="top"><? echo stripslashes(GetName1("groups_subcategory","name","id",$row->subgroupid)); ?></td>
                            <td align="left" valign="top"  nowrap="nowrap"><? echo stripslashes($row->question); ?>&nbsp;</td>
							<td align="left">
							  	<select  name="displayorder[<?php echo $k ;?>]" id="displayorder" onChange="UpdateDisplayOrder_Questions('UpdateDisplayOrderID_<?=$row->id;?>',<?=$row->id;?>,this.value);">
									<option value="0">0</option>
									<?
									$gettotalsubgroupQryRs=mysql_query("SELECT * FROM questions WHERE  	groupid='".$row->groupid."' and  subgroupid='".$row->subgroupid."'");
									$Totgettotalsubgroup=mysql_affected_rows();
									for($GG=1;$GG<=$Totgettotalsubgroup;$GG++)
									{
									?>
										<option value="<? echo $GG;?>" <? if($row->displayorder==$GG){echo "selected";}?>><? echo $GG;?></option>
									<? }?>
								</select>
								<span id="UpdateDisplayOrderID_<?=$row->id;?>" style="color:#FF0000;"></span>
							  </td>
							<td  align="center"  nowrap="nowrap"  valign="top">
							<input name="button3" type="button" onClick="window.location.href='add_question.php?id=<?php echo($row->id); ?>'" value="Edit" class="bttn-s">
							<input name="button2" type="button" onClick="deleteconfirm('Are you sure you want to delete this Question? \n','manage_question.php?id=<?php echo($row->id); ?>&subgroupid=<? echo $_REQUEST['subgroupid'];?>');" value="Delete" class="bttn-s">
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
<script language="javascript">
function UpdateDisplayOrder_Questions(UpdateRating_ID,id,val)
{
	document.getElementById(UpdateRating_ID).innerHTML = "<img src='images/loading2.gif'>";
	//alert(DeleteJob_ID);
	var http77 = false;
	if(navigator.appName == "Microsoft Internet Explorer") { http77 = new ActiveXObject("Microsoft.XMLHTTP");} else { http77 = new XMLHttpRequest();}
	http77.abort();
	http77.abort();
	http77.open("GET", "ajax_validation.php?Type=UpdateDisplayOrder_Questions&id=" + id+"&val=" + val, true);
	http77.onreadystatechange=function()
	{
		  if(http77.readyState == 4)
		  {
			  document.getElementById(UpdateRating_ID).innerHTML= http77.responseText;
		  } 
	}
	http77.send(null);
}
</script>
</body>
</html>