<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php") ;
$mlevel=7;
$Error=0;
if(isset($_POST['Submit']))
{
	if(isset($_POST['facebook_link']))$facebook_link=addslashes($_POST['facebook_link']);
	if(isset($_POST['myspace_link']))$myspace_link=addslashes($_POST['myspace_link']);
	if(isset($_POST['twitter_link']))$twitter_link=addslashes($_POST['twitter_link']);
	if(isset($_POST['youtube_link']))$youtube_link=addslashes($_POST['youtube_link']);
	$query = "update admin set facebook_link='$facebook_link',myspace_link='$myspace_link',twitter_link='$twitter_link',youtube_link='$youtube_link' where id=1";
	$result = mysql_query($query,$db);
	$Message = "Links have been updated successfully."; 
}
$query = "select * from admin";
$result = mysql_query($query,$db);
$row = mysql_fetch_array($result);
$facebook_link= stripslashes($row["facebook_link"]);
$myspace_link= stripslashes($row["myspace_link"]);
$twitter_link= stripslashes($row["twitter_link"]);
$youtube_link= stripslashes($row["youtube_link"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<LINK 
href="main.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript src="body.js"></SCRIPT>
<script>
function valid()
{
	form=document.addmaterial;
	/*if(form.name.value=="")
	{
		alert("Please enter password.");
		form.name.focus();
		return false;
	}*/	
	return  true;
}
</script>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
</HEAD>
<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<table align="left" width="100%"  border="0" cellpadding="0" cellspacing="0">
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
                  <TD height="35" class="form111">Update Social Links </TD>
                </TR>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addmaterial"  method=post enctype="multipart/form-data">
                      <TABLE cellSpacing=0 cellPadding=0 width=98% border=0 class="t-b">
                        <TR>
                          <TD class=a align=right colSpan=4 nowrap>* Required Information</TD>
                        </TR>
                        <? if($Message) { ?>
                        <TR>
                          <TD colSpan=4 align="center" vAlign=top><span class="a-l"><? echo  $Message; ?></span></TD>
                        </TR>
                        <? } ?>
                        <TR>
                          <TD width="23%" height="25" align=right><strong><span class="a"></span> Facebook:&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="facebook_link" type="text"  class="solidinput" value="<?php echo $facebook_link; ?>" size="70"></TD>
                        </TR>
						
						<TR>
                          <TD width="23%" height="25" align=right><strong><span class="a"></span>Twitter:&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="twitter_link" type="text"  class="solidinput" value="<?php echo $twitter_link; ?>" size="70"></TD>
                        </TR>
						<TR>
                          <TD width="23%" height="25" align=right><strong><span class="a"></span>MySpace:&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="myspace_link" type="text"  class="solidinput" value="<?php echo $myspace_link; ?>" size="70"></TD>
                        </TR>
						<TR>
                          <TD width="23%" height="25" align=right><strong><span class="a"></span>YouTube:&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="youtube_link" type="text"  class="solidinput" value="<?php echo $youtube_link; ?>" size="70"></TD>
                        </TR>
						<TR>
                          <TD colSpan=4>&nbsp;</TD>
                        </TR>
                        <TR>
                          <TD align=right>&nbsp;</TD>
                          <TD width="77%" colspan="3"><INPUT type=submit name="Submit" class="bttn-s" value="Update Links" onClick="return valid();">
                          </TD>
                        </TR>
                        <TR>
                          <TD colSpan=4><P>&nbsp;</P>
                            <P>&nbsp;</P></TD>
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
</BODY>
</HTML>
