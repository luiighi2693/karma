<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php") ;
$mlevel=7;
$Error=0;
if(isset($_POST['Submit']))
{	
	$adminmail=addslashes($_POST['adminmail']);
	
	$query = "update admin set adminmail='$adminmail'";
	$result = mysql_query($query,$db);
	$Message = "Admin Email Address Changed Successfully"; 
}
$query = "select * from admin";
$result = mysql_query($query,$db);
$row = mysql_fetch_array($result);
$adminmail=stripslashes($row["adminmail"]);
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
	if(form.adminmail.value=="")
	{
		alert("Please enter admin email address.");
		form.adminmail.focus();
		return false;
	}
	
	return  true;
}
</script>
<META content="MSHTML 6.00.2600.0" name=GENERATOR>
</HEAD>
<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
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
                  <TD height="35" class="form111">Manage Admin E-Mail Address</TD>
                </TR>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addmaterial"  method=post enctype="multipart/form-data">
                      <TABLE cellSpacing=2 cellPadding=2 width=98% border=0>
                        <TR>
                          <TD class=a align=right colSpan=4 nowrap>* Required Information</TD>
                        </TR>
                        <? if($Message) { ?>
                        <TR><td></td>
                          <TD colSpan=3 align="left" vAlign=top><span class="a-l"><? echo  $Message; ?></span></TD>
                        </TR>
                        <? } ?>
                        <TR>
                          <TD width="12%" height="25" vAlign=top align=right><strong><span class="a">*</span> Admin E-Mail:&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="adminmail" type="text"  class="solidinput" value="<?php echo $adminmail; ?>" size="50">&nbsp;(For all outgoing mails)</TD>
                        </TR>
						
                        <TR>
                          <TD align=right>&nbsp;</TD>
                          <TD width="88%" colspan="3"><INPUT type=submit name="Submit" class="bttn-s" value="Update" onClick="return valid();">
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
