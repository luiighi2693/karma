<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php") ;
$mlevel=3;
$Error=0;

if(isset($_REQUEST['act']) && $_REQUEST['act']=='del')
{
    $picture=GetName1("avatars","picture","id",$_REQUEST['id']);
    
	$insres=mysql_query("DELETE FROM avatars where id='".$_REQUEST['id']."'");
	echo "<script>window.location='add_moreimages.php?pid=".$_REQUEST['pid']."&msgs=2';</script>";
}


if($_POST['btnUploadImage']!='' && $_POST['btnUploadImage']=="Upload Avatar")
{
	if ($_FILES["picture"]["error"] > 0)
	{
		
	}
	else
	{
		 $file=$_FILES["picture"];	
		 $send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);		
		 $filename1=rand().$send_name1;		
		 $filetoupload=$file['tmp_name'];				 
		 $path="../Avatars/".$filename1; 
		 @copy($filetoupload,$path);
		 
		$ext=getExtension($filename1);
		$source=$_FILES["picture"]['tmp_name'];
			
		make_thumb("../Avatars/$filename1","../Avatars/thumbs/$filename1",225);	
	}
	$insres=mysql_query("INSERT INTO avatars (groupid,picture,name,createdate,columnn) values ('".$_REQUEST['pid']."','".$filename1."','".addslashes($_POST['name'])."',now(),'".addslashes($_POST['columnn'])."')");
	//echo "<script>window.location='add_moreimages.php?pid=".$_REQUEST['pid']."&msgs=1';</ script>";
}

$msg="";
if(isset($_REQUEST['msgs']))
{
  if($_REQUEST['msgs']==1)
  	$msg="Image uploaded successfully.";
  if($_REQUEST['msgs']==2)
  	$msg="Image deleted successfully.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<script language="javascript" src="body.js"></script>
<script language="javascript" type="text/javascript">
function valid()
{
	form=document.addMoreImage;
	if(form.picture.value=="")
	{
		alert("Please select image");
		form.picture.focus();
		return false
	}
	if(form.picture.value.split(" ").join("")!="")
	{
		if(!in_ext_lib(form.picture.value))
		{
			form.picture.focus();
			return false
		}
	}
	return  true;
}

function in_ext_lib(str)
{
	var x;
	var flag = 0;
	var myext = new Array();
	myext[0] = ".png";
	myext[1] = ".jpg";
	myext[2] = ".jpeg";
	myext[3] = ".PNG";
	myext[4] = ".JPG";
	myext[5] = ".JPEG";
	for (x in myext)
	{
		if(str.substr(str.lastIndexOf(".",str)).toLowerCase() == myext[x])
		{
			flag = 1;
			break;	
		}
	}
	if(flag == 0)
	{
		alert("Please upload only .png or .jpg image file.");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<table align="left" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="75"><? include ("top.php"); ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY >
          <tr>
            <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><TABLE width="100%"  border=0 cellpadding="2" cellspacing="2">
                <TR>
                  <TD height="35" class="form111">Avatar Images</TD>
                </TR>
                <tr>
                  <td height="222" class="formbg" valign="top">
				    <form name="addMoreImage" id="addMoreImage" action="#"  method="post" enctype="multipart/form-data">
					  <input type="hidden" name="pid" value="<?=$_REQUEST['pid'];?>">
                      <TABLE cellSpacing=0 cellPadding=0 width=100% border=0 class="t-b">
                        <TR>
                          <TD width="219" height="25" align=right valign="middle"><strong>Group Name:&nbsp;</strong></TD>
                          <td width="806"><strong><?=stripslashes(GetName1("groups","name","id",$_REQUEST['pid']));?></strong></TD>
                        </TR>
                        <TR>
                          <TD height="25" align=right valign="middle"><strong>Add Avatar:&nbsp;</strong></TD>
						  <td><input type="file" name="picture" id="picture" size="30" class="bttn-s" /></td></TR>
						<TR>
                          <TD height="25" align=right valign="middle"><strong>Name:&nbsp;</strong></TD>
						  <td><input type="text" name="name" id="name" size="80"  /></td></TR>  
						<TR>
                          <TD height="25" align=right valign="middle"><strong>Column:&nbsp;</strong></TD>
						  <td><select name="columnn" id="columnn"><option value="M">M</option><option value="F">F</option><option value="I">I</option></select></td></TR>  
						<tr><td>&nbsp;</td><td><input type="submit" name="btnUploadImage" id="btnUploadImage" value="Upload Avatar" class="bttn-s" onClick="return valid();" /></TD></TR>
						<? if($msg!="") { ?>
                      	  <TR><TD height="25" colspan="2" align=center valign="middle" class="a"><?=$msg;?></TD></TR>
						<? } ?>
                        <TR>
						  <TD height="25" colspan="2" align=left valign="middle">&nbsp;</TD>
						</TR>
                        <TR>
                          <td colspan="2">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0px" align="center" style="border:0px;">
						  <tr>
						  <?
							$miqry = "select * from avatars where groupid='".$_REQUEST['pid']."' order by id desc";
							$mires = mysql_query($miqry);
							if(mysql_affected_rows()>0)
							{
							  $n=0;
							  while($mirow = mysql_fetch_array($mires))
							  { $n++;
						  ?>
						  	<td width="33%" align="center" valign="top">
							  <?=stripslashes($mirow['name']);?>
							  <br><img src="<? echo '../Avatars/thumbs/'.$mirow['picture'];?>" title="<?=$mirow['prodname'];?>" border="0" vspace="5"   />
							  <br><strong>Column : <?=$mirow['columnn'];?></strong>
							  <br><a href="add_moreimages.php?act=del&id=<?=$mirow['id'];?>&pid=<?=$_REQUEST['pid'];?>">[Delete]</a>
							</td>
						  <? if($n%3==0) echo "</tr><tr>"; } for(;$n<2;$n++) { echo "<td>&nbsp;</td>"; } } else { ?>
						  <td align="center" class="msg_red" style="color:#FF0000;">No avatar uploaded.</td>
						  <? } ?>
						  </tr>
						  </table>
						  </td>
                        </TR>
                      </TABLE>
                    </FORM></td>
                </tr>
              </TABLE></td>
          </tr>
        </TBODY>
      </TABLE></td>
  </tr>
</table>
</body>
</html>