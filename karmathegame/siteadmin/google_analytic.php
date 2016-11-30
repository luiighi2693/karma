<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php") ;
$mlevel=7;
$Error=0;
if(isset($_POST['Submit']))
{	
	$description=addslashes($_POST['description']);
	$enable_pay=addslashes($_POST['enable_pay']);
	
	$query = "update google_analytic set description='$description',enable_is='$enable_pay'";
	$result = mysql_query($query,$db);
	$Message = "Google Analytics Code Changed Successfully"; 
}
$query = "select * from google_analytic";
$result = mysql_query($query,$db);
$row = mysql_fetch_array($result);

$description=stripslashes($row["description"]);
$enable_pay=stripslashes($row["enable_is"]);
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
                  <TD height="35" class="form111">Manage Google Analytics</TD>
                </TR>
                <tr>
                  <td height="222" class="formbg" valign="top"><form name="addmaterial"  method=post enctype="multipart/form-data">
                      <TABLE cellSpacing=0 cellPadding=0 width=98% border=0 class="t-b">
                        <TR>
                          <TD class=a align=right colSpan=4 nowrap>* Required Information</TD>
                        </TR>
                        <? if($Message) { ?>
                        <TR><td>&nbsp;</td>
                          <TD colSpan=3 align="left" vAlign=top><span class="a-l"><? echo  $Message; ?></span></TD>
                        </TR>
                        <? } ?>
						  <TR>
                          <TD width="11%" height="25" align=right><strong><span class="a"></span> Enable :&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><input name="enable_pay" type="checkbox" id="enable_pay" <? if($enable_pay=="Y") { ?> checked="checked" <? } ?>  class="solidinput" value="Y" ></TD>
                        </TR>
                        <TR>
                          <TD width="11%" height="25" vAlign=top nowrap="nowrap" align=right><strong><span class="a"></span> Google Analytics Code :&nbsp;</strong></TD>
                          <TD height="25" colSpan=3 vAlign=top><textarea name="description" id="description" rows="10" cols="80"  class="solidinput"><?php echo $description; ?></textarea></TD>
                        </TR>
						<TR>
                          <TD align=right>&nbsp;</TD>
                          <TD width="89%" colspan="3"><INPUT type=submit name="Submit" class="bttn-s" value="Update" onClick="return valid();">
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
