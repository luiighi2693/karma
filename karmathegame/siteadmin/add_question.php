<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=4;
$Message="";
if($_REQUEST['del']!="")
{
	$qrr=$_REQUEST['del'].'= \'\'' ;
	$sql=mysql_query("UPDATE questions SET picture='' where id='".trim($_GET['id'])."'");	
	header("location:add_question.php?id=".$_REQUEST['id']);
	exit;
}

if($_POST['SubmitUser'])
{
	if($_REQUEST['id']!='')
	{
		$InsertUserQry="UPDATE questions set 
					  groupid='".addslashes($_POST['groupid'])."',
					  subgroupid='".addslashes($_POST['subgroupid'])."',
					  question='".addslashes($_POST['question'])."',
					  optionid='".addslashes($_POST['optionid'])."',
					  optiontype='".addslashes($_POST['optiontype'])."',
					  textboxsize='".addslashes($_POST['textboxsize'])."',
					  picturelink='".addslashes($_POST['picturelink'])."'
					  WHERE id='".$_REQUEST['id']."'";
		$InsertUserQryRs=mysql_query($InsertUserQry);
		
		$InsertId=$_REQUEST['id'];
		
		if($_FILES["picture"]['tmp_name'])
		{
			 $file=$_FILES["picture"];	
			 $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);		
			 $filename1=rand().$send_name1;		
			 $filetoupload=$file['tmp_name'];				 
			 $path="../Questions/".$filename1; 
			 copy($filetoupload,$path);
			 $extsql2=",picture='$filename1'";
		 
			$AddUserQry="UPDATE questions SET picture='$filename1' WHERE id='".$InsertId."'";	 
			$AddUserQryRs=mysql_query($AddUserQry);
		}
		
		header("location:manage_question.php?msgs=3");
		exit;
	}
	else
	{
		$InsertUserQry="INSERT INTO questions set 
					  groupid='".addslashes($_POST['groupid'])."',
					  subgroupid='".addslashes($_POST['subgroupid'])."',
					  question='".addslashes($_POST['question'])."',
					  optionid='".addslashes($_POST['optionid'])."',
					  optiontype='".addslashes($_POST['optiontype'])."',
					  textboxsize='".addslashes($_POST['textboxsize'])."',
					  picturelink='".addslashes($_POST['picturelink'])."',
					  addeddate=now()";
		$InsertUserQryRs=mysql_query($InsertUserQry);
		$InsertId=mysql_insert_id();
		
		if($_FILES["picture"]['tmp_name'])
		{
			 $file=$_FILES["picture"];	
			 $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);		
			 $filename1=rand().$send_name1;		
			 $filetoupload=$file['tmp_name'];				 
			 $path="../Questions/".$filename1; 
			 copy($filetoupload,$path);
			 $extsql2=",picture='$filename1'";
		 
			$AddUserQry="UPDATE questions SET picture='$filename1' WHERE id='".$InsertId."'";	 
			$AddUserQryRs=mysql_query($AddUserQry);
		}
		
		header("location:manage_question.php?msgs=1");
		exit;
	}		
}
if($_GET['id'])
{
	$SelUserQry="SELECT * FROM questions WHERE id='".$_GET['id']."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	$SelUserQryRow=mysql_fetch_array($SelUserQryRs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet />
</head>
<script language="Javascript" name="text/JavaScript" src="ajax_validation.js"></script>
<script type="text/javascript">
var xmlHttp;
function ajaxFunction()
{
try { xmlHttp=new XMLHttpRequest(); }
catch (e){
  try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); }
  catch (e) {
    try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
}

function getSubGroup(cid,sub2,cmbid,spanid)
{
	ajaxFunction();
	xmlHttp.onreadystatechange=function()
	{
	  if(xmlHttp.readyState==4)
	  {
		document.getElementById(spanid).innerHTML=xmlHttp.responseText;
	  }
	}
	xmlHttp.open("GET","listsubgroups.php?cid="+cid+"&cmbid="+cmbid+"&sub2="+sub2,true);
	xmlHttp.send(null);
}

function getoptionvalues(cid,sub2,cmbid,spanid)
{
	ajaxFunction();
	xmlHttp.onreadystatechange=function()
	{
	  if(xmlHttp.readyState==4)
	  {
		document.getElementById(spanid).innerHTML=xmlHttp.responseText;
	  }
	}
	xmlHttp.open("GET","listsuboptionsvalue.php?cid="+cid+"&cmbid="+cmbid+"&sub2="+sub2,true);
	xmlHttp.send(null);
}
</script>
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
                    <? } ?> Question</td>
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
							<tr>
								  <td height="25" align="right" valign="top" ><strong><span class="a">* </span>Group:</strong></td>
								  <td height="25" colSpan=3 valign="top">
									<select name="groupid" id="groupid"  class="solidinput" onChange="getSubGroup(this.value,'N','subgroupid','SubcatRow')" style="width:250px;">
										   <?
											$rs11=mysql_query("select * from groups where 1=1 order by name asc");
											$tot11=mysql_affected_rows();
											for($m=0;$m<$tot11;$m++)
											{
											$gr=mysql_fetch_object($rs11);
											if($m==0){ $firstgroup=$gr->id; }
										  ?>
										  <option value="<?=$gr->id?>" <? if($SelUserQryRow['groupid']==$gr->id){ echo "selected";}?> ><?=stripslashes($gr->name); ?></option>
										  <? }?>
									</select>
									</td>
							</tr>
							<?
							if($_REQUEST['id'])
							{
								$firstgroup=$SelUserQryRow['groupid'];
							}
							?>
							<tr>
							  <td height="25" align="right" valign="middle" ><strong><span class="a">*</span> Sub Group:</strong></td>
							  <td height="25" colSpan="3" valign="top" id="SubcatRow">
									<select name="subgroupid"  id="subgroupid" class="solidinput"  style="width:250px;">
									  <option value="">Select Sub Group</option>
										  <? 
											$rs11=mysql_query("select * from  groups_subcategory where groupid='".$firstgroup."' order by name");
											$tot11=mysql_affected_rows();
											for($m=0;$m<$tot11;$m++)
											{
												$gr=mysql_fetch_object($rs11);
										  ?>
										  <option value="<?=$gr->id?>" <? if($SelUserQryRow['subgroupid']==$gr->id){ echo "selected";}?> ><?=stripslashes($gr->name); ?></option>
										  <? }?>
									</select>
								</td>
							</tr>
							<tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> Question:</strong></td>
                              <td width="80%"><input type="text" name="question" id="question" value="<?=stripslashes($SelUserQryRow['question']);?>" class="solidinput" style="width:600px;" /></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a">*</span> Options Type:</strong></td>
                              <td width="80%">
							  	<select name="optiontype" id="optiontype">
									<option value="Radio Options" <? if($SelUserQryRow['optiontype']=="Radio Options"){ echo "selected";}?> >Radio Options</option>
									<option value="Dropdown" <? if($SelUserQryRow['optiontype']=="Dropdown"){ echo "selected";}?> >Dropdown</option>
								</select>
							  </td>
                            </tr>
                            <tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong>Options Group:</strong></td>
                              <td width="80%">
							  		<select name="optionid" id="optionid"  class="solidinput" onChange="getoptionvalues(this.value,'N','subgroupid','options_groupid')" style="width:250px;">
										  <option value="">Select Option Group</option>
										   <?
											$rs11=mysql_query("select * from options_group where 1=1 order by name asc");
											$tot11=mysql_affected_rows();
											for($m=0;$m<$tot11;$m++)
											{
											$gr=mysql_fetch_object($rs11);
											if($m==0){ $firstgroup=$gr->id; }
										  ?>
										  <option value="<?=$gr->id?>" <? if($SelUserQryRow['optionid']==$gr->id){ echo "selected";}?> ><?=stripslashes($gr->name); ?></option>
										  <? }?>
									</select>
							  </td>
                            </tr>
							<tr>
							  <td height="25" align="right" valign="middle" >&nbsp;</td>
							  <td height="25" colSpan="3" valign="top" id="options_groupid">&nbsp;</td>
							</tr>
							<tr>
                              <td width="20%" height="25" align="right" class="black12"><strong>Picture:</strong></td>
                              <td width="80%"><input name="picture" id="picture" type="file"  class="first"  /></td>
                            </tr>
							<? if($SelUserQryRow['picture']!="" && file_exists("../Questions/".$SelUserQryRow['picture'])){?>
							<tr>
								<td align="right" valign="middle">&nbsp;</td>
								<td  align="left" valign="top" style="padding-bottom:5px;"> <? if($SelUserQryRow['picture']!="" && file_exists("../Questions/".$SelUserQryRow['picture'])){?><img src="../Questions/<?=$SelUserQryRow['picture'];?>"  width="100"/>&nbsp;<br><br><a href="add_question.php?del=image&id=<?=trim($_REQUEST['id']);?>">Delete Current Image</a><? } ?></td>
							</tr>
					 	  <? } ?>
						    <tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a"></span> Picture Link:</strong></td>
                              <td width="80%"><input type="text" name="picturelink" id="picturelink" value="<?=stripslashes($SelUserQryRow['picturelink']);?>" class="solidinput" style="width:600px;" /></td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="right" valign="top" class="black12"><strong><span class="a"></span> Text Box Size:</strong></td>
                              <td width="80%"><input type="text" name="textboxsize" id="textboxsize" value="<?=stripslashes($SelUserQryRow['textboxsize']);?>" class="solidinput" style="width:35px;" />Pixels</td>
                            </tr>
							<tr>
                              <td width="20%" height="25" align="right" class="black12">&nbsp;</td>
                              <td width="80%"><input type="submit" name="SubmitUser" id="SubmitUser" value="<? if($_GET['id']){ echo "Edit Question";} else { echo "Add Question";}?>" onClick="return FrmChkRegister();" class="bttn-s">
							  <input type="button" name="SubmitUser2" id="SubmitUser2" value="Cancel" onClick="window.location.href='manage_question.php'" class="bttn-s"></td>
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
	
	if(form.groupid.value=="")
	{
		alert("Please select group.");
		form.groupid.focus();
		return false;
	}
	if(form.subgroupid.value=="")
	{
		alert("Please select sub group.");
		form.subgroupid.focus();
		return false;
	}
	if(form.question.value.split(" ").join("")=="")
	{
		alert("Please enter question.");
		form.question.focus();
		return false;
	}
	return true;
}	


</script>
<? if($_REQUEST['id']){?>
<script language="javascript">
getoptionvalues(<? echo $SelUserQryRow['optionid'];?>,'N','subgroupid','options_groupid');
</script>
<? }?>
</body>
</html>