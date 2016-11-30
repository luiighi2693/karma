<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php");
$mlevel=5;
$Message="";
if($_POST['SUBMIT_1'])
{
	for($aa=0;$aa<$_POST['totalcode'];$aa++)
	{
		$name=$_POST['name_1_'.$aa.''];
		
		$get=mysql_query("select * fro coupons where code='".$name."' ");
		$Totget=mysql_affected_rows();
		if($Totget<=0)
		{
			$sql="INSERT INTO coupons SET 
				code='".addslashes($name)."',
				marketerid='".addslashes($_POST['marketerid'])."',
				addeddate=now()";
			$q=mysql_query($sql);	
		}	
	}	
	header("location:manage_qrcodes.php?msgs=1");
	exit;
}
if($_GET['id'])
{
	$Buttitle="Save changes";
	$SEL="SELECT * from coupons where id='".$_GET['id']."'"; 
	$SELRs=mysql_query($SEL);
	$ROW=mysql_fetch_object($SELRs);
	/*$description=trim(stripslashes($ROW->description));*/
}
else
{
	$Buttitle="Add";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<link href="main.css" catname=text/css rel=stylesheet />
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<script language=javascript src="body.js"></script>
<script language="javascript" name="text/javascript">
function frmcheck()
{
	form=document.frmgenerate5;
	if(form.totalcode.value.split(" ").join("")=="")
	{
		alert("Please enter total number of QR code to generate.");
		form.totalcode.focus();
		return false;
	}
	return  true;	
}
</script>
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
                  <td height="35" class="form111"><? if($_GET['id']){?>Edit<? } else {?>Generate<? } ?> QR Code <span class="a">
                    <?=$Message;?>
                  </span></td>
                </tr>
                <tr>
                  <td height="222" class="formbg" valign="top">
				  	
                      <table cellspacing="2" cellpadding="2" width=98% border="0" class="t-b">
                        
						<? if($Message){?>
						<tr>
                         <td class="a" align="center" colspan="4">&nbsp;</td>
                        </tr>
						<? }?>
						<tr>
						 <td  height="25" align="left" valign="top" style="line-height:22px;">
						    <form name="frmgenerate5" id="frmgenerate5" enctype="multipart/form-data" method="post">
							Marketer: 
							<select name="marketerid" id="marketerid"  class="solidinput" style="width:250px;">
								   <option value="">Select Marketer</option>
								   <?
									$rs11=mysql_query("select * from marketers where 1=1 order by firstname asc");
									$tot11=mysql_affected_rows();
									for($m=0;$m<$tot11;$m++)
									{
									$gr=mysql_fetch_object($rs11);
								  ?>
								 	 <option value="<?=$gr->id?>" <? if($_POST['marketerid']==$gr->id){ echo "selected";}?> ><?=stripslashes($gr->code); ?> - <?=stripslashes($gr->firstname); ?></option>
								  <? }?>
							</select>
							<?
							if($_POST['totalcode'])
							{
								$totalcode=$_POST['totalcode'];
							}
							else
							{
								$totalcode=1;
							}
							?>
							Total QR Code: <input type="text" name="totalcode" id="totalcode" value="<? echo $totalcode;?>" class="solidinput" style="width:80px;" />
						  	<input type="submit" name="generate5" id="generate5" onClick="return frmcheck();" value="Generate QR Codes" class="bttn-a"><br>
							<? if($_POST['generate5']!='')
							{
								?>
								<br>Click below to save all QR codes to database:<br><input type="submit" name="SUBMIT_1" id="SUBMIT_1" value="SAVE TO DATABASE" style="background-color:#FF0000;color:#FFFFFF;" /><br><br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="t-b">
									<?
									for($a=0;$a<$_POST['totalcode'];$a++)
									{
										$num=random_string(8);
										$get=mysql_query("select id from coupons where code='".$num."' ");
										$Totget=mysql_affected_rows();
										if($Totget>0)
										{
											$num=random_string(8);
										}
										?>
										  <tr>
											<td width="8%" nowrap="nowrap">QR Code <? echo $a+1;?></td>
											<td width="92%"><input type="text" name="name_1_<? echo $a;?>" id="name_1_<? echo $a;?>" class="solidinput" value="<? echo $num;?>" style="width:100px;text-align:center;font-size:14px;"/></td>
										  </tr>
										<?
									}
							}
							?>
								</table>
							</form>
						  </td>
                          
						</tr>
						
                      </table>
                   </td>
                </tr>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>
</html>