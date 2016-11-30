<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");

$mlevel=1;
$id=$_GET['id'];
$contents2=$_POST['rte1'];
$contents=addslashes($contents2);
$name=addslashes($_POST['name']);
$supercheap_price=$_POST['supercheap_price'];
$msg="";
if($_POST["submit"])
{
	$sql="update staticpage set 
			content='$contents',
			name='$name',
			amount='$supercheap_price' where id='$id'";
	//$q=mysql_query($sql);
	mysql_query($sql) or die(mysql_error()); 
	$msg="Page content has been updated successfully.";
}		
$qry="select * from staticpage where id=$id";
$rs=mysql_query($qry);
$arr=mysql_fetch_array($rs);
$pgnm=stripslashes($arr["name"]);
$pgdes=stripslashes($arr["content"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" type=text/css rel=stylesheet>
</head>
<body leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<script language="javascript" src="body.js"></script>
<script language="javascript" type="text/javascript">
function Chkblanck()
{
	if(document.addstonecolor.name.value.split(" ").join("")=="")
	{
		alert("Please enter title.");
		document.addstonecolor.name.focus();
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
    <td><table cellSpacing=0 cellPadding=0 width="100%" border=0>
        <tbody >
          <tr>
            <td width="20%"  valign="top" class="rightbdr" ><? include("inner_left_admin.php"); ?>
            </td>
            <td width="80%" valign="top" align="center"><table width="100%"  border=0 cellpadding="2" cellspacing="2">
                <tr>
                  <td height="35" class=form111>Edit
                    <?=$pgnm;?>
                    Page</td>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addstonecolor"  method=post enctype="multipart/form-data">
                      <table cellSpacing=2 cellPadding=2 width=98% border=0 class="t-b">
                        <? if($msg) {?>
                        <tr>
                          <td colSpan=4 align="center"><font color="red"><? echo $msg;?></font></td>
                        </tr>
                        <? } ?>
						
                        <tr>
                          <td width="11%" height="25" align=right vAlign=top class=dataLabel>Title : </td>
                          <td width="89%" height="25" colSpan=3 vAlign=top>
						  <input type="text" name="name" id="name" value="<?=$pgnm?>" size="70" class="solidinput">&nbsp;
						  
						  </td>
                        </tr>
						<tr>
                          <td width="11%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                          <td height="25" colSpan=3 vAlign=top>
								<?php
								include("ckeditor/ckeditor.php");
								include("ckeditor/ckfinder/ckfinder.php");
								$CKEditor = new CKEditor();
								$CKEditor->basePath = 'ckeditor/';
								$CKEditor->config['width'] = 850;
								$CKEditor->config['height'] = 300;
								CKFinder::SetupCKEditor( $CKEditor, 'ckeditor/ckfinder/' ) ;
								$CKEditor->editor("rte1",$pgdes);
								?>
                          </td>
                        </tr>
                        <tr>
                          <td width="11%" height="25" align=right vAlign=top class=dataLabel>&nbsp;</td>
                          <td colSpan=3 align="left"><input name="submit" type="submit" value=" Edit Page " class="bttn-s" onClick="return Chkblanck();"></td>
                        </tr>
                        <tr>
                          <td colSpan=4>&nbsp;</td>
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
</body>
</html>